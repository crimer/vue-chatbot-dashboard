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
        $keys = keyList($CONFIG['api_key']);
        $keys = json_decode($keys, true);
    }
    echo ('<table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">key</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>');
    foreach ($keys['keys'] as $key => $value) {
        echo ('<tr>
                <th scope="row">' . $value['id'] . '</th>
                <td>' . $value['key'] . '</td>
                <td><a class="btn btn-danger btn-sm" data-toggle="modal" href="keys.php?deletekey=' . $value['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i> Удалить</a></td>
            </tr>');
    }
    echo ('</tbody>
    <tfoot>
    <tr>
    <th scope="row"> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addKeyModal" data-id="' . $CONFIG['api_key'] . '"><i class="fa fa-plus-square" aria-hidden="true"></i> Добавить вариант</button></th>
    <th></th><th></th></tr></tfoot>
    </table>');


    ?>

    <!-- Modal Add Answers-->
    <div class="modal fade" id="addKeyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" action="/">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавление варианта ответа</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Вы уверены что хотите удалить этот вопрос?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal del -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form method="post" action="/">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Удаление</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Вы уверены что хотите удалить этот вопрос?</p>
                        <input class="data_a" type="hidden" name="a" value="">
                        <input class="data_id" type="hidden" name="id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>

</body>

</html>