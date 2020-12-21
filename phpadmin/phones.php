<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fork-awesome.min.css">

    <title>Chatbot admin</title>
</head>

<style>
    ul,
    #treeUL {
        list-style-type: none;
    }

    #treeUL {
        margin: 0;
        padding: 0;
    }

    .caret {
        cursor: pointer;
        user-select: none;
    }

    .caret::before {
        content: "\25B6";
        color: black;
        display: inline-block;
        margin-right: 6px;
    }

    .caret-down::before {
        transform: rotate(90deg);
    }

    .nested {
        display: none;
    }

    .active {
        display: block;
    }
</style>

<body>
    <?php
    $page = "phones";
    include "menu.php";
    ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>

</body>

</html>