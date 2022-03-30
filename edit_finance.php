<?php
require_once("templates/header.php");

$id = $_GET["id"];

$finance = $financeDao->findById($id);

$categories = $categoriesDao->findAll();

$icons = $iconsDao->findAll();

?>
<div class="container mb-5" id="view-contact-container">
  <?php
  require_once("templates/backbtn.html");

  if ($finance->type === "income") {
    $color = "#21c021";
    $title = "Editar Receita";
  } else {
    $color = "#ff0000";
    $title = "Editar Despesa";
  }

  ?>

  <div class="border rounded border-secondary camp-title mt-4" style="background-color: <?= $color ?>;">
    <h1 id="main-title" class="text-white"><?= $title ?></h1>
  </div>
  <form id="edit-form" class="mt-4" action="<? $BASE_URL ?>finance_process.php" method="POST">
    <input type="hidden" name="type" value="update">
    <input type="hidden" name="id" value="<?= $finance->id ?>">
    <div class="form-group">
      <label for="description" class="ms-2">Descrição:</label>
      <input type="text" class="form-control" id="description" name="description" required value="<?= $finance->description ?>">
    </div>
    <div class="form-group">
      <label for="price" class="ms-2">Valor:</label>
      <input type="text" class="form-control" id="price" name="price" required value="<?= $finance->price ?>">
    </div>
    <div class="form-group">
      <label for="date" class="ms-2">Data:</label>
      <input type="date" class="form-control" id="date" name="date" required value="<?= $finance->date ?>">
    </div>
    <div class="form-group">
      <label for="category_id" class="ms-2">Categoria:</label>
      <select name="category_id" id="category_id" class="form-control">
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
      <button type="submit" class="btn btn-primary form-control mt-3">Atualizar</button>
    </div>
  </form>
</div>
<?php include_once("templates/footer.php") ?>