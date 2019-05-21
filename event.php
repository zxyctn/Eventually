<?php
require 'include/header.php';
require 'config.php';
session_start();

$event_id = $_GET['id'];
$login_user_id = $_SESSION['login_user_id'];
$login_nickname = $_SESSION['login_username'];

$user_id = $_SESSION['login_user_id'];
$sql0 = "SELECT * FROM EventParticipants WHERE user_id='$user_id' AND event_id='$event_id'";
$res0 = mysqli_query($db, $sql0);
$userEvent = mysqli_fetch_object($res0);

$sql = "SELECT * FROM Event WHERE event_id = '$event_id'";
$res = mysqli_query($db, $sql);
$event = mysqli_fetch_object($res);

$sql40 = "SELECT * FROM EventParticipants WHERE event_id='$event_id' AND user_id='$login_user_id'";
$res40 = mysqli_query($db, $sql40);
$memberFlagStep1 = mysqli_fetch_object($res40);

$sql353 = "SELECT * FROM EventHost WHERE event_id='$event->event_id' AND host_id='$login_user_id'";
$res353 = mysqli_query($db, $sql353);
$test = mysqli_fetch_object($res353);

$sql10 = "SELECT * FROM EventOrganizes WHERE event_id = '$event_id'";
$res10 = mysqli_query($db, $sql10);
$group = mysqli_fetch_object($res10);

$sql76 = "SELECT * FROM GroupAdmin WHERE group_id='$group->group_id' AND user_id='$login_user_id'";
$res76 = mysqli_query($db, $sql76);
$adminUser = mysqli_fetch_object($res76);

$adminFlag = false;
if ($adminUser->user_id > 0)
    $adminFlag = true;

$hostFlag = false;
if ($test->host_id > 0)
    $hostFlag = true;

$memberFlag = false;
if ($memberFlagStep1->user_id > 0)
    $memberFlag = true;
if ($adminFlag or $hostFlag)
    $memberFlag = true;
?>


<div class="p-0 m-0">
    <div class="d-flex align-content-end flex-wrap" style="background-image: url('<?php echo $event->profilepicture ?>'); height: 500px; width: 100%; background-position: center center; background-size: 100%; background-repeat: no-repeat">
        <div class="d-flex px-5 align-items-center text-center" style="width:100%; background: rgba(255, 255, 255, 0.6);">
            <div class="m-0 p-0 col-3 d-flex">
                <div class="<?php echo ($hostFlag or $adminFlag) ? '' : 'd-none' ?>">
                    <button data-toggle="modal" data-target="#editEvent" class="btn px-1 btn-warning <?php echo $hostFlag ? '' : 'd-none' ?>">Edit</button>
                    <button data-toggle="modal" data-target="#editEvent2" class="btn px-1 btn-warning <?php echo $adminFlag ? '' : 'd-none' ?>">Edit</button>
                </div>
                <div>
                    <p class="lead mb-0" style="color: purple">
                        <?php
                        $sql1 = "SELECT * FROM EventHost WHERE event_id = '$event_id'";
                        $res1 = mysqli_query($db, $sql1);
                        $host = mysqli_fetch_object($res1);

                        $sql2 = "SELECT * FROM Group_ WHERE group_id = '$group->group_id'";
                        $res2 = mysqli_query($db, $sql2);
                        $groupName = mysqli_fetch_object($res2);

                        $sql2 = "SELECT * FROM User WHERE user_id = '$host->host_id'";
                        $res2 = mysqli_query($db, $sql2);
                        $hostName = mysqli_fetch_object($res2);

                        echo $event->date;
                        ?>
                    </p>
                    <p class="lead"><?php echo $event->city . ', ' . $event->country ?></p>
                </div>
            </div>
            <div class="m-0 p-0 text-center col-6">
                <h1 class=""><?php echo $event->title ?></h1>
            </div>
            <div class="m-0 p-0 col-3 d-flex justify-content-center ">
                <div class="px-2 my-auto">
                    <p class="lead" style="color: purple"><?php echo $event->privacy ?></p>
                </div>
                <div>
                    <p class="lead mb-0" style="color: red"><strong>Hosted By:</strong></p>
                    <?php
                    if ($groupName->name != '')
                        echo '<p class="lead">' . $groupName->name . '</p>';
                    else
                        echo '<p class="lead">' . $hostName->firstname . ' ' . $hostName->lastname  . '</p>';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-secondary text-white">
        <div class="d-flex container pt-5 px-0 justify-content-between">
            <div class="col-5">
                <h1 class="display-4">Description</h1>
                <p><?php echo $event->description ?></p>
            </div>
            <div class="col-4 py-5 <?php echo $memberFlag ? '' : 'd-none' ?>">
                <button id="coming" onclick="updateChoice('coming', <?php echo $event_id ?>, <?php echo $user_id ?>)" class="btn btn-lg btn-block <?php echo $userEvent->usersDecision == 'coming' ? 'btn-success' : 'btn-dark' ?>" <?php echo $userEvent->usersDecision == 'coming' ? 'disabled' : '' ?>>Going</button>
                <button id="interested" onclick="updateChoice('interested', <?php echo $event_id ?>, <?php echo $user_id ?>)" class="btn btn-lg btn-block <?php echo $userEvent->usersDecision == 'interested' ? 'btn-primary' : 'btn-dark' ?>" <?php echo $userEvent->usersDecision == 'interested' ? 'disabled' : '' ?>>Interested</button>
                <button id="not_coming" onclick="updateChoice('not coming', <?php echo $event_id ?>, <?php echo $user_id ?>)" class="btn btn-lg btn-block <?php echo $userEvent->usersDecision == 'not coming' ? 'btn-danger' : 'btn-dark' ?>" <?php echo $userEvent->usersDecision == 'not coming' ? 'disabled' : '' ?>>Not Going</button>
            </div>
        </div>
        <div class="container pb-5 <?php echo $memberFlag ? '' : 'd-none' ?>">
            <p class="display-4">Comments</p>

            <form action="addComment.php?event_id=<?php echo $event_id ?>&user_id=<?php echo $_SESSION['login_user_id'] ?>" method="POST" class="col-6 m-0 p-0">
                <textarea class="form-control text-white" name="content" style="height: 100px; background: rgba(0, 0, 0, 0.05)" required></textarea>
                <button type="submit" class="btn btn-primary my-2" style="float: right">Submit</button>
            </form>

            <?php
            require 'config.php';
            session_start();

            $sql0 = "SELECT * FROM EventComment WHERE event_id='$event->event_id'";
            $res0 = mysqli_query($db, $sql0);
            $c = 0;
            while ($comment = mysqli_fetch_object($res0)) {
                $sql1 = "SELECT * FROM UserComment WHERE comment_id='$comment->comment_id'";
                $res1 = mysqli_query($db, $sql1);
                $user_id = mysqli_fetch_object($res1);

                $sql2 = "SELECT * FROM User WHERE user_id='$user_id->user_id'";
                $res2 = mysqli_query($db, $sql2);
                $user = mysqli_fetch_object($res2);

                $sql3 = "SELECT * FROM Comment WHERE comment_id='$comment->comment_id'";
                $res3 = mysqli_query($db, $sql3);
                $content = mysqli_fetch_object($res3);
                $content_id_html = "'content$c'";

                echo isset($_SESSION['login_user_id']) ? '<span class="d-flex align-items-center col-6 my-1" style="background: rgba(255, 255, 255, 0.5); border-radius: 10px"><h1 class="lead px-2" style="color:blue">' . $user->nickname . '</h1><p class="lead">' . $content->comment . '</p>' . '<button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#exampleModal' . $c . '">Reply</button><div class="modal fade text-dark" id="exampleModal' . $c . '" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Reply</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p>' . $content->comment . '</p><textarea class="form-control text-dark" name="comment_content" id="content' . $c . '" required></textarea></div><div class="modal-footer"><button type="button" onclick="addReply(' . $content->comment_id . ', document.getElementById(' . $content_id_html . ').value)" class="btn btn-primary">Reply</button><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div></div></div></div>' . '</span>' : '<span class="d-flex align-items-center col-6 my-2" style="background: rgba(255, 255, 255, 0.5); border-radius: 10px"><h1 class="lead px-2" style="color:blue">' . $user->nickname . '</h1><p class="lead">' . $content->comment . '</p></span>';

                $sql4 = "SELECT * FROM CommentReply WHERE c_id_Replied='$comment->comment_id'";
                $res4 = mysqli_query($db, $sql4);
                while ($reply = mysqli_fetch_object($res4)) {
                    $sql5 = "SELECT * FROM Comment WHERE comment_id='$reply->c_id_Reply'";
                    $res5 = mysqli_query($db, $sql5);
                    $content_reply = mysqli_fetch_object($res5);

                    $sql30 = "SELECT * FROM UserComment WHERE comment_id='$content_reply->comment_id'";
                    $res30 = mysqli_query($db, $sql30);
                    $replier_id = mysqli_fetch_object($res30);

                    $sql33 = "SELECT * FROM User WHERE user_id='$replier_id->user_id'";
                    $res33 = mysqli_query($db, $sql33);
                    $replier = mysqli_fetch_object($res33);

                    echo '<span class="ml-5 my-1 d-flex align-items-center col-6" style="background: rgba(255, 255, 255, 0.5); border-radius: 10px"><h1 class="lead px-2" style="color:blue">' . $replier->nickname . '</h1><p class="lead">' . $content_reply->comment . '</p></span>';
                }
                $c++;
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade text-dark" id="editEvent" tabindex="-1" role="dialog" aria-labelledby="editEventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="editEventLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="updateEvent.php?event_id=<?php echo $event->event_id ?>" method="POST">
                    <div class="form-group">
                        <label for="eventPicture">Event Picture</label>
                        <input type="text" class="form-control" value="<?php echo $event->profilepicture ?>" id="eventPicture" aria-describedby="eventPictureHelp" name="profilepicture">
                    </div>
                    <div class="form-group">
                        <label for="eventTitle">Title</label>
                        <input type="text" class="form-control" id="eventTitle" aria-describedby="eventTitleHelp" value="<?php echo $event->title ?>" name="title">
                    </div>
                    <div class="form-group">
                        <label for="eventDesc">Description</label>
                        <textarea class="form-control" value="<?php echo $event->description ?>" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="maxmembers">Capacity (people)</label>
                        <input type="number" class="form-control" id="maxmembers" value="<?php echo $event->maxnumberofmember ?>" name="maxnumberofmember">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-group col-6 pr-2 pl-0">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" value="<?php echo $event->country ?>" id="country" name="country">
                        </div>
                        <div class="form-group col-6 pl-2 pr-0">
                            <label for="city">City</label>
                            <input type="text" class="form-control" value="<?php echo $event->city ?>" id="city" name="city">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-group col-6 pr-2 pl-0">
                            <label for="eventDate">Date</label>
                            <input type="date" class="form-control" id="eventDate" value="<?php echo $event->date ?>" name="date" required>
                        </div>
                        <div class="form-group col-6 pl-2 pr-0">
                            <label for="eventTime">Time</label>
                            <input type="time" class="form-control" id="eventDate" value="<?php echo $event->time ?>" name="time" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="deleteEvent(<?php echo $event->event_id ?>)" class="btn btn-danger">Delete Event</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-dark" id="editEvent2" tabindex="-1" role="dialog" aria-labelledby="editEvent2Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="editEvent2Label">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="updateEvent.php?event_id=<?php echo $event->event_id ?>" method="POST">
                    <div class="form-group">
                        <label for="eventPicture">Event Picture</label>
                        <input type="text" class="form-control" value="<?php echo $event->profilepicture ?>" id="eventPicture" aria-describedby="eventPictureHelp" name="profilepicture">
                    </div>
                    <div class="form-group">
                        <label for="eventTitle">Title</label>
                        <input type="text" class="form-control" id="eventTitle" aria-describedby="eventTitleHelp" value="<?php echo $event->title ?>" name="title">
                    </div>
                    <div class="form-group">
                        <label for="eventDesc">Description</label>
                        <textarea class="form-control" value="<?php echo $event->description ?>" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="maxmembers">Capacity (people)</label>
                        <input type="number" class="form-control" id="maxmembers" value="<?php echo $event->maxnumberofmember ?>" name="maxnumberofmember">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-group col-6 pr-2 pl-0">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" value="<?php echo $event->country ?>" id="country" name="country">
                        </div>
                        <div class="form-group col-6 pl-2 pr-0">
                            <label for="city">City</label>
                            <input type="text" class="form-control" value="<?php echo $event->city ?>" id="city" name="city">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-group col-6 pr-2 pl-0">
                            <label for="eventDate">Date</label>
                            <input type="date" class="form-control" id="eventDate" value="<?php echo $event->date ?>" name="date" required>
                        </div>
                        <div class="form-group col-6 pl-2 pr-0">
                            <label for="eventTime">Time</label>
                            <input type="time" class="form-control" id="eventDate" value="<?php echo $event->time ?>" name="time" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="deleteEvent(<?php echo $event->event_id ?>)" class="btn btn-danger">Delete Event</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
require 'include/footer.php';
?>