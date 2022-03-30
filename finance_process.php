<?php

require_once("config/globals.php");
require_once("config/db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/FinanceDAO.php");
require_once("models/Finance.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$financeDao = new FinanceDAO($conn, $BASE_URL);

// Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "type");

// Verificação do tipo de formulário
if ($type === "update") {
  
  $id = filter_input(INPUT_POST, "id");
  $description = filter_input(INPUT_POST, "description");
  $price = filter_input(INPUT_POST, "price");
  $date = filter_input(INPUT_POST, "date");
  $category_id = filter_input(INPUT_POST, "category_id"); 

  $finance = new Finance();

  $finance->id = $id;
  $finance->description = $description;
  $finance->price = $price;
  $finance->date = $date; 
  $finance->category_id = $category_id; 
 
  if ($finance->id && $finance->description && $finance->price && $finance->date && $finance->category_id) {   

    $financeDao->update($finance);

  } else {

    // Enviar uma msg de erro, de dados faltantes
    $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
  }

  // Verificação do tipo de formulário
} else if ($type === "delete") {
  
  // Recebe os dados do form
  $id = filter_input(INPUT_POST, "id");

  $finance = $financeDao->findById($id);

  if($finance) { 

      $financeDao->destroy($finance->id); 

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }
}
