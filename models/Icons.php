<?php

class Icons {
  public $id;
  public $title;
  public $group_id;  
}

interface IconsDAOInterface {
  public function buildIcons($data);
  public function create(Icons $icons);
  public function update(Icons $icons, $redirect = true);
  public function destroy($id);
  public function findAll();
  public function findByTitle($name);     
}