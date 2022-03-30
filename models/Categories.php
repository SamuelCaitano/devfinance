<?php

class Categories {
  public $id;
  public $title;
  public $icon_id;   
}

interface CategoriesDAOInterface {
  public function buildCategories($data);
  public function create(Categories $categories);
  public function update(Categories $categories, $redirect = true);
  public function destroy($id);
  public function findAll();
  public function findById($id);
  public function findByTitle($name);     
}