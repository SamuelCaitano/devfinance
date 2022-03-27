<?php

class Finance {
  public $id;
  public $description;
  public $price;
  public $date;
  public $category;  
}

interface FinanceDAOInterface {
  public function buildFinance($data);
  public function create(Finance $finance);
  public function update(Finance $finance); 
  public function destroy($id);
  public function findAll();
  public function findById($id); 
  public function findByTitle($name); 
  public function findByCategories($categories);
  public function calculate();   
}