<?php

use yii\helpers\Html;

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title><?= Html::encode($this->title) ?></title>

    <!-- Vendor css -->
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Slim CSS -->
    <link rel="stylesheet" href="/../css/slim.css">

</head>
<body>

<?=$content?>

<script src="/lib/jquery/js/jquery.js"></script>
<script src="/lib/popper.js/js/popper.js"></script>
<script src="/lib/bootstrap/js/bootstrap.js"></script>

<script src="/js/slim.js"></script>

</body>
</html>