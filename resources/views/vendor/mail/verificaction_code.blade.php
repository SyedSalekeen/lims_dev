<?php
$email = session()->get('vendor_email');
$password = session()->get('vendor_password');
$verification_code = session()->get('vendor_verification_code');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifcation Code</title>
</head>
<body>
        <h3>Dear User</h3> <p>Your email is registered as a vendor in LIMS</p>
        <br>
        <p>Your Login Credentials is</p>
        <h4>Your Email is</h4> <p>{{$email}}<p>
        <h4>Your Password is</h4> <p>{{$password}}<p>
            <h4>Your Verification Code is</h4> <p>{{$verification_code}}<p>
</body>
</html>
