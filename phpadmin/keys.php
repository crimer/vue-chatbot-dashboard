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
    include "api_gutter.php";
    include "config.php";
    $page = "keys";
    include "menu.php";
    if (isset($CONFIG['api_key'])) {
        $keys = keyList();
        $keys = json_decode($keys, true);
    }
    echo ('<br>');
    echo ('<div class="container">');
    echo ('<table class="table table-hover table-striped align-middle">
            <thead class="table">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">key</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
         <tbody>');
    foreach ($keys['keys'] as $value) {
        echo ('<tr>
                <th scope="row">' . $value['id'] . '</th>
                <td>' . $value['key'] . '</td>');
        if ($value['key'] != $CONFIG['api_key']) {
            echo ('<td><a class="btn btn-danger btn-sm" href="keys.php?a=deletekey&id=' . $value['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i> Удалить</a></td>
            </tr>');
        } else {
            echo ('<td><button disabled class="btn btn-danger btn-sm" href="keys.php?a=' . $value['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i> Удалить</button></td>
            </tr>');
        }
    }
    echo ('</tbody>
    <caption><a class="btn btn-success btn-sm" href="keys.php?a=addkey"><i class="fa fa-plus-square" aria-hidden="true"></i> Добавить ключ</a></caption>
    </table>');
    echo ('</div>');

    ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>

</body>

</html>