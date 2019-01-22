<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>

<div class="container">
    <div class="row ">
        <div class="col-sm-6 offset-sm-3 login-form" >
            <?php if(isset($message)): ?>
                <?php foreach($message as $item): ?>
                    <div><?= $item ?></div><br>
                <?php endforeach; ?>
            <?php endif; ?>
            <h1 class="panel-header meme-title">SIGN IN</h1>
            <hr>
            <form action="?page=login" method="POST">
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">email</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="email" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">person</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="password" required/>
                    </div>
                </div>
                <input type="submit" value="Sign in" class="btn btn-danger btn-lg" />
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <br>...or if you don't have account
            <input type="button" value="Sign up" class="btn btn-secondary" onclick="document.location.href='?page=register';"/>
        </div>
    </div>
</div>

</body>
</html>

