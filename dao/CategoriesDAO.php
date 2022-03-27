<?php
require_once("models/Categories.php");

class CategoriesDAO implements CategoriesDAOInterface
{

  private $conn;
  private $url;
  private $message;

  public function __construct(PDO $conn, $url)
  {
    $this->conn = $conn;
    $this->url = $url;
    $this->message = new Message($url);
  }

  public function buildCategories($data)
  {
    $categories = new Categories();

    $categories->id = $data["id"];
    $categories->title = $data["title"]; 
    $categories->icon_id = $data["icon_id"];

    return $categories;

  }

  public function create(Categories $categories)
  {
    $stmt = $this->conn->prepare("INSERT INTO categories (
      title, icon_id 
    ) VALUES (
      :title, :icon_id 
    )");

    $stmt->bindParam(":title", $categories->title);
    $stmt->bindParam(":icon_id", $categories->icon_id); 

    $stmt->execute();

  }

  public function update(Categories $categories, $redirect = true)
  {
    $stmt = $this->conn->prepare("UPDATE categories SET(
      title = :title,
      icon_id = :icon_id, 
      WHERE id = :id
    )");

    $stmt->bindParam(":title", $categories->title);
    $stmt->bindParam(":icon_id", $categories->icon_id); 

    $stmt->execute();

    if ($redirect) {
      $this->message->setMessage("Dados atualizados com sucesso!", "success", "index.php");
    }
  }

  public function destroy($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = :id");

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    // Mensagem de sucesso por remover filme
    $this->message->setMessage("Categoria removida com sucesso!", "success", "index.php");
  }

  public function findAll()
  {
    $categories = [];

    $stmt = $this->conn->query("SELECT * FROM categories ORDER BY id DESC");

    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $categoriesArray = $stmt->fetchAll();

      foreach ($categoriesArray as $category) {
        $categories[] = $this->buildCategories($category);
      } 
    }
    
    return $categories; 

  }

  public function findById($id)
  {

    if ($id != "") {

      $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = :id");

      $stmt->bindParam(":id", $id);

      $stmt->execute();

      if ($stmt->rowCount() > 0) {

        $data = $stmt->fetch();
        $category = $this->buildCategories($data);

        return $category;
        
      } else {

        return false;
      }
    } else {

      return false;
    }
  }

  public function findByTitle($name)
  {
  } 
  
}
