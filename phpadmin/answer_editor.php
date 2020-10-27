<?php

include 'config.php';

$answers = file_get_contents($CONFIG['api_url'] . 'admin/chat/answers?key=' . $CONFIG['api_key']);
$answers = json_decode($answers, true);

$answer = null;

foreach ($answers['answers'] as $a) {
  if ($a['id'] == $_GET['id']) {
    $answer = $a;
    break;
  }
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
    <h1 class="mb-4">Редактор ответа</h1>
    <textarea class="form-control" aria-label="With textarea"><?php echo $answer['text'] ?></textarea>
    <div class="mt-3">
      <a class="btn btn-success btn-sm" href="" role="button">Сохранить</a>
      <a class="btn btn-warning btn-sm" href="index.php" role="button">Отменить</a>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>