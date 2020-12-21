<?php

include 'config.php';
include 'api_gutter.php';

if (isset($_COOKIE['api_key'])){
  header("Location: index.php");
  exit();
}

if (isset($_POST['key'])) {
  $result = keyCheck($_POST['key']);
  $q = json_decode($result);
  $status = $q->{'status'};
  if ($status == 'valid') {
    setcookie('api_key', $_POST['key'], time()+3600*24*120);
    header("Location: index.php");
    exit();
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

<style>
  html, body {
    height: 100%;
  }
  body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
  }

  .form-sign {
    width: 100%;
    max-width: 530px;
    padding: 15px;
    margin: auto;
  }
</style>

<body>
  <div class="container">
    <form method="POST" class="form-sign">
      <h1 class="h3 mb-3 fw-normal text-center">VVSU-Chatbot CP</h1>
      <label class="mb-1">Admin key: </label>
      <input name="key" type="text" class="form-control mb-3" placeholder="KEYCODE" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
  </div>
</body>