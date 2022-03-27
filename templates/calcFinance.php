<?php
require_once("templates/head.php");

$finances = $financeDao->findAll();

$somIncome = 0;
$somExpense = 0; 

?>

<?php foreach ($finances as $finance) : ?>
  <?php if ($finance->type === "income") {

    $somIncome += $finance->price;
  } else if ($finance->type === "expense") {

    $somExpense += $finance->price;
  }
  ?>
<?php endforeach; ?>

<?php

$firstNumber =  $somIncome ;
$secondNumber = $somExpense;
$som = $firstNumber - $secondNumber;

if ($som < 0) {
  $final = abs($som);
  $negative = true;
} else {
  $final = abs($som);
  $negative = false;
}

$income = number_format($firstNumber, 2, ",", ".");
$expense = number_format($secondNumber, 2, ",", ".");
$total = number_format($final, 2, ",", ".");

?>