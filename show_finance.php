<?php
// require_once("templates/head.php");
require_once("templates/header.php"); 

$id = $_GET["id"]; 

$finance = $financeDao->findById($id);

$id = $finance->category_id;

$category = $categoriesDao->findById($id);

$icons = $iconsDao->findAll();

?>
<div class="container mb-5" id="view-contact-container">
  <?php
  require_once("templates/backbtn.html");
  $finance->type === "income" ?  $color = "#21c021" : $color = "#ff0000";
  ?>

  <div class="w-100 border rounded border-secondary camp-title mt-4" style="background-color: <?= $color ?>;">
    <h1 id="main-title" class="text-white"><?= $finance->description ?></h1>
  </div>

  <div class="form-group mt-4">
    <label for="price" class="bold ms-2">Valor:</label>
    <p type="text" class="form-control bg-light"><?= $finance->price ?></p>
  </div>

  <div class="form-group">
    <label for="price" class="bold ms-2">Data:</label>
    <p type="text" class="form-control bg-light"><?= $finance->date ?></p>
  </div>

  <div class="form-group">
    <label for="price" class="bold ms-2">Categoria:</label>
    <p type="text" class="form-control bg-light">
      <?php
      if ($finance->category_id === $category->id) {
        echo $category->title;
      } else {
        echo "...";
      }
      ?>
    </p>
  </div>
</div>
<?php require_once("templates/footer.php") ?>