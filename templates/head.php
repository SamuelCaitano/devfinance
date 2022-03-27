<?php

require_once("config/globals.php");
require_once("config/db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("models/User.php");
require_once("dao/CategoriesDAO.php");
require_once("dao/IconsDAO.php");
require_once("dao/FinanceDAO.php");

$message = new Message($BASE_URL);
$user = new User(); 
$userDao = new UserDAO($conn, $BASE_URL);
$financeDao = new FinanceDAO($conn, $BASE_URL);
$categoriesDao = new CategoriesDAO($conn, $BASE_URL);
$iconsDao = new IconsDAO($conn, $BASE_URL);


$userData = $userDao->verifyToken(false);

$flassMessage = $message->getMessage();

if(!empty($flassMessage["msg"])) {
  // Limpar a mensagem
  $message->clearMessage();
}

?>
 
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?= $BASE_URL ?>./img/favicon-32x32.png" type="image/x-icon">
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Google font icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Css do porjeto -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css"> 
  <title>Dev.finance$</title>
</head>

<body>
  