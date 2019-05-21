<footer class="bg-dark">
    <div class="d-flex text-white p-3 justify-content-center">
        <div class="p-3 col-4 d-flex">
            <div class="container align-items-center">
                <a href="#"><img src="img/eventually_logo_cropped.png" height="30"></a>
                <p class="lead" style="font-size: 11pt">
                </p>
                <a href="https://github.com/zxyctn/Eventually"><img src="img/github.png" style="filter: invert(1)" height="30"></a>
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
                    echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper"><img class="profile-pic" src="' . $user->profilepicture . '"></div><div><p class="lead">' . $user->nickname . '</p></div><div><a href="profile.php?id=' . $user->user_id . '" class="btn btn-primary">Explore</a></div></div></div></div>';
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
                    echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div><p class="lead">' . $event->title . '</p></div><div><a href="event.php?id=' . $event->event_id . '" class="btn btn-primary">Explore</a></div></div></div></div>';
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
                <p class="lead">Group Requests</p>
                <?php
                require 'config.php';
                session_start();

                $login_user_id = $_SESSION['login_user_id'];

                $sql0 = "SELECT * FROM GroupAdmin WHERE user_id='$login_user_id'";
                $res0 = mysqli_query($db, $sql0);
                while ($mygroup = mysqli_fetch_object($res0)) {
                    $sql11 = "SELECT * FROM Group_ WHERE group_id = '$mygroup->group_id'";
                    $res11 = mysqli_query($db, $sql11);
                    $inGroup = mysqli_fetch_object($res11);

                    $sql = "SELECT * FROM GroupRequests WHERE group_id = '$mygroup->group_id' AND decision='not replied'";
                    $res = mysqli_query($db, $sql);

                    while ($obj = mysqli_fetch_object($res)) {
                        $sql1 = "SELECT * FROM User WHERE user_id='$obj->user_id'";
                        $res1 = mysqli_query($db, $sql1);
                        $user = mysqli_fetch_object($res1);
                        echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper"><img class="profile-pic" src="' . $user->profilepicture . '"></div><p class="">' . $user->nickname . '</p><p class="ml-2"><strong>' . $inGroup->name . '</strong></p></div><div><a href="profile.php?id=' . $user->user_id . '" class="btn btn-primary btn-sm mx-1">Explore</a><button class="btn btn-success btn-sm mx-1" onclick="acceptUser(' . $mygroup->group_id . ', ' . $login_user_id . ', ' . $user->user_id . ')">Accept</button><button class="btn btn-danger btn-sm mx-1" onclick="rejectUser(' . $mygroup->group_id . ', ' . $login_user_id . ', ' . $user->user_id . ')">Reject</button></div></div></div>';
                    }
                }
                ?>
                <br>
                <p class="lead">Group Invitations</p>
                <?php
                require 'config.php';
                session_start();

                $login_user_id = $_SESSION['login_user_id'];

                $sql0 = "SELECT * FROM Invitation WHERE user_id='$login_user_id' AND status='not replied'";
                $res0 = mysqli_query($db, $sql0);
                while ($invite = mysqli_fetch_object($res0)) {
                    $sql = "SELECT * FROM Group_ WHERE group_id = '$invite->group_id'";
                    $res = mysqli_query($db, $sql);

                    while ($obj = mysqli_fetch_object($res)) {
                        $sql1 = "SELECT * FROM User WHERE user_id='$invite->admin_id'";
                        $res1 = mysqli_query($db, $sql1);
                        $user = mysqli_fetch_object($res1);

                        echo '<div class="card my-1"><div class="card-body"><div class="d-flex"><div><div class="image-cropper"><img class="profile-pic" src="' . $user->profilepicture . '"></div><p class="text-dark">' . $user->nickname . '</p><p class="ml-2"><strong>' . $obj->name . '</strong></p></div><div><a href="group.php?id=' . $obj->group_id . '" class="btn btn-primary btn-sm mx-1">Explore</a><button class="btn btn-success btn-sm mx-1" onclick="acceptInvite(' . $invite->group_id . ', ' . $login_user_id . ', ' . $invite->admin_id . ')">Accept</button><button class="btn btn-danger btn-sm mx-1" onclick="rejectInvite(' . $invite->group_id . ', ' . $login_user_id . ', ' . $invite->admin_id . ')">Reject</button></div></div></div></div>';
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
<script type="text/javascript" src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>