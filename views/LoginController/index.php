<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php include(dirname(__DIR__).'/navbar.html'); ?>

<div class="container">
    <div class="row">
        <h1 class="col-12">HOME</h1>
        <p>
            <?= $text ?>
        </p>

        <?php
        if(isset($_SESSION) && !empty($_SESSION)) {
            print_r($_SESSION);
        }
        ?>

    </div>
</div>

</body>
</html>