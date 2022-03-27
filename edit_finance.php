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

$categories = $categoriesDao->findAll();

$icons = $iconsDao->findAll();

?>
<div class="container" id="view-contact-container">

  <?php

  include_once("templates/backbtn.html");

  $finance->type === "income" ?  $color = "#21c021" : $color = "#ff0000";
  $finance->type === "income" ?  $title = "Editar Receita" : $title = "Editar Despesa";

  ?>

  <div class="w-100 border rounded camp-title" style="background-color: <?= $color ?>;">
    <h1 id="main-title" class="text-white"><?= $title ?></h1>
  </div>
  <form id="edit-form" action="<? $BASE_URL ?>finance_process.php" method="POST">
    <input type="hidden" name="type" value="update">
    <input type="hidden" name="id" value="<?= $finance->id ?>">
    <div class="form-group">
      <label for="description">Descrição:</label>
      <input type="text" class="form-control" id="description" name="description" required value="<?= $finance->description ?>">
    </div>
    <div class="form-group">
      <label for="phone">Valor:</label>
      <input type="text" class="form-control" id="price" name="price" required value="<?= $finance->price ?>">
    </div>
    <div class="form-group">
      <label for="date">Data:</label>
      <input type="date" class="form-control" id="date" name="date" required value="<?= $finance->date ?>">
    </div>
    <div class="form-group row col-md-6">
      <label for="date">Categoria:</label>
      <select name="category_id" id="category_id">
        <?php foreach ($categories as $category) : ?>
          <?php if ($finance->category_id) : ?>
            <?php if ($category->id === $finance->category_id) : ?>
              <option selected value="<?= $category->id ?>"><?= $category->title ?>
              <?php else : ?>
              <option value="<?= $category->id ?>"><?= $category->title ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Atualizar</button>
    </div>
  </form>
</div>
<?php include_once("templates/footer.php") ?>