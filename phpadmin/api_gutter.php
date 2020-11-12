<?php

include 'config.php';

if (isset($_GET['a'])) {
  $method = $_GET['a'];
} else {
  $method = null;
}

function addAnswer($question_id)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/add/answer';
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $_GET['text'];
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


switch ($method) {
  case 'addanswer':
    addAnswer($_GET['question_id']);
    break;

  default:
    break;
}
