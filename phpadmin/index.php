<?php

include 'config.php';

$tree = file_get_contents($CONFIG['api_url'] . 'admin/chat/tree?key=' . $CONFIG['api_key']);
$tree = json_decode($tree, true);

function drawTree($data)
{
  echo ('<div class="h6 mt-3">' . $data['text'] . '</div>');
  echo ('<a class="btn btn-success btn-sm" href="" role="button">Добавить вариант</a>');
  echo (' <a class="btn btn-warning btn-sm" href="question_editor.php?id=' . $data['id'] . '" role="button">Изменить</a>');
  echo (' <a class="btn btn-danger btn-sm" href="" role="button">Удалить</a>');
  if (!$data['answers']) return;
  echo ('<ul>');
  foreach ($data['answers'] as $answer) {
    echo ('<li class="mt-3 border border-primary rounded p-2">');
    echo ('<div>' . $answer['text'] . '</div>');
    echo ('<a class="btn btn-warning btn-sm"href="answer_editor.php?id=' . $answer['id'] . '" role="button">Изменить</a>');
    echo (' <a class="btn btn-danger btn-sm" href="" role="button">Удалить</a>');
    drawTree($answer['question']);
    echo ('</li>');
  }
  echo ('</ul>');
}

?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <title>Chatbot admin</title>
</head>

<body>
  <div class="container">
    <h1 class="mb-4">Дерево диалога</h1>
    <?php drawTree($tree['tree']); ?>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>