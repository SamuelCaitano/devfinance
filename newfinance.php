<?php

  require_once("config/globals.php");
  require_once("config/db.php");
  require_once("models/Finance.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");
  require_once("dao/FinanceDAO.php");
 
  $message = new Message($BASE_URL);
  $userDao = new UserDAO($conn, $BASE_URL);
  $financeDao = new FinanceDAO($conn, $BASE_URL); 
  
  $userData = $userDao->verifyToken(false); // mudar para true
   
  // Resgata o tipo do formulário
  $type_form = filter_input(INPUT_POST, "type_form");
  
  // Resgata dados do usuário
  $userData = $userDao->verifyToken();
  
  if($type_form=== "create") { 

    // Receber os dados dos inputs
    $type = filter_input(INPUT_POST, "type"); 
    $description = filter_input(INPUT_POST, "description");
    $price = filter_input(INPUT_POST, "price");
    $date = filter_input(INPUT_POST, "date");
    $category_id = filter_input(INPUT_POST, "category_id");
    $user_id = filter_input(INPUT_POST, "user_id");
 
    $finance = new Finance();
 
    // Validação mínima de dados
    if(!empty($type) && !empty($description) && !empty($price) && !empty($date) && !empty($category_id) && !empty($user_id)) {
 
      $finance->type = $type;
      $finance->description = $description;
      $finance->price = $price;
      $finance->date = $date;
      $finance->category_id = $category_id;
      $finance->user_id = $user_id; 

      $financeDao->create($finance);

    } else { 
      
      $message->setMessage("Você precisa adicionar pelo menos: descrição, valor e categoria!", "error", "back");

    }

  } else if($type_form === "delete") {

    // Recebe os dados do form
    $id = filter_input(INPUT_POST, "id");

    $movie = $movieDao->findById($id);

    if($movie) {

      // Verificar se o filme é do usuário
      if($movie->users_id === $userData->id) {

        $movieDao->destroy($movie->id);

      } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");

      }

    } else {

      $message->setMessage("Informações inválidas!", "error", "index.php");

    }

  } else if($type_form === "update") { 

    // Receber os dados dos inputs
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    $movieData = $movieDao->findById($id);

    // Verifica se encontrou o filme
    if($movieData) {

      // Verificar se o filme é do usuário
      if($movieData->users_id === $userData->id) {

        // Validação mínima de dados
        if(!empty($title) && !empty($description) && !empty($category)) {

          // Edição do filme
          $movieData->title = $title;
          $movieData->description = $description;
          $movieData->trailer = $trailer;
          $movieData->category = $category;
          $movieData->length = $length;

          // Upload de imagem do filme
          if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Checando tipo da imagem
            if(in_array($image["type"], $imageTypes)) {

              // Checa se imagem é jpg
              if(in_array($image["type"], $jpgArray)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
              } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
              }

              // Gerando o nome da imagem
              $movie = new Movie();

              $imageName = $movie->imageGenerateName();

              imagejpeg($imageFile, "./img/movies/" . $imageName, 100);

              $movieData->image = $imageName;

            } else {

              $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");

            }

          }

          $movieDao->update($movieData);

        } else {

          $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");

        }

      } else {

        $message->setMessage("Informações inválidas!", "error", "index.php");

      }

    } else {

      $message->setMessage("Informações inválidas!", "error", "index.php");

    }
  
  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }