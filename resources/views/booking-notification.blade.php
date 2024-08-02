<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Booking</title>
</head>
<body>
<h1>New Booking Created</h1>
<p>A new booking has been created by {{ $user->name }}, {{ $user->email }} at {{ $booking->created_at }}</p>
<p><strong>Purpose:</strong> {{ $booking->purpose }}</p>
<p><strong>Date:</strong> {{ $booking->date }}</p>
</body>
</html>
