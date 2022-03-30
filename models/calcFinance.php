<?php
require_once("templates/head.php"); 

$finances = $financeDao->findAll($user_id);

$somIncome = 0;
$somExpense = 0;
$negative = 0;

foreach ($finances as $finance) {
  if ($finance->type === "income")
    $somIncome += $finance->price;
  else if ($finance->type === "expense")
    $somExpense += $finance->price;
}

$som = $somIncome - $somExpense;

$final = abs($som);

$negative = $som < 0 ? true : false; 

$income = number_format($somIncome, 2, ",", ".");
$expense = number_format($somExpense, 2, ",", ".");
$total = number_format($final, 2, ",", "."); 