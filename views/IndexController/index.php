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
        <p>
            <?= $text ?>
        </p>
        </div>
    </div>
</div>

</body>
</html>