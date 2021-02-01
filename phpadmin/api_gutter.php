<?php

include 'config.php';

if (isset($_POST['a'])) {
  $method = $_POST['a'];
} else if(isset($_GET['a'])) {
  $method = $_GET['a'];
} else {
  $method = null;
}

// Проверка действительности ключа
function keyCheck($key)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/key/check';
  // Параметры передаваемые API
  $data = array('key' => $key);

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  // Читает содержимое файла в строку
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Вывод списока ключей
function keyList()
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/key/list';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Удаление ключа
function deleteKey($id)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/key/remove';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key'], 'key_id' => $id);

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Добавление ключа
function addKey()
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/key/create';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  
  return $result;
}

// Добавление ответа
function addAnswer($question_id, $text, $keys)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/chat/add/answer';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  if ($keys != "") {
    $data['keys'] = $keys;
  }
  $data['question_id'] = $question_id;

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Добавление вопроса
function addQuestion($answer_id, $text)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/chat/add/question';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  $q = json_decode($result);
  $qid = $q->{'question'}->{'id'};

  if ($result != FALSE) {
    // Адрес обращения к API
    $url = $CONFIG['api_url'] . 'admin/chat/edit/answer';
    // Параметры передаваемые API
    $data = array('key' => $CONFIG['api_key']);
    $data['id'] = $answer_id;
    $data['next_question_id'] = $qid;

    // Настройка http-запроса
    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
      )
    );
    // Создаёт контекст потока
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
  }

  return $result;
}

// Изменение ответа
function editAnswer($answer_id, $text, $keys)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/chat/edit/answer';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  if ($keys != "") {
    $data['keys'] = $keys;
  } else {
    $data['keys'] = "null";
  }
  $data['id'] = $answer_id;

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Изменение вопроса
function editQuestion($question_id, $text)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/chat/edit/question';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);
  $data['text'] = $text;
  $data['id'] = $question_id;

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Удаление ответа
function deleteAnswer($answer_id)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/chat/remove/answer';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);
  $data['id'] = $answer_id;

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Удаление ответа
function deleteQuestion($question_id)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/chat/remove/question';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);
  $data['id'] = $question_id;

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Вывод списка оставленных телефонов и их данных
function phoneList()
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/phone/list';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Удаление телефонов и их данных
function deletePhone($id)
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/phone/remove';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key'], 'phone_id' => $id);

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  // Создаёт контекст потока
  $context  = stream_context_create($options);
  $result = file_get_contents($url, false, $context);

  return $result;
}

// Удаление всех данных о телефонах
function deleteAllPhones()
{
  global $CONFIG;
  // Адрес обращения к API
  $url = $CONFIG['api_url'] . 'admin/phone/remove/all';
  // Параметры передаваемые API
  $data = array('key' => $CONFIG['api_key']);

  // Настройка http-запроса
  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data),
    )
  );
  // Создаёт контекст потока
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
