<?php

include 'config.php';
include 'api_gutter.php';

$tree = file_get_contents($CONFIG['api_url'] . 'admin/chat/tree?key=' . $CONFIG['api_key']);
$tree = json_decode($tree, true);

function drawTree($data)
{
  echo ('<div class="h6 mt-3">QUESTION (' . $data['id'] . ') ' . $data['text'] . '</div>');
  echo ('<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAnswerModal" data-id="' . $data['id'] . '">Добавить вариант</button>');
  echo (' <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editQuestionModal" data-id="' . $data['id'] . '" data-text="' . htmlspecialchars($data['text']) . '">Изменить</a>');
  echo (' <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="' . $data['id'] . '" data-a="deletequestion">Удалить</a>');
  if (!$data['answers']) return;
  echo ('<ul>');
  foreach ($data['answers'] as $answer) {
    echo ('<li class="mt-3 border border-primary rounded p-2">');
    echo ('<div>ANSWER ' . $answer['text'] . '</div>');
    echo ('<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAnswerModal" data-id="' . $answer['id'] . '" data-text="' . htmlspecialchars($answer['text']) . '">Редактировать вариант</button>');
    echo (' <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="' . $answer['id'] . '" data-a="deleteanswer">Удалить</a>');
    if (isset($answer['question'])) {
      drawTree($answer['question']);
    } else {
      echo (' <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addQuestionModal"">Добавить ответ</button>');
    }
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

  <!-- Modal Add Answers-->
  <div class="modal fade" id="addAnswerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="post" action="/">
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

  <!-- Modal Edit Answers-->
  <div class="modal fade" id="editAnswerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="post" action="/">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Редактирование варианта ответа</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="a" value="editanswer">
            <input class="data_id" type="hidden" name="answer_id" value="">
            <textarea name="text" class="form-control data_text" aria-label="With textarea"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Edit Question-->
  <div class="modal fade" id="editQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="post" action="/">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Редактирование вопроса</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="a" value="editquestion">
            <input class="data_id" type="hidden" name="question_id" value="">
            <textarea class="data_text" name="text" class="form-control" aria-label="With textarea"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>

  <script>
    // For add answer
    var addAnswerModal = document.getElementById('addAnswerModal')
    addAnswerModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget
      var id = button.getAttribute('data-id')

      var modalId = addAnswerModal.querySelector('.data_id')

      modalId.value = id
    })

    // For edit answer
    var editAnswerModal = document.getElementById('editAnswerModal')
    editAnswerModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget
      var id = button.getAttribute('data-id')
      var text = button.getAttribute('data-text')

      var modalId = editAnswerModal.querySelector('.data_id')
      var modalText = editAnswerModal.querySelector('.data_text')

      modalId.value = id
      modalText.value = text
    })

    // For edit question
    var editQuestionModal = document.getElementById('editQuestionModal')
    editQuestionModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget
      var id = button.getAttribute('data-id')
      var text = button.getAttribute('data-text')

      var modalId = editQuestionModal.querySelector('.data_id')
      var modalText = editQuestionModal.querySelector('.data_text')

      modalId.value = id
      modalText.value = text
    })

    // For delete answer/question
    var deleteModal = document.getElementById('deleteModal')
    deleteModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget
      var id = button.getAttribute('data-id')
      var method = button.getAttribute('data-a')

      var modalId = deleteModal.querySelector('.data_id')
      var modalMethod = deleteModal.querySelector('.data_a')

      modalId.value = id
      modalMethod.value = method
    })
  </script>
</body>

</html>