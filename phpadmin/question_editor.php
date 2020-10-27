<?php

include 'config.php';

$questions = file_get_contents($CONFIG['api_url'] . 'admin/chat/questions?key=' . $CONFIG['api_key']);
$questions = json_decode($questions, true);

$question = null;

foreach ($questions['questions'] as $q) {
  if ($q['id'] == $_GET['id']) {
    $question = $q;
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
    <h1 class="mb-4">Редактор вопроса</h1>
    <textarea class="form-control" aria-label="With textarea"><?php echo $question['text'] ?></textarea>
    <div class="mt-3">
      <a class="btn btn-success btn-sm" href="" role="button">Сохранить</a>
      <a class="btn btn-warning btn-sm" href="index.php" role="button">Отменить</a>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>