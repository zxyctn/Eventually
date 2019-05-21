<?php
require 'include/header.php';
require 'config.php';
session_start();

$id = $_GET['id'];
$login_user_id = $_SESSION['login_user_id'];
$sql = "SELECT * FROM Group_ WHERE group_id='$id'";
$res = mysqli_query($db, $sql);
$group = mysqli_fetch_object($res);

$sql0 = "SELECT COUNT(user_id) FROM GroupParticipants WHERE group_id='$id' GROUP BY group_id";
$res0 = mysqli_query($db, $sql0);
$count = mysqli_fetch_array($res0);

$sql15 = "SELECT COUNT(user_id) FROM GroupAdmin WHERE group_id = '$id' AND user_id <> '$login_user_id' GROUP BY group_id";
$res15 = mysqli_query($db, $sql15);
$count2 = mysqli_fetch_array($res15);

$sql06 = "SELECT * FROM GroupParticipants WHERE group_id='$id' AND user_id='$login_user_id'";
$res06 = mysqli_query($db, $sql06);
$groupMemberFlagStep1 = mysqli_fetch_object($res06);

$adminFlag = false;

$sql5 = "SELECT user_id FROM GroupAdmin WHERE group_id='$id'";
$res5 = mysqli_query($db, $sql5);
$admins = array();

while ($row = mysqli_fetch_array($res5)) {
    $admins[$row['user_id']] = $row['user_id'];
}

if (array_key_exists($_SESSION['login_user_id'], $admins))
    $adminFlag = true;

$memberFlag = false;
if ($groupMemberFlagStep1->user_id > 0)
    $memberFlag = true;
if ($adminFlag)
    $memberFlag = true;
$memberFlag2 = false;
if ($group->privacy == 'Public' and !$memberFlag)
    $memberFlag2 = true;
if ($group->privacy == 'Public' and $memberFlag)
    $memberFlag2 = true;
if ($group->privacy == 'Private' and !$memberFlag)
    $memberFlag2 = false;
$postFlag = false;
if ($memberFlag)
    $postFlag = true;
$requestFlag = false;
if (isset($_SESSION['login_user_id']) and !$memberFlag and $group->privacy == 'Public')
    $requestFlag = true;

$requestFlag2 = false;
if (isset($_SESSION['login_user_id']) and !$memberFlag and $group->privacy == 'Private')
    $requestFlag2 = true;

$requestSent = false;
$sql56 = "SELECT * FROM GroupRequests WHERE group_id='$id' AND user_id='$login_user_id' AND decision = 'not replied'";
$res56 = mysqli_query($db, $sql56);
$objjj = mysqli_fetch_object($res56);

if ($objjj->user_id > 0)
    $requestSent = true;
?>

<div class="p-0 m-0">
    <div class="d-flex align-content-end flex-wrap" style="background-image: url('<?php echo $group->profilepicture ?>'); height: 500px; width: 100%; background-position: center center; background-size: 100%; background-repeat: no-repeat">
        <div class="d-flex px-5 align-items-center text-center justify-content-between" style="width:100%; background: rgba(255, 255, 255, 0.6);">
            <div class="m-0 p-0 col-3 d-flex justify-content-center">
                <button class="btn btn-outline-success mb-0 <?php echo ($memberFlag2 or $memberFlag) ? '' : 'd-none' ?>" data-toggle="modal" data-target="#groupMembers"><strong>
                        <?php
                        session_start();

                        echo 'Members';
                        ?>
                    </strong></button>
                <div class="<?php echo $login_user_id > 0 ? '' : 'd-none' ?>">
                    <button onclick="privateGroupInsert(<?php echo $id . ',' . $login_user_id ?>)" class="btn btn-primary mx-1 <?php echo ($group->privacy == 'Private' and $memberFlag == false) ? '' : 'd-none' ?>" <?php echo $requestSent == true ? 'disabled' : '' ?>><?php echo ($requestSent == true) ? 'Request Sent' : 'Attend' ?></button>
                    <button onclick="publicGroupInsert(<?php echo $id . ',' . $login_user_id ?>)" class="btn btn-primary mx-1 <?php echo ($group->privacy == 'Private' or $memberFlag == true) ? 'd-none' : '' ?>">Attend</button>
                </div>
                <div class="<?php echo $adminFlag ? '' : 'd-none' ?>">
                    <a id="inviteButton" data-toggle="modal" data-target="#invitePeople" class="pl-3"><img src="img/invite.png" style="filter: invert(1)" height="30"></a>
                </div>
                <div class="<?php echo $adminFlag ? '' : 'd-none' ?>">
                    <a class="mx-2" href="createEvent.php?group_id=<?php echo $id ?>&f=1"><img src="img/createEvent.png" height="30" style="filter: invert(1)"></a>
                </div>
            </div>
            <div class="m-0 p-0 col-6">
                <h1 class=""><?php echo $group->name ?></h1>
            </div>
            <div class="m-0 p-0 col-3 justify-content-center d-flex">
                <p class="lead mb-0 mx-3" style="color: red"><strong><?php echo $group->privacy ?></strong></p>
                <button data-toggle="modal" data-target="#editGroup" class="btn px-1 btn-warning <?php echo $adminFlag ? '' : 'd-none' ?>">Edit</button>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-secondary text-white ">
        <div class="container <?php echo $memberFlag2 ? '' : 'd-none' ?>">
            <p class="display-4">Past Events</p>
            <div class="jumbotron p-5 bg-dark">

                <div class="d-flex justify-content-around">
                    <?php
                    $date = date("Y-m-d");
                    $c = 0;

                    $sql = "SELECT * FROM eventOrganizes_view WHERE group_id='$id' AND date < '$date'";
                    $res = mysqli_query($db, $sql);
                    //echo $res;
                    while ($event = mysqli_fetch_object($res) and $c < 3) {
                        $result = '<div class="card bg-secondary" style="width: 18rem;"><img src="' . $event->profilepicture . '" class="card-img-top"><div class="card-body"><p class="card-text text-dark">' . $event->date . '</p><h1 class="card-title">' . $event->title . '</h1><p class="card-text"><small>' . $event->description . '</small></p></div></div>   ';
                        $c++;
                        echo $result;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="container <?php echo $memberFlag2 ? '' : 'd-none' ?>">
            <p class="display-4">Next Events</p>
            <div class="jumbotron p-5 bg-dark">

                <div class="d-flex row row-flex no-wrap">
                    <?php
                    $date = date("Y-m-d");
                    $c = 0;

                    $sql = "SELECT * FROM eventOrganizes_view WHERE group_id='$id' AND date >= '$date'";
                    $res = mysqli_query($db, $sql);
                    //echo $res;
                    while ($event = mysqli_fetch_object($res)) {
                        $result = '<div class="m-3 card bg-secondary" style="width: 18rem;"><img src="' . $event->profilepicture . '" class="card-img-top"><div class="card-body"><p class="card-text text-dark">' . $event->date . '</p><h1 class="card-title">' . $event->title . '</h1><p class="card-text"><small>' . $event->description . '</small></p><a href="event.php?id=' . $event->event_id . '" class="btn btn-primary">Explore</a></div></div>   ';

                        echo $result;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="d-flex container pt-5 px-0">
            <div class="col-5">
                <h1 class="display-4">Description</h1>
                <p>
                    <?php echo $group->description ?>
                </p>
            </div>
            <div class="col-7">
                <div class="<?php echo $postFlag ? '' : 'd-none' ?>">
                    <form action="addPost.php?group_id=<?php echo $id ?>&user_id=<?php echo $login_user_id ?>" method="POST">

                        <h1 class="display-4">Post</h1>
                        <textarea class="form-control text-white" name="content" style="height: 200px; background: rgba(0, 0, 0, 0.05)" required></textarea>
                        <button type="submit" class="btn btn-primary my-2" style="float: right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container pb-5 <?php echo $postFlag ? '' : 'd-none' ?>">
            <p class="display-4">Messages</p>
            <?php
            require 'config.php';
            session_start();

            $sql = "SELECT * FROM Message WHERE group_id = '$id'";
            $res = mysqli_query($db, $sql);
            while ($post = mysqli_fetch_object($res)) {
                $sql0 = "SELECT * FROM User WHERE user_id='$post->user_id'";
                $res0 = mysqli_query($db, $sql0);
                $user = mysqli_fetch_object($res0);

                echo '<div class="card mb-3 bg-dark"><div class="card-header">' . $post->date . ', ' . $post->time . '</div><div class="card-body"><h5 class="card-title">' . $user->nickname . '</h5><p class="card-text">' . $post->text . '</p></div></div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="groupMembers" tabindex="-1" role="dialog" aria-labelledby="groupMembersLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="groupMembersLabel">Members</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                require 'config.php';
                session_start();

                $group_id = $_GET['id'];

                $sql = "SELECT * FROM GroupParticipants WHERE group_id = '$group_id' UNION SELECT * FROM GroupAdmin WHERE group_id='$id'";
                $res = mysqli_query($db, $sql);

                while ($obj = mysqli_fetch_object($res)) {
                    $sql1 = "SELECT * FROM User WHERE user_id='$obj->user_id'";
                    $res1 = mysqli_query($db, $sql1);
                    $user = mysqli_fetch_object($res1);

                    $result = '';

                    if ($adminFlag == true and !(array_key_exists($user->user_id, $admins))) {
                        $result = '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper mr-2"><img class="profile-pic" src="' . $user->profilepicture . '"></div><div><p class="">' . $user->nickname . '</p></div><div><a href="profile.php?id=' . $user->user_id . '" class="btn btn-primary btn-sm">Explore</a><button class="btn btn-success btn-sm mx-1" onclick="makeAdmin(' . $id . ', ' . $user->user_id . ')">Make Admin</button></div></div></div></div>';
                    } else if ($adminFlag == false and array_key_exists($user->user_id, $admins)) {
                        $result = '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper mr-2"><img class="profile-pic" src="' . $user->profilepicture . '"></div><div><p class="">' . $user->nickname . '<span class=" mx-2 badge badge-danger">Admin</span></p></div><div><a href="profile.php?id=' . $user->user_id . '" class="btn btn-primary btn-sm">Explore</a></div></div></div></div>';
                    } else if ($adminFlag == true and array_key_exists($user->user_id, $admins)) {
                        $result = '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper mr-2"><img class="profile-pic" src="' . $user->profilepicture . '"></div><div><p class="">' . $user->nickname . '<span class=" mx-2 badge badge-danger">Admin</span></p></div><div><a href="profile.php?id=' . $user->user_id . '" class="btn btn-primary btn-sm">Explore</a></div></div></div></div>';
                    } else {
                        $result = '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper mr-2"><img class="profile-pic" src="' . $user->profilepicture . '"></div><div><p class="">' . $user->nickname . '</p></div><div><a href="profile.php?id=' . $user->user_id . '" class="btn btn-primary btn-sm">Explore</a></div></div></div></div>';
                    }

                    echo $result;
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="invitePeople" tabindex="-1" role="dialog" aria-labelledby="invitePeopleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invitePeopleLabel">Invite People</h5>
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

                $sql4 = "SELECT * FROM GroupParticipants WHERE group_id='$id'";
                $res4 = mysqli_query($db, $sql4);
                $members = array();

                while ($row = mysqli_fetch_array($res4)) {
                    $members[$row['user_id']] = $row['user_id'];
                }

                while ($friend = mysqli_fetch_object($res)) {

                    if (!array_key_exists($friend->user_id2, $members) and !(array_key_exists($friend->user_id2, $admins))) {
                        $sql0 = "SELECT * FROM User WHERE user_id='$friend->user_id2'";
                        $res0 = mysqli_query($db, $sql0);
                        $user = mysqli_fetch_object($res0);
                        echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div><img src="' . $user->profilepicture . '" height="40"><p class="lead">' . $user->nickname . '</p></div><div><a href="inviteUser.php?group_id=' . $group_id . '&user_id=' . $user->user_id . '" class="btn btn-primary">Invite</a></div></div></div></div>';
                    }
                }
                $sql = "SELECT * FROM Group_ WHERE group_id='$id'";
                $res = mysqli_query($db, $sql);
                $group = mysqli_fetch_object($res);
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-dark" id="editGroup" tabindex="-1" role="dialog" aria-labelledby="editGroupLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="editGroupLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="updateGroup.php?group_id=<?php echo $id ?>" method="POST">
                    <div class="form-group">
                        <label for="groupPicture">Group Picture</label>
                        <input type="text" class="form-control" id="groupPicture" value="<?php echo $group->profilepicture ?>" aria-describedby="groupPictureHelp" name="profilepicture">
                    </div>
                    <div class="form-group">
                        <label for="groupTitle">Title</label>
                        <input type="text" class="form-control" id="groupTitle" value="<?php echo $group->name ?>" aria-describedby="groupTitleHelp" name="name">
                    </div>
                    <div class="form-group">
                        <label for="groupDesc">Description</label>
                        <textarea class="form-control" value="<?php echo $group->description ?>" name="description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="deleteGroup(<?php echo $id ?>)" class="btn btn-danger">Delete Group</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require 'include/footer.php';
?>