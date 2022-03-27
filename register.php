<?php
require_once("templates/head.php"); 
?> 

<div class="v-100 w-100">
<div id="auth-row"> 
  <div class="m-auto col-md-4 border border-secondary rounded p-5 bg-light" id="register-container">
    <div class="text-center">
      <img src="./img/logo.png" alt="Logo Dev Finance">
    </div>
    <h2>Criar uma Conta</h2>
    <p>Já tem uma conta? <a href="<?= $BASE_URL ?>auth.php" title="Faça login"> Login</a></p>
    <form class="d-inline" action="<?= $BASE_URL ?>auth_process.php" method="POST">
      <input type="hidden" name="type" value="register">
      <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome" title="Digite seu nome" required>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Sobrenome" title="Digite seu sobrenome" required>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" title="Digite seu e-mail" required autocomplete="off">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Senha" title="Digite sua senha" autocomplete="off" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" title="Confirme sua senha" placeholder="Confirme sua senha" autocomplete="off" required>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary mt-3 card-btn form-control" value="Registrar">
      </div>
    </form>
  </div>
</div>