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
    <title>LOGIN</title>
</head>
<body>
<form method="post" action="logout.php">
    <div>
        <input type="submit" value="logout" name="logout">
    </div>
</form>
</body>
</html>
<?php
echo $_SESSION['user'];
if ($_POST){
	session_destroy();
	header('location:index.php');
}
?>
