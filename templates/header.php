<?php
var_dump($_SESSION);die;

require_once("templates/head.php"); 

$userData = [];

$userData = $userDao->findByToken($_SESSION["token"]);

$user_id = $userData->id;

$fullName = $user->getFullName($userData);

if ($userData->image == "") {
  $userData->image = "photo_default.png";
}

?>

<body>
  <header class="header-bg">
    <div class="container">
      <ul class="col-md-12 d-flex nav-list">
        <div class="col-md-8">
          <li class="nav-item">
            <a href="<?= $BASE_URL ?>index.php">
              <img src="./img/logo.svg" alt="Logo Dev Finance">
            </a>
          </li>
        </div>
        <?php if ($userData) : ?>
          <div class="offset-md-3 col-md-1">
            <li class="col nav-item dropdown ">
              <a class="nav-link dropdown " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                <i class="fas fa-bars"></i>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="#">
                    <img src="<?php $BASE_URL ?>img/users/<?= $userData->image ?>" alt="" id="photo__user-nav"> <?= $fullName ?>
                  </a>
                </li>
                <?php if ($userData->adm == 1) : ?>
                  <li>
                    <a class="dropdown-item" href="#"><i class="fas fa-chart-line"></i><span class="title-itens">Dashboard</span></a>
                  </li>
                <?php endif; ?>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-university"></i><span class="title-itens">Contas</span></a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-tags"></i><span class="title-itens">Categorias</span></a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item" href="#"><i class="fas fa-tools"></i><span class="title-itens">Configurações</span></a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= $BASE_URL ?>logout.php"><span class="title-itens-exit">Sair</span></a></li>
              </ul>
            </li>
          </div>
        <?php endif; ?>
      </ul>
    </div>
  </header>