<!doctype html>
<?php require_once ("comments_logic.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Комментарии</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-6">
                <form method="post" action="">
                    <textarea class="form-control col mt-5" name="comment_content" placeholder="Введите комментарий..."></textarea>
                    <input class="btn btn-primary mt-2" type="submit">
                </form>
            </div>
            <?php foreach ($stmt as $comment): ?>
            <div class="card mt-3 bg-opacity-25 bg-success pb-4" style="width: 924px;">
                <div class="ms-4 mt-4">
                    <p><?=htmlspecialchars($comment[0])?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>