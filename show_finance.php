<?php
require_once("templates/head.php");
require_once("templates/header.php");
require_once("dao/FinanceDAO.php");
require_once("dao/CategoriesDAO.php");
require_once("dao/IconsDAO.php");

$id = $_GET["id"];

$financeDao = new FinanceDAO($conn, $BASE_URL);
$categoriesDao = new CategoriesDAO($conn, $BASE_URL);
$iconsDao = new IconsDAO($conn, $BASE_URL);

$finance = [];

$finance = $financeDao->findById($id); 

$id = $finance->category_id;

$category = $categoriesDao->findById($id);

$icons = $iconsDao->findAll();

?>
<div class="container" id="view-contact-container">
  <?php require_once("templates/backbtn.html"); ?>
  <?php $finance->type === "income" ?  $color = "#21c021" : $color = "#ff0000"; ?>
  <div class="w-100 border rounded camp-title" style="background-color: <?= $color ?>;">
    <h1 id="main-title" class="text-white"><?= $finance->description ?></h1>
  </div>
  <p class="bold">Valor:</p>
  <p><?= $finance->price ?></p>
  <p class="bold">Data:</p>
  <p><?= $finance->date ?></p>
  <p class="bold">Categoria:</p>  
    <?php if (isset($finance->category_id)) : ?> 
      <?php if ($finance->category_id === $category->id) : ?> 
        <p><?= $category->title ?></p>
      <?php else : ?>
        <p><?= "..." ?></p>
      <?php endif; ?>
    <?php else : ?>
      <p><?= "não existe" ?></p>
    <?php endif; ?>  
</div>
<?php require_once("templates/footer.php") ?>