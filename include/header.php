<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-horizon.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
        <div class="<?php session_start();
                    echo isset($_SESSION['login_email']) ? '' : 'd-none'; ?>">
            <img src="img/transparent.png" height="30">
            <img src="img/transparent.png" height="30">
            <img src="img/transparent.png" height="30">
            <img src="img/transparent.png" height="30">
            <img src="img/transparent.png" height="30">
            <img src="img/transparent.png" height="30">
        </div>
        <div class="<?php session_start();
                    echo isset($_SESSION['login_email']) ? 'd-none' : ''; ?>">
            <img src="img/transparent.png" height="30">
            <img src="img/transparent.png" height="30">
        </div>
        <ul class="navbar-nav align-items-center justify-content-center">
            
            <li class="nav-item px-4">
                <a href="index.php"><img src="img/eventually_logo_cropped.png" height="30"></a>
            </li>
            
        </ul>
        <div class="<?php session_start();
                    echo isset($_SESSION['login_email']) ? '' : 'd-none'; ?>">
            <a href="createGroup.php"><img src="img/createGroup.png" height="30"></a>
            <a href="" data-toggle="modal" data-target="#events"><img src="img/events.png" height="30"></a>
            <a href="" data-toggle="modal" data-target="#friends"><img src="img/people.png" height="30"></a>
            <a href="" data-toggle="modal" data-target="#groups"><img src="img/groups.png" height="30"></a>
            <a href="profile.php?id=<?php echo $_SESSION['login_user_id'] ?>"><img src="img/user.png" height="30"></a>
            <a href="logout.php"><img src="img/logout.png" height="30"></a>
        </div>
        <div class="<?php session_start();
                    echo isset($_SESSION['login_email']) ? 'd-none' : ''; ?>">
            <a href="login.php"><img src="img/login.png" height="30"></a>
            <a href="register.php"><img src="img/register.png" height="30"></a>
        </div>
    </nav>