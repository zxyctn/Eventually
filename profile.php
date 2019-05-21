<?php
require 'include/header.php';
require 'include/search.php';
session_start();
?>


<section class="bg-dark text-white p-5">
    <div class="jumbotron bg-secondary">
        <div class="container col-6">
            <h1 class="display-3">Profile</h1>
            <div class="d-flex justify-content-between">
                <div class="text-center">
                    <?php
                    require 'config.php';
                    session_start();

                    $user_id = $_GET['id'];
                    $sql = "SELECT * FROM User WHERE user_id = '$user_id'";

                    $res = mysqli_query($db, $sql);
                    $user = mysqli_fetch_object($res);
                    ?>
                    <div class="image-cropper2"><img class="profile-pic" src="<?php echo $user->profilepicture ?>"></div>

                    <h1 class="lead"><strong><?php session_start();
                                                echo $user->firstname ?>, <?php echo $user->lastname ?></strong></h1>
                    <div class="my-3 d-flex justify-content-between">
                        <a href="" data-toggle="modal" data-target="#usersGroups" class="btn px-4 btn-outline-light">Groups</a>
                        <a href="" data-toggle="modal" data-target="#usersEvents" class="btn px-4 btn-outline-light">Events</a>
                        <a href="" data-toggle="modal" data-target="#usersFriends" class="btn px-4 btn-outline-light">Friends</a>

                    </div>
                    <?php
                    require 'config.php';
                    session_start();

                    $login_user_id = $_SESSION['login_user_id'];
                    $friendFlag = false;

                    $sql = "SELECT user_id2 FROM UserFriend WHERE user_id1='$user->user_id'";
                    $res = mysqli_query($db, $sql);
                    $friends = array();

                    while ($row = mysqli_fetch_array($res)) {
                        $friends[$row['user_id2']] = $row['user_id2'];
                    }

                    if (array_key_exists($login_user_id, $friends))
                        $friendFlag = true;

                    ?>
                    <button class="mb-3 btn btn-block btn-primary <?php echo ($_SESSION['login_user_id'] == $user->user_id or $friendFlag == true) ? 'd-none' : '' ?>" onclick="addFriend(<?php echo $_SESSION['login_user_id'] ?>, <?php echo $user->user_id ?>)">Add Friend</button>
                    <button class="mb-3 btn btn-block btn-danger <?php echo ($friendFlag == false and isset($_SESSION['login_user_id'])) ? 'd-none' : '' ?>" onclick="removeFriend(<?php echo $_SESSION['login_user_id'] ?>, <?php echo $user->user_id ?>)">Remove Friend</button>
                    <button data-toggle="modal" data-target="#exampleModal" class="mb-3 btn btn-block btn-warning <?php echo $_SESSION['login_user_id'] == $user->user_id ? '' : 'd-none' ?>">Edit</button>
                </div>
                <div>
                    <h1 class="lead"><strong>Username: </strong><?php echo $user->nickname ?></h1>
                    <h1 class="lead"><strong>E-mail: </strong><?php echo $user->email ?></h1>
                    <h1 class="lead"><strong>Phone no: </strong><?php echo $user->phone_no ?></h1>
                    <h1 class="lead"><strong>Address: </strong><?php echo $user->address ?></h1>
                    <h1 class="lead"><strong>Birth Date: </strong><?php echo $user->birthday ?></h1>
                    <h1 class="lead"><strong>Gender: </strong><?php echo $user->gender ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-dark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="updateProfile.php?user_id=<?php echo $user->user_id ?>" method="POST">
                        <div class="form-group">
                            <label for="profilePicture">Profile Picture</label>
                            <input type="text" class="form-control" id="profilePicture" aria-describedby="profilePictureHelp" placeholder="Enter profile picture's link" name="profilepicture" value="<?php echo $user->profilepicture ?>">
                        </div>
                        <!-- <div class="form-group">
                                <label for="userName">Username</label>
                                <input type="text" class="form-control" id="userName" value="<?php echo $user->nickname ?>" name="nickname">
                            </div> -->
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstName" value="<?php echo $user->firstname ?>" name="firstname">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" value="<?php echo $user->lastname ?>" name="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userEmail">Email address</label>
                            <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" value="<?php echo $user->email ?>" name="email">
                        </div>
                        <div class="form-group">
                            <label for="userPassword">Password</label>
                            <input type="password" class="form-control" id="userPassword" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="userBirthDate">Birth Date</label>
                            <input type="date" class="form-control" id="userBirthDate" name="birthday" value="<?php echo $user->birthday ?>">
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="col-7 p-0">
                                <label for="phoneNo">Phone number</label>
                                <input type="tel" class="form-control" id="phoneNo" value="<?php echo $user->phone_no ?>" name="phone_no">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $user->address ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="usersFriends" tabindex="-1" role="dialog" aria-labelledby="usersFriendsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersFriendsLabel">Friends</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                require 'config.php';
                session_start();

                $login_user_id = $_SESSION['login_user_id'];
                $sql = "SELECT * FROM UserFriend WHERE user_id1 = '$user_id'";
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

<div class="modal fade" id="usersGroups" tabindex="-1" role="dialog" aria-labelledby="usersGroupsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersGroupsLabel">Groups</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                require 'config.php';
                session_start();

                $login_user_id = $_SESSION['login_user_id'];
                $sql = "SELECT * FROM GroupParticipants natural join Group_ WHERE user_id = '$user_id'";
                $res = mysqli_query($db, $sql);

                while ($group = mysqli_fetch_object($res)) {
                    echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper"><img class="profile-pic" src="' . $group->profilepicture . '"></div><div><p class="lead">' . $group->name . '</p></div><div><a href="group.php?id=' . $group->group_id . '" class="btn btn-primary">Explore</a></div></div></div></div>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="usersEvents" tabindex="-1" role="dialog" aria-labelledby="usersEventsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersEventsLabel">Events</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                require 'config.php';
                session_start();

                $login_user_id = $_SESSION['login_user_id'];
                $sql = "SELECT * FROM EventParticipants natural join Event WHERE user_id = '$user_id' and usersDecision='coming' UNION SELECT * FROM EventParticipants natural join Event WHERE user_id = '$user_id' and usersDecision='interested'";
                $res = mysqli_query($db, $sql);

                while ($event = mysqli_fetch_object($res)) {
                    echo '<div class="card my-1"><div class="card-body"><div class="d-flex justify-content-between"><div class="image-cropper"><img class="profile-pic" src="' . $event->profilepicture . '"></div><div><p class="lead">' . $event->title . '</p></div><div><a href="event.php?id=' . $event->event_id . '" class="btn btn-primary">Explore</a></div></div></div></div>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
require 'include/footer.php';
session_start();
?>