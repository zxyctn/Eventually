<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark <?php session_start();
                                                                        echo isset($_SESSION['login_email']) ? 'justify-content-between' : 'justify-content-center'; ?>">
        <div class="<?php session_start();
                    echo isset($_SESSION['login_email']) ? '' : 'd-none'; ?>">
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
            <li class="nav-item px-2 order-1 order-sm-3">
                <a href="#"><img src="img/eventually_logo_cropped.png" height="30"></a>
            </li>
            <li class="nav-item order-2 order-sm-1">
                <a href="#" class="nav-link">EXPLORE</a>
            </li>
            <li class="nav-item order-3 order-sm-2">
                <a href="#" class="nav-link">GROUPS</a>
            </li>
            <li class="nav-item order-4">
                <a href="#" class="nav-link">CONTACT</a>
            </li>
            <li class="nav-item order-5">
                <a href="#" class="nav-link">ABOUT</a>
            </li>
        </ul>
        <div class="<?php session_start();
                    echo isset($_SESSION['login_email']) ? '' : 'd-none'; ?>">
            <a href="" data-toggle="modal" data-target="#events"><img src="img/events.png" height="30"></a>
            <a href="" data-toggle="modal" data-target="#friends"><img src="img/people.png" height="30"></a>
            <a href="" data-toggle="modal" data-target="#groups"><img src="img/groups.png" height="30"></a>
            <a href="profile.php"><img src="img/user.png" height="30"></a>
            <a href="logout.php"><img src="img/logout.png" height="30"></a>
        </div>
        <div class="<?php session_start();
                    echo isset($_SESSION['login_email']) ? 'd-none' : ''; ?>">
            <a href="login.php"><img src="img/login.png" height="30"></a>
            <a href="register.php"><img src="img/register.png" height="30"></a>
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid bg-white mt-5">
        <div class="container text-center">
            <h1 class="display-4">Search</h1>
            <p class="lead">Find events, groups and connect with people</p>
            <form class="form-inline justify-content-center" action="search.php" method="GET">
                <input class="form-control mr-sm-2 d-flex col-6" name="key" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <section class="bg-primary text-white p-5 text-center <?php session_start();
                                                            echo isset($_SESSION['login_email']) ? 'd-none' : ''; ?>">
        <h1 class="display-4">Welcome</h1>
        <p class="lead p-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt et minima veniam enim aliquam
            voluptatibus vel
            repellat, aperiam laudantium! Corrupti nobis eius, alias atque nostrum consectetur laudantium doloremque
            odio aperiam quis id officiis assumenda laborum minima accusantium sit recusandae ducimus provident!
            Perferendis, odit, tenetur deserunt, voluptas quam rerum vero accusantium ipsa voluptate architecto quas
            necessitatibus hic laboriosam autem? Praesentium soluta earum ratione sint accusantium officiis esse sed
            corporis eligendi culpa quasi optio, dolore pariatur deserunt aliquam deleniti cupiditate tempore similique
            laudantium rem nisi temporibus, nulla est eius. Exercitationem maiores voluptates amet molestias illum odit
            nulla dolores explicabo esse delectus, natus optio eaque fugit ipsum veritatis. Quo qui quas maxime ipsam
            pariatur minima suscipit doloremque cum quod accusamus ab sit necessitatibus animi earum odio repellendus,
            est nesciunt adipisci esse, fuga, similique expedita? Cum, quibusdam deserunt, consectetur possimus saepe,
            repellat molestias minima error tempora nihil labore. Fugit recusandae excepturi deleniti repudiandae.
        </p>
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

        $sql = "SELECT * FROM Event natural join EventParticipants WHERE user_id = '$login_user_id'";
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

    <footer class="bg-dark">
        <div class="d-flex text-white p-3 justify-content-center">
            <div class="p-3 col-4 d-flex">
                <div class="container align-items-center">
                    <a href="#"><img src="img/eventually_logo_cropped.png" height="30"></a>
                    <p class="lead" style="font-size: 11pt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi nam
                        repellendus
                        nobis consequuntur sed!
                        Nam et nostrum, suscipit quia possimus consequatur ducimus maiores doloribus in officia
                        accusamus?
                        Qui, error consectetur?
                    </p>
                    <a href="#"><img src="img/github.png" style="filter: invert(1)" height="30"></a>
                </div>
                <div class="my-3" style="background: white; height: inherit; width: 0.1rem"></div>
            </div>
            <div class="p-3 d-flex inline-block col-3 justify-content-around align-items-center">
                <div>
                    <h1 class="lead" style="font-size: 14pt"><strong>Category</strong></h1>
                    <h1 class="lead" style="font-size: 11pt">Music</h1>
                    <h1 class="lead" style="font-size: 11pt">Dance</h1>
                    <h1 class="lead" style="font-size: 11pt">Books</h1>
                    <h1 class="lead" style="font-size: 11pt">Travel</h1>
                </div>
                <div>
                    <h1 class="lead" style="font-size: 14pt"><strong>Site Map</strong></h1>
                    <h1 class="lead" style="font-size: 11pt">Explore</h1>
                    <h1 class="lead" style="font-size: 11pt">Groups</h1>
                    <h1 class="lead" style="font-size: 11pt">About Us</h1>
                    <h1 class="lead" style="font-size: 11pt">Contact</h1>
                </div>
            </div>
            <div class="p-3 d-flex col-4 ">
                <div class="my-3" style="background: white; height: inherit; width: 0.1rem"></div>
                <p class="px-3 d-flex align-items-end" style="font-size: 11pt">Copyright (C) 2019</p>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="friends" tabindex="-1" role="dialog" aria-labelledby="friendsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="friendsLabel">Friends</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    require 'config.php';
                    session_start();

                    $login_user_id = $_SESSION['login_user_id'];
                    $sql = "SELECT * FROM UserFriend WHERE user_id1 = '$login_user_id'";
                    $res = mysqli_query($db, $sql);

                    while ($friend = mysqli_fetch_object($res)) {
                        $sql0 = "SELECT * FROM User WHERE user_id='$friend->user_id2'";
                        $res0 = mysqli_query($db, $sql0);
                        $user = mysqli_fetch_object($res0);
                        echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div><img src="' . '$user->profilepicture' . '" height="40"><p class="lead">' . '$user->nickname' . '</p></div><div><a href="profile.php?id=' . '$user->user_id' . '" class="btn btn-primary">Explore</a></div></div></div></div>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="events" tabindex="-1" role="dialog" aria-labelledby="eventsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventsLabel">Events</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    require 'config.php';
                    session_start();

                    $login_user_id = $_SESSION['login_user_id'];
                    $sql = "SELECT * FROM EventParticipants WHERE user_id = '$login_user_id' AND usersDecision='not replied'";
                    $res = mysqli_query($db, $sql);

                    while ($obj = mysqli_fetch_object($res)) {
                        $sql0 = "SELECT * FROM Event WHERE event_id='$obj->event_id'";
                        $res0 = mysqli_query($db, $sql0);
                        $event = mysqli_fetch_object($res0);
                        echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div><p class="lead">' . '$event->title' . '</p></div><div><a href="event.php?id=' . '$event->event_id' . '" class="btn btn-primary">Explore</a></div></div></div></div>';
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="groups" tabindex="-1" role="dialog" aria-labelledby="groupsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupsLabel">Groups</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    require 'config.php';
                    session_start();

                    $login_user_id = $_SESSION['login_user_id'];

                    $sql0 = "SELECT * FROM GroupAdmin WHERE user_id='$login_user_id'";
                    $res0 = mysqli_query($db, $sql0);
                    while ($mygroup = mysqli_fetch_object($res0)) {
                        $sql = "SELECT * FROM GroupRequests WHERE group_id = '$mygroup->group_id' AND decision='not replied'";
                        $res = mysqli_query($db, $sql);

                        while ($obj = mysqli_fetch_object($res)) {
                            $sql1 = "SELECT * FROM User WHERE user_id='$obj->user_id'";
                            $res1 = mysqli_query($db, $sql1);
                            $user = mysqli_fetch_object($res1);
                            echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div><img src="' . '$user->profilepicture' . '" height="40"><p class="">' . '$user->nickname' . '</p></div><div><a href="profile.php?id=' . '$user->user_id' . '" class="btn btn-primary btn-sm mx-1">Explore</a><button class="btn btn-success btn-sm mx-1" onclick="acceptUser(' . '$mygroup->$group_id' . ', ' . '$login_user_id' . ', ' . '$user->user_id' . ')">Accept</button><button class="btn btn-danger btn-sm mx-1" onclick="rejectUser(' . '$mygroup->$group_id' . ', ' . '$login_user_id' . ', ' . '$user->user_id' . ')">Reject</button></div></div></div></div>';
                        }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>