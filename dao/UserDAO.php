<?php

require_once("models/User.php");
require_once("models/Message.php");

class UserDAO implements UserDAOInterface
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

  public function buildUser($data)
  {
    $user = new User();

    $user->id = $data["id"];
    $user->name = $data["name"];
    $user->lastname = $data["lastname"];
    $user->email = $data["email"];
    $user->password = $data["password"];
    $user->image = $data["image"];
    $user->token = $data["token"];
    $user->registration_date = $data["registration_date"];
    $user->adm = $data["adm"];

    return $user;
  }

  public function create(User $user, $authUser = false)
  {
    $stmt = $this->conn->prepare("INSERT INTO users(
      name, lastname, email, password, image, token, registration_date, adm 
      ) VALUES (
        :name, :lastname, :email, :password, :image, :token,:registration_date, :adm
      )");

    $stmt->bindParam(":name", $user->name);
    $stmt->bindParam(":lastname", $user->lastname);
    $stmt->bindParam(":email", $user->email);
    $stmt->bindParam(":password", $user->password);
    $stmt->bindParam(":image", $user->image);
    $stmt->bindParam(":token", $user->token);
    $stmt->bindParam(":registration_date", $user->registration_date);
    $stmt->bindParam(":adm", $user->adm);

    $stmt->execute();
 
    if ($authUser) {
      $this->setTokenToSession($user->token);
    }
  }

  public function update(User $user, $redirect = true)
  {
    $stmt = $this->conn->prepare("UPDATE users SET
        name = :name,
        lastname = :lastname, 
        email = :email, 
        password = :password, 
        image = :image,         
        token = :token, 
        registration_date = :registration_date,
        adm = :adm
        WHERE id = :id
    ");

    $stmt->bindParam(":name", $user->name);
    $stmt->bindParam(":lastname", $user->lastname);
    $stmt->bindParam(":email", $user->email);
    $stmt->bindParam(":password", $user->password);
    $stmt->bindParam(":image", $user->image);
    $stmt->bindParam(":token", $user->token);
    $stmt->bindParam(":registration_date", $user->registration_date);
    $stmt->bindParam(":adm", $user->adm);
    $stmt->bindParam(":id", $user->id);

    $stmt->execute();

    if ($redirect) {

      $this->message->setMessage("Dados atualizados com sucesso!", "success", "editprofile.php");
    }
  }
  public function verifyToken($protected = false)
  {
    // Verifica se existe um token setado
    if (!empty($_SESSION["token"])) {
 
      $token = $_SESSION["token"];

      $user = $this->findByToken($token);

      if ($user) {
        return $user;
      } else if ($protected) {
 
        $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "auth.php");
      }
    } else if ($protected) {
 
      $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "auth.php");
    }
  }
  public function setTokenToSession($token, $redirect = true)
  {
    $_SESSION["token"] = $token;

    if ($redirect) {

      $this->message->setMessage("Seja bem-vindo!", "success", "index.php");
    }
  }

  public function authenticateUser($email, $password)
  {
    $user = $this->findByEmail($email);

    if ($user) {

      // Checar se as senhas batem
      if (password_verify($password, $user->password)) {

        $token = $user->generateToken();

        $this->setTokenToSession($token, false);

        $user->token = $token;

        $this->update($user, false);

        return true;
      } else {

        return false;
      }
    } else {

      return false;
    }
  }
  public function findAll()
  {
    $stmt = $this->conn->prepare("SELECT * FROM users ORDER BY name");

    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      $data = $stmt->fetch();

      $user = $this->buildUser($data);

      return $user;
    } else {

      return false;
    }
  }
  public function findByName($name)
  {
  }

  public function findByEmail($email)
  {
    if ($email != "") {

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

      $stmt->bindParam(":email", $email);

      $stmt->execute();


      if ($stmt->rowCount() > 0) {

        $data = $stmt->fetch();

        $user = $this->buildUser($data);

        return $user;
      } else {

        return false;
      }
    } else {

      return false;
    }
  }

  public function findById($id)
  {
    if ($id != "") {

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");

      $stmt->bindParam(":id", $id);

      $stmt->execute();

      if ($stmt->rowCount() > 0) {

        $data = $stmt->fetch();
        $user = $this->buildUser($data);

        return $user;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function findByToken($token)
  { 
    if ($token != "") {

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token ");

      $stmt->bindParam(":token", $token);

      $stmt->execute();

      if ($stmt->rowCount() > 0) {

        $data = $stmt->fetch();

        $user = $this->buildUser($data);

        return $user;
      } else {

        return false;
      }
    } else { 

      return false;
    }
  }
  public function destroyToken()
  {
    $_SESSION["token"] = "";

    $this->message->setMessage("Logout realizado com sucesso", "success", "auth.php");
  }
  public function changePassword(User $user)
  {
  }
}
