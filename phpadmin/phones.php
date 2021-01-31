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
    include "api_gutter.php";
    if (isset($CONFIG['api_key'])) {
        $phones = phoneList();
        $phones = json_decode($phones, true);
        //print_r($phones);
    }
    echo ('<br>');
    echo ('<div class="container">');
    echo ('<table class="table table-hover table-striped table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Номер телефона</th>
                    <th scope="col">История</th>
                    <th scope="col">Дата</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>');
    foreach ($phones['phones'] as $key => $value) {
        echo ('        <tr>
            <th scope ="row">' . $key . '</th>
            <td>' . $value['phone'] . '</td>
            <td>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalHistory' . $value['id'] . '"><i class="fa fa-history" aria-hidden="true"></i> Посмотреть историю</button>

                <div class="modal fade" id="ModalHistory' . $value['id'] . '" role="dialog" aria-modal="true" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">История ' . $value['phone'] . '</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating">
                                    <textarea class="form-control" style="height: 500px" required readonly>История:
' . $value['history'] . '
                                    </textarea>
                                </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                    </div>
                </div>

            </td>
            <td>' . $value['created_at'] . '</td>
            <th><button class="btn btn-danger btn-sm" href=""><i class="fa fa-trash" aria-hidden="true"></i> Удалить</button></th>
        </tr>');
    }
    echo ('</tbody>
            </table>');
    echo ('</div>');

    ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>

</body>

</html>