<?php
require_once("models/Icons.php");

class IconsDAO implements IconsDAOInterface 
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

  public function buildIcons($data)
  {
    $icons = new Categories();

    $icons->id = $data["id"];
    $icons->title = $data["title"]; 
    $icons->group_id = $data["group_id"];

    return $icons;

  }

  public function create(Icons $icons)
  {
    $stmt = $this->conn->prepare("INSERT INTO icons (
      title, group_id 
    ) VALUES (
      :title, :group_id 
    )");

    $stmt->bindParam(":title", $icons->title);
    $stmt->bindParam(":group_id", $icons->group_id); 

    $stmt->execute();

  }

  public function update(Icons $icons, $redirect = true)
  {
    $stmt = $this->conn->prepare("UPDATE icons SET(
      title = :title,
      group_id = :group_id, 
      WHERE id = :id
    )");

    $stmt->bindParam(":title", $icons->title);
    $stmt->bindParam(":icon_id", $icons->icon_id); 

    $stmt->execute();

    if ($redirect) {
      $this->message->setMessage("Dados atualizados com sucesso!", "success", "index.php");
    }
  }

  public function destroy($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM icons WHERE id = :id");

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    // Mensagem de sucesso por remover filme
    $this->message->setMessage("Categoria removida com sucesso!", "success", "index.php");
  }

  public function findAll()
  {
    $icons = [];

    $stmt = $this->conn->query("SELECT * FROM icons ORDER BY id DESC");

    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $iconsArray = $stmt->fetchAll();

      foreach ($iconsArray as $icon) {
        $icons[] = $this->buildIcons($icon);
      } 
    }
    
    return $icons; 

  }

  public function findByTitle($name)
  {
  } 
}
