<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>

<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3 login-form">
            <h1 class="panel-header meme-title">SIGN UP</h1>
            <hr>
            <form action="?page=register" method="POST" class="bckg">
                <div class="form-group row">
                    <label for="inputUsername" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">face</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="inputUsername" name="username" placeholder="username" required/>
                    </div>
                </div>
                <div class="form-group row">
                <label for="inputName" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">person</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="inputName" name="name" placeholder="name" required/>
                    </div>
                </div>
                <div class="form-group row">
                <label for="inputSurname" class="col-sm-1 col-form-label">
                        <i class="material-icons md-48">person</i>
                    </label>
                    <div class="col-sm-11 col-form-label">
                        <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="surname" required/>
                    </div>
                </div>
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
                        <i class="material-icons md-48">https</i>
                    </label>
                    <div class="col-sm-11">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="password" required/>
                    </div>
                <input type="submit" value="Sign up" class="btn btn-danger btn-lg" />
                </div>
            </form>
            <hr>
            <?php if(isset($message)): ?>
                <?php foreach($message as $item): ?>
                    <div><?= $item ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>

