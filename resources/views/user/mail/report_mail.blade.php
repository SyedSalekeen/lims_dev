<?php
$link = session()->get('patient_branch_login_url');
$mr_number = session()->get('patient_login_mr_id');
$password = session()->get('patient_login_password');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>Dear User,</h3> <br>Your report was uploaded on your portal, Kindly Click the below link to check your report<br>
{{$link}}
your, Mr Number is {{$mr_number}} and your password is {{$password}}

</body>
</html>
