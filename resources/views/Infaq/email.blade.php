<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
</head>
<body>

    <img src="{{ asset('img/MTSP.png') }}" class="block w-28 h-auto" /> 

    <h1>{{ $mailData['title'] }}</h1>

    <p>{{  $mailData['body'] }}</p>

    <hr>
    <h3>Maklumat Infaq:</h3>
    {{-- <p>Nama: {{ $payment['name'] }}</p> --}}
    <p>Email: {{ $infaq['email'] }}</p>

    <hr>
    <h3>Maklumat Pembayaran:</h3>
    <p>Payment ID: {{ $infaq['id'] }}</p>
    <p>Price: RM {{ $infaq['donationAmount'] }}</p>
    <p>Payment Status: {{ $infaq['status'] }}</p>
    
    
    <hr>
    <h3>Receipt Generated at:</h3>
    <p>{{ $infaq['created_at'] }}</p>
    <hr>
    <p>Thank you for using our service.</p>

</body>
</html>