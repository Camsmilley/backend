<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Safari;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\BookingStatusUpdated;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['guide', 'safari'])->get();
        return response()->json($bookings);
    }

    public function show($id)
    {
        $booking = Booking::with(['guide', 'safari'])->find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        return response()->json($booking);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'safariname' => 'required|string|exists:safaris,title',
            'guestName' => 'required|string',
            'nationality' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|email',
            'nop' => 'required|integer',
            'noc' => 'nullable|integer',
            'arrivalDate' => 'required|date',
            'message' => 'nullable|string',
            'guideId' => 'required|exists:guides,id',
            'guestId' => 'nullable|exists:users,id'
        ]);

        $safari = Safari::where('title', $validatedData['safariname'])->first();
        $validatedData['price'] = $safari->price;

        $booking = Booking::create($validatedData);

        return response()->json($booking, 201);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $validatedData = $request->validate([
            'safariname' => 'required|string|exists:safaris,title',
            'price' => 'nullable',
            'guestName' => 'required|string',
            'nationality' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|email',
            'nop' => 'required|integer',
            'noc' => 'required|integer',
            'arrivalDate' => 'required|date',
            'message' => 'nullable|string',
            'guideId' => 'required|exists:guides,id',
            'guestId' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        if ($booking->safariname !== $validatedData['safariname']) {
            $safari = Safari::where('title', $validatedData['safariname'])->first();
            $validatedData['price'] = $safari->price;
        }

        $booking->update($validatedData);

        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }

    public function dailyBookings()
    {
        $today = Carbon::today();
        $dailyBookings = Booking::with(['guide', 'safari'])->whereDate('created_at', $today)->get();

        return response()->json($dailyBookings);
    }

    public function totalBookings()
    {
        $total = Booking::count();
        $completed = Booking::where('status', 'confirmed')->count();
        $cancelled = Booking::where('status', 'cancelled')->count();
        return response()->json([
            'total' => $total,
            'completed' => $completed,
            'cancelled' => $cancelled
        ]);
    }
    
    public function update_confirmed($id)
    {
        $booking = Booking::with('safari')->find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->update(['status' => 'confirmed']);
        return response()-> json(200);
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::with('safari')->find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
    
        $validatedData = $request->validate([
            'status' => 'required|in:confirmed,cancelled',
        ]);
    
        $booking->update(['status' => $validatedData['status']]);

        // Set the image URL for the email
        if ($booking->safari) {
            $booking->imageUrl = asset('images/' . $booking->safari->image);
        } else {
            $booking->imageUrl = null;
        }
    
        try {
            // Mail::to($booking->email)->send(new BookingStatusUpdated($booking));
            // \Log::info("Email sent successfully for booking {$id}.");
    
            return response()->json([
                'message' => 'Booking status updated and email sent successfully',
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            \Log::error("Failed to send email for booking {$id}: " . $e->getMessage());
    
            return response()->json([
                'message' => 'Booking status updated but failed to send email',
                'booking' => $booking,
                'error' => 'Email could not be sent. Please contact the guest directly.'
            ], 200);
        }
    }
    
    public function userBookings($guestId)
    {
        $bookings = Booking::where('guestId', $guestId)->with(['guide', 'safari'])->get();
        return response()->json($bookings);
    }
}