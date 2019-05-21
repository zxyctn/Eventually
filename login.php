<?php
require 'include/header.php';
require 'include/search.php';
session_start();
?>

    <section class="bg-dark text-white p-5 justify-content-center">
        <div class="jumbotron bg-secondary">
            <div class="container col-6">
                <h1 class="display-3">Sign In</h1>
                <div class="card bg-danger my-3 <?php echo ($_GET['f'] == 1) ? '' : 'd-none' ?>">
                    <div class="card-body p-2">
                        Invalid password or e-mail
                    </div>
                </div>
                <form action="verifyUser.php" method="GET">
                    <div class="form-group">
                        <label for="userEmail">Email address</label>
                        <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">Password</label>
                        <input type="password" class="form-control" id="userPassword" placeholder="Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </section>
<?php
require 'include/footer.php';
?>