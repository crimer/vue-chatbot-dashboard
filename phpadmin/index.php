<?php

include 'config.php';
include 'api_gutter.php';

$tree = file_get_contents($CONFIG['api_url'] . 'admin/chat/tree?key=' . $CONFIG['api_key']);
$tree = json_decode($tree, true);

function drawTree($data)
{
  echo ('<div class="h6 mt-3">QUESTION (' . $data['id'] . ') ' . $data['text'] . '</div>');
  echo ('<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAnswerModal" data-id="' . $data['id'] . '">Добавить вариант</button>');
  echo (' <a class="btn btn-warning btn-sm" href="question_editor.php?id=' . $data['id'] . '" role="button">Изменить</a>');
  echo (' <a class="btn btn-danger btn-sm" href="" role="button">Удалить</a>');
  if (!$data['answers']) return;
  echo ('<ul>');
  foreach ($data['answers'] as $answer) {
    echo ('<li class="mt-3 border border-primary rounded p-2">');
    echo ('<div>ANSWER ' . $answer['text'] . '</div>');
    echo ('<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAnswerModal">Редактировать вариант</button>');
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

  <!-- Modal -->
  <div class="modal fade" id="addAnswerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form action="/">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Добавление варианта ответа</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="a" value="addanswer">
            <input class="data_id" type="hidden" name="question_id" value="addanswer">
            <textarea name="text" class="form-control" aria-label="With textarea"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="editAnswerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form action="/">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Редактирование варианта ответа</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="a" value="editanswer">
            <input class="data_id" type="hidden" name="answer_id" value="">
            <textarea name="text" class="form-control" aria-label="With textarea"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    var addAnswerModal = document.getElementById('addAnswerModal')
    addAnswerModal.addEventListener('show.bs.modal', function(event) {
      // Button that triggered the modal
      var button = event.relatedTarget
      // Extract info from data-* attributes
      var id = button.getAttribute('data-id')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      //var modalTitle = addAnswerModal.querySelector('.modal-title')
      //var modalBodyInput = addAnswerModal.querySelector('.modal-body input')

      var modalId = addAnswerModal.querySelector('.data_id')

      modalId.value = id

      //modalTitle.textContent = 'New message to ' + recipient
      //modalBodyInput.value = recipient
    })
  </script>
</body>

</html>