<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/style.css" media="screen" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
    <title>Document</title>
</head>
<body>

<?php include 'application/views/menu_view.php'; ?>

<div id="wrapper">
<!--    --><?php //var_dump($content_view); ?>
    <?php include 'application/views/' . $content_view; ?>
</div>
<script src="../../js/tree.js"></script>

<?php include 'application/views/footer.php'; ?>



