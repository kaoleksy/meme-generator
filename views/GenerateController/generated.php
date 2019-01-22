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
                    <div class="col-md-7 offset-1 generated-meme">

                    </div>
                    <div class="col-md-3">
                        <form method="POST" ENCTYPE="multipart/form-data">
                            <div class="form-group">
                                <p>Your meme is ready! Press the button to see it in your memes gallery -> </p>
                            </div>
                            <div class="form-group">
                            </div>
                        </form>
                        <input type="submit" value="Go to my memes!" class="btn btn-danger form-control" onclick="document.location.href='?page=your_memes';">
                        <br><br>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>

