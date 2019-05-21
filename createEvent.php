<?php
require 'include/header.php';
require 'include/search.php';
session_start();
?>
<section class="bg-dark text-white p-5 justify-content-center">
    <div class="jumbotron bg-secondary">
        <div class="container col-6">
            <h1 class="display-3">Create Event</h1>
            <form action="addEvent<?php echo $_GET['f'] == 1 ? '2' : ''?>.php?group_id=<?php echo $_GET['group_id'] ?>&f=<?php echo $_GET['f'] ?>" method="POST">
                <div class="form-group">
                    <label for="eventPicture">Event Picture</label>
                    <input type="text" class="form-control" id="eventPicture" aria-describedby="eventPictureHelp" placeholder="Enter event picture's link" name="profilepicture">
                </div>
                <div class="form-group">
                    <label for="eventTitle">Title</label>
                    <input type="text" class="form-control" id="eventTitle" aria-describedby="eventTitleHelp" placeholder="Enter event title" name="title">
                </div>
                <div class="form-group">
                    <label for="eventCategory">Category</label>

                    </button>
                    <select class="custom-select" name="category">
                        <option selected>Choose category</option>
                        <?php
                        require 'config.php';
                        session_start();

                        $sql = "SELECT * FROM Category";
                        $res = mysqli_query($db, $sql);

                        while ($cat = mysqli_fetch_object($res)) {
                            echo '<option value="' . $cat->name . '">' . $cat->name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="eventDesc">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="maxmembers">Capacity (people)</label>
                    <input type="number" class="form-control" id="maxmembers" name="maxnumberofmember">
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group col-6 pr-2 pl-0">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country">
                    </div>
                    <div class="form-group col-6 pl-2 pr-0">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group col-6 pr-2 pl-0">
                        <label for="eventDate">Date</label>
                        <input type="date" class="form-control" id="eventDate" name="date" required>
                    </div>
                    <div class="form-group col-6 pl-2 pr-0">
                        <label for="eventTime">Time</label>
                        <input type="time" class="form-control" id="eventDate" name="time" required>
                    </div>
                </div>
                <label for="privacy">Privacy</label>
                <div class="form-group d-flex justify-content-between">
                    <div class="">
                        <div class="input-group" id="privacy">
                            <div class="input-group-text">
                                <input type="radio" name="privacy" value="Public" id="public">
                                <label for="public" class="px-3">Public</label>
                                <input type="radio" name="privacy" value="Private" id="private">
                                <label for="private" class="px-3">Private</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
require 'include/footer.php';
session_start();
?>