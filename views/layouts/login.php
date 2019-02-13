<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial scale=1.0, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="/frontend/css/reset.css">
    <link href="/frontend/img/favicon.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i" rel="stylesheet">
    <link href="/frontend/fonts/fontawesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/frontend/css/main.css">
    <link rel="stylesheet" href="/frontend/css/header.css">
    <link rel="stylesheet" href="/frontend/css/content.css">
    <link rel="stylesheet" href="/frontend/css/form.css">
    <link rel="stylesheet" href="/frontend/css/footer.css">
    <script src="/frontend/js/jquery-3.3.1.min.js"></script>
    <script src="/frontend/js/script.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<main id="page-content" data-content-type="login">
    <?= $content ?>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>