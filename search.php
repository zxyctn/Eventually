<?php
require 'include/header.php';
session_start();
?>


<div class="jumbotron jumbotron-fluid bg-white mt-5">
    <div class="container text-center">
        <h1 class="display-4">Search</h1>
        <p class="lead">Find events, groups and connect with people</p>
        <form class="form-inline justify-content-center" action="search.php" method="GET">
            <input class="form-control mr-sm-2 d-flex col-6" name="key" type="search" value="<?php session_start();
                                                                                                echo $_GET['key'] ?>" aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="container p-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="events-tab" data-toggle="tab" href="#events" role="tab" aria-controls="events" aria-selected="true">Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="people-tab" data-toggle="tab" href="#people" role="tab" aria-controls="people" aria-selected="false">People</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="groups-tab" data-toggle="tab" href="#groups" role="tab" aria-controls="groups" aria-selected="false">Groups</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="false">Category</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active p-3" id="events" role="tabpanel" aria-labelledby="events-tab">
            <?php
            require 'config.php';
            session_start();

            $key = $_GET['key'];

            $sql0 = "SELECT * FROM Event WHERE title like '%$key%'";
            $res0 = mysqli_query($db, $sql0);

            while ($event = mysqli_fetch_object($res0)) {
                $result = '<div class="card my-2"><div class="card-header">' . $event->city . ', ' . $event->country . '</div><div class="card-body"><h5 class="card-title">' . $event->title . '</h5><p class="card-text">' . $event->description . '</p><a href="event.php?id=' . $event->event_id . '" class="btn btn-primary">Explore</a></div></div>';
                echo $result;
            }
            ?>
        </div>
        <div class="tab-pane fade p-3" id="people" role="tabpanel" aria-labelledby="people-tab">
            <?php
            require 'config.php';
            session_start();

            $key = $_GET['key'];
            $sql2 = "SELECT * FROM User WHERE firstname like '%$key%' OR lastname like '%$key%' OR nickname like '%$key%'";
            $res2 = mysqli_query($db, $sql2);

            while ($user = mysqli_fetch_object($res2)) {
                $result = '<div class="card my-2"><div class="card-body"><div class="d-flex"><div class="image-cropper mr-4"><img class="profile-pic" src="' . $user->profilepicture . '"></div><div><h5 class="card-title">' . $user->nickname . '</h5><p class="card-text">' . $user->firstname . ' ' . $user->lastname . '</p><a href="profile.php?id=' . $user->user_id . '" class="btn btn-primary">Explore</a></div></div></div></div>';
                echo $result;
            }
            ?>
        </div>
        <div class="tab-pane fade p-3" id="groups" role="tabpanel" aria-labelledby="groups-tab">
            <?php
            require 'config.php';
            session_start();

            $key = $_GET['key'];
            $sql1 = "SELECT * FROM Group_ WHERE name like '%$key%'";
            $res1 = mysqli_query($db, $sql1);

            while ($group = mysqli_fetch_object($res1)) {
                $result = '<div class="card my-2"><div class="card-body"><h5 class="card-title">' . $group->name . '</h5><p class="card-text">' . $group->description . '</p><a href="group.php?id=' . $group->group_id . '" class="btn btn-primary">Explore</a></div></div>';
                echo $result;
            }
            ?>
        </div>
        <div class="tab-pane fade p-3" id="category" role="tabpanel" aria-labelledby="category-tab">
            <?php
            require 'config.php';
            session_start();

            $key = $_GET['key'];
            $sql1 = "SELECT * FROM EventCategory natural join Event WHERE category_name like '$key'";
            $res1 = mysqli_query($db, $sql1);

            while ($event = mysqli_fetch_object($res1)) {
                $result = '<div class="card my-2"><div class="card-body"><h5 class="card-title">' . $event->title . '</h5><p class="card-text">' . $event->description . '</p><a href="event.php?id=' . $event->event_id . '" class="btn btn-primary">Explore</a></div></div>';
                echo $result;
            }
            ?>
        </div>
    </div>
</div>

<?php
require 'include/footer.php';
session_start();
?>