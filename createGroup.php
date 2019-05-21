<?php
require 'include/header.php';
require 'include/search.php';
session_start();
?>


    <section class="bg-dark text-white p-5 justify-content-center">
        <div class="jumbotron bg-secondary">
            <div class="container col-6">
                <h1 class="display-3">Create Group</h1>
                <form action="addGroup.php" method="POST">
                    <div class="form-group">
                        <label for="groupPicture">Group Picture</label>
                        <input type="text" class="form-control" id="groupPicture" aria-describedby="groupPictureHelp" placeholder="Enter group picture's link" name="profilepicture">
                    </div>
                    <div class="form-group">
                        <label for="groupTitle">Title</label>
                        <input type="text" class="form-control" id="groupTitle" aria-describedby="groupTitleHelp" placeholder="Enter group title" name="name">
                    </div>
                    <div class="form-group">
                        <label for="groupDesc">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group justify-content-between">
                        <label for="privacy">Privacy</label>
                        <div class="input-group d-flex justify-content-between" id="privacy">
                            <div class="input-group-text">
                                <input type="radio" name="privacy" value="Public" id="public">
                                <label for="public" class="px-3">Public</label>
                                <input type="radio" name="privacy" value="Private" id="private">
                                <label for="private" class="px-3">Private</label>
                            </div>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
<?php
require 'include/footer.php';
session_start();
?>
