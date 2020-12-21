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

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container container-fluid">
            <a class="navbar-brand">VVSU-Chatbot CP</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Дерево диалога</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="keys.php">Ключи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="phones.php">Телефоны</a>
                        </li>
                    </ul>
                </div>
            </div>
            <form method="post" action="/">
                <input type="hidden" name="a" value="logout">
                <button type="submit" href="?a=logout" class="btn btn btn-secondary">Выход</button>
            </form>
        </div>
    </nav>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>

    <script>
        // Save scroll position
        $(document).ready(function() {

            if (localStorage.getItem("cpchatbot-quote-scroll") != null) {
                $(window).scrollTop(localStorage.getItem("cpchatbot-quote-scroll"));
            }

            $(window).on("scroll", function() {
                localStorage.setItem("cpchatbot-quote-scroll", $(window).scrollTop());
            });

        });
    </script>
</body>

</html>