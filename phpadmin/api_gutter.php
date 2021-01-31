<?php

include 'config.php';

if (isset($_POST['a'])) {
  $method = $_POST['a'];
} else if(isset($_GET['a'])) {
  $method = $_GET['a'];
} else {
  $method = null;
}
function keyCheck($key)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/key/check';
  $data = array('key' => $key);

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

function keyList()
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/key/list';
  $data = array('key' => $CONFIG['api_key']);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

function deleteKey($id)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/key/remove';
  $data = array('key' => $CONFIG['api_key'], 'key_id' => $id);

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

function addKey()
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/key/create';
  $data = array('key' => $CONFIG['api_key']);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  
  return $result;
}

function addAnswer($question_id, $text, $keys)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/add/answer';
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  if ($keys != "") {
    $data['keys'] = $keys;
  }
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

function editAnswer($answer_id, $text, $keys)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/chat/edit/answer';
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  if ($keys != "") {
    $data['keys'] = $keys;
  } else {
    $data['keys'] = "null";
  }
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

function phoneList()
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/phone/list';
  $data = array('key' => $CONFIG['api_key']);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

function deletePhone($id)
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/phone/remove';
  $data = array('key' => $CONFIG['api_key'], 'phone_id' => $id);

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

function deleteAllPhones()
{
  global $CONFIG;
  $url = $CONFIG['api_url'] . 'admin/phone/remove/all';
  $data = array('key' => $CONFIG['api_key']);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

switch ($method) {
  case 'addanswer':
    addAnswer($_POST['question_id'], $_POST['text'], $_POST['keys']);
    break;

  case 'addquestion':
    addQuestion($_POST['answer_id'], $_POST['text']);
    break;

  case 'editanswer':
    editAnswer($_POST['answer_id'], $_POST['text'], $_POST['keys']);
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

  case 'addkey':
    addKey();
    break;

  case 'deletekey':
    deleteKey($_GET['id']);
    break;

  case 'deletephone':
    deletePhone($_POST['id']);
    break;

  case 'deleteallphones':
    deleteAllPhones();
    break;

  case 'logout':
    setcookie('api_key', '', time() - 3600);
    header("Location: auth.php");
    exit();
    break;

  case 'sort_alphabet':
    setcookie('sort', 'alphabet', time() + 3600 * 24 * 120);
    header("Location: index.php");
    exit();
    break;

  case 'sort_time':
    setcookie('sort', 'time', time() + 3600 * 24 * 120);
    header("Location: index.php");
    exit();
    break;

  default:
    break;
}
