<?php
require_once("models/Finance.php");
require_once("models/Message.php");

class FinanceDAO implements FinanceDAOInterface
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

  public function buildFinance($data)
  {

    $finance = new Finance();

    $finance->id = $data["id"];
    $finance->type = $data["type"];
    $finance->description = $data["description"];
    $finance->price = $data["price"];
    $finance->date = $data["date"];
    $finance->category_id = $data["category_id"];
    $finance->user_id = $data["user_id"];

    return $finance;
  }

  public function create(Finance $finance)
  {

    $stmt = $this->conn->prepare("INSERT INTO finance (
      type, description, price, date, category_id, user_id
    ) VALUES (
      :type, :description, :price, :date, :category_id, :user_id
    )");

    $stmt->bindParam(":type", $finance->type);
    $stmt->bindParam(":description", $finance->description);
    $stmt->bindParam(":price", $finance->price);
    $stmt->bindParam(":date", $finance->date);
    $stmt->bindParam(":category_id", $finance->category_id);
    $stmt->bindParam(":user_id", $finance->user_id);

    $stmt->execute();

    // Mensagem de sucesso 
    $this->message->setMessage("Dados adicionados com sucesso!", "success", "index.php");
  }

  public function update(Finance $finance)
  {  
    $stmt = $this->conn->prepare("UPDATE finance SET
      description = :description,
      price = :price,
      date = :date,
      category_id = :category_id
      WHERE id = :id
    ");

    $stmt->bindParam(":description", $finance->description);
    $stmt->bindParam(":price", $finance->price);
    $stmt->bindParam(":date", $finance->date);
    $stmt->bindParam(":category_id", $finance->category_id);
    $stmt->bindParam(":id", $finance->id);

    $stmt->execute();
 
    $this->message->setMessage("Atualização realizada com sucesso!", "success", "index.php");
  }

  public function destroy($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM finance WHERE id = :id");

    $stmt->bindParam(":id", $id);

    $stmt->execute();

    // Mensagem de sucesso por remover filme
    $this->message->setMessage("Excluido com sucesso!", "success", "index.php");
  }

  public function findAll($user_id)
  { 
    $stmt = $this->conn->query("SELECT * FROM finance
     WHERE user_id = $user_id
     ORDER BY date DESC
     ");     

    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $financesArray = $stmt->fetchAll();

      foreach ($financesArray as $finance) {
        $finances[] = $this->buildFinance($finance);
      }
    }

    return $finances;
  }

  public function findById($id)
  {

    if ($id != "") {

      $stmt = $this->conn->prepare("SELECT * FROM finance WHERE id = :id");

      $stmt->bindParam(":id", $id);

      $stmt->execute();

      if ($stmt->rowCount() > 0) {

        $data = $stmt->fetch();
        $finance = $this->buildFinance($data);

        return $finance;
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
  public function findByCategories($categories)
  {
    $stmt = $this->conn->prepare("SELECT * FROM categories LIKE :categories");

    $stmt->bindValue(":categories", "% . $categories . %");

    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $data = $stmt->fetch();

      $finance = $this->buildFinance($data);

      return $finance;
    } else {

      return false;
    }
  }

  public function total($totalIncome, $totalExpense)
  {
  }

  public function calculate()
  {

    // $finances = $this->findAll($id);

    // foreach ($finances as $finance);
    // var_dump($finance); exit;
    // for ($i = 0; $i < count($finance); $i++) {
    // }
  }

  public function income(FinanceDAO $finance)
  {

    // $finance->findAll($id);

    var_dump($finance);
  }
  public function expense()
  {
  }
}
