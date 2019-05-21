<?php
require 'include/header.php';
require 'include/search.php';
session_start();
?>

    <section class="bg-primary text-white p-5 text-center <?php session_start();
                                                        echo isset($_SESSION['login_email']) ? 'd-none' : ''; ?>">
    <h1 class="display-3">Welcome</h1>
    <h1 class="p-2">Check out last created events</h1>
    <div class="d-flex my-3 justify-content-around">
        <?php
        require 'config.php';
        //session_start();

        $date = date("Y-m-d");
        $c = 0;

        $sql = "SELECT * FROM Event WHERE privacy = 'Public' AND date >= '$date'";
        $res = mysqli_query($db, $sql);
        //echo $res;
        while ($event = mysqli_fetch_object($res) AND $c < 3) {
            $result = '<div class="card bg-dark" style="width: 18rem;"><img src="' . $event->profilepicture . '" class="card-img-top"><div class="card-body"><p class="card-text text-muted">' . $event->date . '</p><h1 class="card-title">' . $event->title . '</h1><p class="card-text"><small>' . $event->description . '</small></p><a href="event.php?id=' . $event->event_id . '" class="btn btn-primary">Explore</a></div></div>   ';
            $c++;
            echo $result;
        }
        ?>
    </div>
    <div class="inline-block">
        <a class="btn btn-danger" href="register.php">Sign Up</a>
        <a class="btn btn-success" href="login.php">Sign In</a>
    </div>
</section>

    <section class="bg-info p-5 <?php session_start();
                                echo isset($_SESSION['login_email']) ? '' : 'd-none'; ?>">

        <?php
        require 'config.php';

        session_start();
        $login_user_id = $_SESSION['login_user_id'];

        $sql = "SELECT * FROM eventParticipants_view WHERE user_id = '$login_user_id'";
        if ($res = mysqli_query($db, $sql)) {
            while ($event = mysqli_fetch_object($res)) {
                $event_id = $event->event_id;
                $result = '<div class="jumbotron d-flex m-3 p-5"><div><p class="display-4">';
                $result .= $event->city . ", " . $event->country;
                $result .= '</p><p class="lead" style="color: purple">' . $event->date . "</p>";
                $result .= '<p class="lead">' . $event->title . '</p>';
                $result .= '<p class="lead">' . $event->description . '</p>';
                $result .= '<a href="event.php?id=' . $event_id . '" class="btn btn-primary">Explore</a></div>';
                $result .= ' <div><img src= image></div></div>';
                echo $result;
            }

            mysqli_free_result($res);
        }
        ?>
    </section>

<?php
require 'include/footer.php';
?>