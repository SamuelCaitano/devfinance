<?php
 
require_once("templates/header.php");
 
$userData = $userDao->verifyToken(true);

$userData = [];

$userData = $userDao->findAll();

$finances = $financeDao->findAll();

$categories = $categoriesDao->findAll();

$icons = $iconsDao->findAll();

$somIncome = 0;
$somExpense = 0;
$income = 0;
$expense = 0;
$total = 0;

?>

<main class="container">
  <section id="balance"> 

    <?php foreach ($finances as $finance) : ?>
      <?php if ($finance->type === "income") {
        $somIncome += $finance->price;
      } else if ($finance->type === "expense") {
        $somExpense += $finance->price;
      }
      ?>
    <?php endforeach; ?>

    <?php 
    $first = substr($somIncome, 0, strlen($somIncome));
    $second = substr($somExpense, 0, strlen($somExpense));
    $income = str_replace(',', ',', str_replace('.', ',', $first)); 
    $expense = str_replace(',', ',', str_replace('.', ',', $second)); 

    // $total = ($income - $expense);
    ?>


    <div class="card">
      <h3>
        <spam>Entradas</spam>
        <img src="./img/income.svg" alt="Imagem de Entradas">
      </h3>
      <p id="incomeDisplay">R$ <?= $income ?></p>
    </div>

    <div class="card">
      <h3>
        <span>Saídas</span>
        <img src="./img/expense.svg" alt="Imagem de Saídas">
      </h3>
      <p id="expenseDisplay">R$ <?= $expense ?></p>
    </div>

    <div class="card total">
      <h3>
        <span>Total</span>
        <img src="./img/total.svg" alt="Imagem Total">
      </h3>
      <p id="totalDisplay">R$ <?= $total ?></p>
    </div>
  </section>

  <?php
  require_once("templates/message_alert.php");
  ?>

  <div class="collapse" id="income">
    <div class=" p-4">
      <h4>Nova Receita</h4>
      <span class="text-muted">preencha os campos abaixo e clique no botão <strong>"Enviar"</strong>.</span>
      <form action="<?= $BASE_URL ?>newfinance.php" method="POST">
        <input type="hidden" name="type" id="income" value="income">
        <?php require("templates/form_finance.php") ?>
      </form>
    </div>
  </div>
  
  <div class="collapse" id="expense">
    <div class=" p-4">
      <h4>Nova Despesa</h4>
      <span class="text-muted">preencha os campos abaixo e clique no botão <strong>"Enviar"</strong>.</span>
      <form action="<?= $BASE_URL ?>newfinance.php" method="POST">
        <input type="hidden" name="type" id="expense" value="expense">
        <?php require("templates/form_finance.php") ?>
      </form>
    </div>
  </div>

  <div class="d-flex">
    <!-- Collapse income -->
    <nav class="navbar navbar-dark">
      <div class="container-fluid">
        <button class="navbar-toggler income" type="button" data-bs-toggle="collapse" data-bs-target="#income" aria-controls="income" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""><i class="fas fa-plus"></i> Receita</span>
        </button>
      </div>
    </nav>
    <!-- Collapse expense -->
    <nav class="navbar navbar-dark">
      <div class="container-fluid">
        <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#expense" aria-controls="expense" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""><i class="fas fa-minus"></i> Despesa</span>
        </button>
      </div>
    </nav>
  </div>

  <div id="transaction">    
    <table id="data-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th>Descrição</th>
          <th>Valor</th>
          <th>Data</th>
          <th>Categoria</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($finances as $finance) : ?>
          <?php $finance->type === "income" ?  $color = "alert-success income" : $color = "alert-danger expense"; ?>
          <tr>
            <td class="actions d-flex <?= $color ?>">
              <a href="<?= $BASE_URL ?>show_finance.php?id=<?= $finance->id ?>" title="Visualizar"><i class="fas fa-eye check-icon"></i></a>
              <a href="<?= $BASE_URL ?>edit_finance.php?id=<?= $finance->id ?>" title="editar"><i class="far fa-edit edit-icon"></i></a>
              <form class="delete-form" action="<?= $BASE_URL ?>finance_process.php" method="POST" title="Excluir">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $finance->id ?>">
                <button type="submit"><i class="fas fa-times delete-icon"></i></button>
              </form>
            </td>
            <td class="<?= $color ?>"><?= $finance->description ?></td>
            <td class="<?= $color ?>"><?= $finance->price ?></td>
            <td class="<?= $color ?>"><?= $finance->date ?></td>
            <!--  -->
            <?php foreach ($categories as $category) : ?>
              <?php if (isset($finance->category_id)) : ?>
                <?php if ($finance->category_id === $category->id) : ?>
                  <td class="<?= $color ?>"><?= $category->title ?></td>
                <?php endif; ?>
              <?php else : ?>
                <td class="<?= $color ?>"><?= "não existe" ?></td>
              <?php endif; ?>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
        <!-- foreach  -->
      </tbody>
    </table>
  </div>
</main>


<?php require_once("templates/footer.php"); ?>