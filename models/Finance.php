<?php

class Finance {
  public $id;
  public $type;
  public $description;
  public $price;
  public $date;
  public $category_id;  
  public $user_id;
}

interface FinanceDAOInterface {
  public function buildFinance($data);
  public function create(Finance $finance);
  public function update(Finance $finance); 
  public function destroy($id);
  public function findAll($id);
  public function findById($id); 
  public function findByTitle($name); 
  public function findByCategories($categories);
  public function calculate();   
}