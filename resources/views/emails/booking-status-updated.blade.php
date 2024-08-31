<!-- resources/views/emails/booking-status-updated.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
            font-size: 24px;
        }
        h2 {
            color: #333;
            font-size: 20px;
            margin-top: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border-left: 4px solid #4CAF50;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .contact-link {
            text-decoration: underline;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Booking Has Been {{ ucfirst($booking->status) }}</h1>

        <p>Dear {{ $booking->guestName }},</p>

        @if($booking->status === 'confirmed')
            <p>We are pleased to inform you that your booking for {{ $booking->safariname }} has been confirmed.</p>
            <p>We look forward to providing you with an unforgettable experience!</p>
        @else
            <p>We regret to inform you that your booking for {{ $booking->safariname }} has been cancelled.</p>
            <p>If you have any questions about this cancellation or would like to make a new booking, please don't hesitate to contact us.</p>
        @endif

        {{-- <div class="image-container">
            <img src="{{ $booking->image }}" alt="{{ $booking->safariname }}">
        </div> --}}

        <h2>Booking Details:</h2>
        <ul>
            <li>Safari: {{ $booking->safariname }}</li>
            <li>Price: {{ $booking->price }}</li>
            <li>Arrival Date: {{ $booking->arrivalDate }}</li>
            <li>Number of People: {{ $booking->nop }}</li>
            <li>Number of Children: {{ $booking->noc }}</li>
        </ul>

        <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>

        <p>Email: <a href="mailto:domingocamille517@gmail.com" class="contact-link">domingocamille517@gmail.com</a></p>

        <p class="footer">Best regards,<br>Treks Safari Team</p>
    </div>
</body>
</html>
