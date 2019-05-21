<?php
require 'include/header.php';
require 'include/search.php';
session_start();
?>

    <section class="bg-dark text-white p-5 justify-content-center">
        <div class="jumbotron bg-secondary">
            <div class="container col-6">
                <h1 class="display-3">Sign Up</h1>
                <form action="registerUser.php" method="POST">
                    <div class="form-group">
                        <label for="userPicture">Profile Picture</label>
                        <input type="text" class="form-control" id="userPicture" aria-describedby="userPictureHelp" placeholder="Enter profile picture's link" name="profilepicture">
                    </div>
                    <div class="form-group">
                        <label for="userName">Username*</label>
                        <input type="text" class="form-control" id="userName" placeholder="Enter username" name="nickname" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="firstName">First name*</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Enter first name" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last name*</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Enter last name" name="lastname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email address*</label>
                        <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">Password*</label>
                        <input type="password" class="form-control" id="userPassword" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="userBirthDate">Birth Date</label>
                        <input type="date" class="form-control" id="userBirthDate" name="birthday">
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <div class="col-4 p-0">
                            <label for="gender">Gender</label>
                            <div class="input-group" id="gender">
                                <div class="input-group-text">
                                    <input type="radio" name="gender" value="Male" id="male">
                                    <label for="male" class="px-2">Male</label>
                                    <input type="radio" name="gender" value="Female" id="female">
                                    <label for="female" class="px-2">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 p-0">
                            <label for="phoneNo">Phone number</label>
                            <input type="tel" class="form-control" id="phoneNo" placeholder="Enter Phone number" name="phone_no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
<?php
require 'include/footer.php';
session_start();
?>
