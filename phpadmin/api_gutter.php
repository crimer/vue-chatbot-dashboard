<?php

include 'config.php';

if (isset($_POST['a'])) {
  $method = $_POST['a'];
} else {
  $method = null;
}

function addAnswer($question_id, $text)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/add/answer';
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  $data['question_id'] = $question_id;

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

function addQuestion($answer_id, $text)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/add/question';
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  $q = json_decode($result);
  $qid = $q->{'question'}->{'id'};

  if ($result != FALSE) {
    $url = $CONFIG['api_url'] . 'admin/chat/edit/answer';
    $data = array('key' => $CONFIG['api_key']);
    $data['id'] = $answer_id;
    $data['next_question_id'] = $qid;

    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
      )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
  }

  return $result;
}

function editAnswer($answer_id, $text)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/edit/answer';
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  $data['id'] = $answer_id;

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

function editQuestion($question_id, $text)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/edit/question';
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  $data['id'] = $question_id;

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

function deleteAnswer($answer_id)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/remove/answer';
  $data = array('key' => $CONFIG['api_key']);
  $data['id'] = $answer_id;

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

function deleteQuestion($question_id)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/remove/question';
  $data = array('key' => $CONFIG['api_key']);
  $data['id'] = $question_id;

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

switch ($method) {
  case 'addanswer':
    addAnswer($_POST['question_id'], $_POST['text']);
    break;

  case 'addquestion':
    addQuestion($_POST['answer_id'], $_POST['text']);
    break;

  case 'editanswer':
    editAnswer($_POST['answer_id'], $_POST['text']);
    break;

  case 'editquestion':
    editQuestion($_POST['question_id'], $_POST['text']);
    break;

  case 'deleteanswer':
    deleteAnswer($_POST['id']);
    break;

  case 'deletequestion':
    deleteQuestion($_POST['id']);
    break;

  default:
    break;
}
