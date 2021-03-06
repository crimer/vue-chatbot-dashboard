<?php

if (!isset($_COOKIE['api_key'])) {
  header("Location: auth.php");
  exit();
}

include 'config.php';
include 'api_gutter.php';

$tree = file_get_contents($CONFIG['api_url'] . 'admin/chat/tree?key=' . $CONFIG['api_key']);
$tree = json_decode($tree, true);

function array_sort(&$data)
{
  if (!$data['answers']) return;
  $ar = array();
  $sorted_answers = array();
  // Записываем в новый массив id и text
  foreach ($data['answers'] as &$answer) {
    if (isset($answer['question'])) {
      array_sort($answer['question']);
    }
    $ar[] = mb_strtolower($answer['text']);
  }
  // Сортировка
  asort($ar, SORT_STRING | SORT_FLAG_CASE);
  foreach ($ar as $key => $value) {
    $sorted_answers[] = $data['answers'][$key];
  }
  $data['answers'] = $sorted_answers;
}

function drawTree($data, $level)
{
  echo ('<div class="rounded"><div class="h6 mt-3">Q [' . $data['id'] . ']</div><div>' . $data['text'] . '</div></div> <br>');
  echo ('<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAnswerModal" data-id="' . $data['id'] . '"><i class="fa fa-plus-square" aria-hidden="true"></i> Добавить вариант</button>');
  echo (' <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editQuestionModal" data-id="' . $data['id'] . '" data-text="' . htmlspecialchars($data['text']) . '"><i class="fa fa-pencil" aria-hidden="true"></i> Изменить</a>');
  if ($data['id'] != 1) {
    echo (' <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="' . $data['id'] . '" data-a="deletequestion"><i class="fa fa-trash" aria-hidden="true"></i> Удалить</a>');
  }
  if (!$data['answers']) return;
  if ($level == 0) {
    echo ('<ul id="treeUL">');
  } else {
    echo ('<ul class="nested">');
  }
  foreach ($data['answers'] as $answer) {
    if ($level % 2) {
      echo ('<li class="mt-3 border border-danger rounded p-2" style="background-color: #e3e3e3;">');
    } else {
      echo ('<li class="mt-3 border border-primary rounded p-2" style="background-color: #fff;">');
    }
    if (isset($answer['question']) && $answer['question']['count'] > 0) {
      echo ('<span class="caret" data-id="' . $answer['id'] . '"></span>');
    }
    echo ('<div>A [' . $answer['id'] . ']</div><div>' . $answer['text'] . '</div> <br>');
    echo ('<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAnswerModal" data-id="' . $answer['id'] . '" data-text="' . htmlspecialchars($answer['text']) . '" data-keys="' . htmlspecialchars($answer['keys']) . '"><i class="fa fa-pencil" aria-hidden="true"></i> Изменить</button>');
    echo (' <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="' . $answer['id'] . '" data-a="deleteanswer"><i class="fa fa-trash" aria-hidden="true"></i> Удалить</a>');
    if (isset($answer['question'])) {
      drawTree($answer['question'], $level + 1);
    } else {
      echo (' <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addQuestionModal" data-id="' . $answer['id'] . '"><i class="fa fa-plus-square" aria-hidden="true"></i> Добавить ответ</button>');
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
  $page = "main";
  include "menu.php";
  ?>

  <div class="container my-3">
    <?php if (isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'alphabet') {
      echo ('<a type="button" href="?a=sort_time" class="btn pull-right"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Сортировать по времени</a>');
      array_sort($tree['tree']);
    } else {
      echo ('<a type="button" href="?a=sort_alphabet" class="btn pull-right"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> Сортировать по алфавиту</a>');
    }
    ?>
    <h1 class="mb-4">Дерево диалога</h1>
    <?php
    drawTree($tree['tree'], 0); ?>
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
            <div>Текст ответа: </div>
            <input type="hidden" name="a" value="addanswer">
            <input class="data_id" type="hidden" name="question_id" value="addanswer">
            <textarea style="height: 250px;" name="text" class="form-control" aria-label="With textarea" placeholder="Введите текст" id="addanstext"></textarea>
            <div class="col-md">
              <div class="mt-3">Ключевые слова: </div>
              <div class="form-floating">
                <input name="keys" class="form-control" id="floatingInputGrid" placeholder="KEYWORDS" value="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="submit" class="btn btn-primary">Сохранить</button>
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
            <div>Текст ответа: </div>
            <input type="hidden" name="a" value="editanswer">
            <input class="data_id" type="hidden" name="answer_id" value="">
            <textarea style="height: 250px;" name="text" class="form-control data_text" aria-label="With textarea" id="editanstext"></textarea>
            <div class="col-md">
              <div class="mt-3">Ключевые слова: </div>
              <div class="form-floating">
                <input name="keys" class="form-control data_keys" id="floatingInputGrid" placeholder="KEYWORDS">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="submit" class="btn btn-primary">Сохранить</button>
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
            <div>Текст вопроса: </div>
            <input type="hidden" name="a" value="editquestion">
            <input class="data_id" type="hidden" name="question_id" value="">
            <textarea style="height: 250px;" name="text" class="form-control data_text" aria-label="With textarea" id="editquetext"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
            <button type="submit" class="btn btn-primary">Сохранить</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Add Question-->
  <div class="modal fade" id="addQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <form method="post" action="/">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Добавление ответа</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <label>Текст ответа: </label>
            <input type="hidden" name="a" value="addquestion">
            <input class="data_id" type="hidden" name="answer_id" value="">
            <textarea style="height: 250px;" name="text" class="form-control data_text" aria-label="With textarea" placeholder="Введите текст" id="addquetext"></textarea>
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

  <script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
      var t = toggler[i];
      var saveState = localStorage.getItem("cpchatbot-caret-" + t.getAttribute('data-id'));

      if (saveState && saveState == "true") {
        t.parentElement.querySelector(".nested").classList.toggle("active");
        t.classList.toggle("caret-down");
      }

      t.addEventListener("click", function() {
          if ($(this).hasClass("caret-down")) {
            // Find lists
            $(this.parentElement).children(".nested").children().each(function(i, elem) {
              // Find opened childrens
              var caret = $(elem).children(".caret-down").each(function(i, elem) {
                // Send event click
                elem.click();
              });
            });

            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
            localStorage.setItem("cpchatbot-caret-" + this.getAttribute('data-id'), this.classList.contains("caret-down"));
          } else {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
            localStorage.setItem("cpchatbot-caret-" + this.getAttribute('data-id'), this.classList.contains("caret-down"));
          }
      });
    }

      // For add answer
      var addAnswerModal = document.getElementById('addAnswerModal')
      addAnswerModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')

        var modalId = addAnswerModal.querySelector('.data_id')

        modalId.value = id

        setTimeout(function() {
          document.getElementById("addanstext").focus();
        }, 500);
      })

      // For add question
      var addQuestionModal = document.getElementById('addQuestionModal')
      addQuestionModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')

        var modalId = addQuestionModal.querySelector('.data_id')

        modalId.value = id

        setTimeout(function() {
          document.getElementById("addquetext").focus();
        }, 500);
      })

      // For edit answer
      var editAnswerModal = document.getElementById('editAnswerModal')
      editAnswerModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-id')
        var text = button.getAttribute('data-text')
        var keys = button.getAttribute('data-keys')

        var modalId = editAnswerModal.querySelector('.data_id')
        var modalText = editAnswerModal.querySelector('.data_text')
        var modalKeys = editAnswerModal.querySelector('.data_keys')

        modalId.value = id
        modalText.value = text
        modalKeys.value = keys

        setTimeout(function() {
          document.getElementById("editanstext").focus();
        }, 500);
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


        setTimeout(function() {
          document.getElementById("editquetext").focus();
        }, 500);
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