<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__) . '/head.html'); ?>

<body>
<?php include(dirname(__DIR__) . '/navbar.html'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-right">
            <?php
            if(isset($_SESSION) && !empty($_SESSION)) {
                echo '<p>Logged as '. $_SESSION["username"].'. To logout click <a href=\'?page=logout\'>here</a></p>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <br>
            <div id="memeCanvas">
                <div class="row">
                    <div class="col-md-8 generated-meme">

                    </div>
                    <div class="col-md-4">
                        <form action="?page=generated" method="POST" ENCTYPE="multipart/form-data">
                            <div class="form-group">
                                <label for="toptext">Top Text</label>
                                <input type="text" name="toptext" id="toptext" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="bottomtext">Bottom Text</label>
                                <input type="text" name="bottomtext" id="bottomtext" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" value="Upload Your Image" class="btn btn-warning form-control" id="chooseImage">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="SAVE It!" class="btn btn-danger form-control">
                            </div>
                        </form>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>