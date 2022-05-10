<?php

session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style/global.css">
    <title>Signup</title>
</head>
<body>
<form method="post">
    <div>
        <label>
            First name:
            <input type="text" name="firstName">
        </label>
        <br>
        <label>
            Last name:
            <input type="text" name="lastName">
        </label>
        <br>
        <label>
            Email:
            <input type="text" name="email">
        </label>
        <br>
        <label>
            Password:
            <input type="password" name="password">
        </label>
        <br>
        <label>
            Password again:
            <input type="password" name="passwordAgain">
        </label>
        <br>
        <input type="submit" value="Signup" name="signup">
        <input type="submit" value="Back" name="back">
    </div>
</form>
</body>
</html>
<?php

echo @$_SESSION['message'];

include_once 'user.php';
if (@$_POST['signup'])
{
	$user = new user($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['password'],$_POST['passwordAgain']);
}
if (@$_POST['back']) {
    unset($_SESSION['message']);
	header('Location: index.php');
	exit;
}