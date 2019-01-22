<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>
<?php include(dirname(__DIR__).'/navbar.html') ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3 upload-form">
            <p class="meme-title">UPLOAD YOUR MEME</p>
            <form action="?page=upload" method="POST" ENCTYPE="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputTitle" name="title" placeholder="title" required/>
                    </div>
                </div>
                <div class="form-group row upload">
                    <input type="file" name="file" value=""/><br/><br/>
                </div>
                    <input type="submit" value="Upload" class="btn btn-danger"/>
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