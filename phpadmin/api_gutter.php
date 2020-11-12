<?php

include 'config.php';

if (isset($_GET['a'])) {
  $method = $_GET['a'];
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


switch ($method) {
  case 'addanswer':
    addAnswer($_GET['question_id'], $_GET['text']);
    break;

  case 'editanswer':
    editAnswer($_GET['answer_id'], $_GET['text']);
    break;

  default:
    break;
}
