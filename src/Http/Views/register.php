<?php 
use App\Http\Controllers\CustomerDataController;
use App\Kernel\Response;
session_start();
if (isset($_SESSION['userId'])) { 
   Response::redirect('search');
}
?>
<div class="login-page">
  <div class="form">
    <form enctype="multipart/form-data" action="register" method="post" class="register-form">
      <input  name="username" type="text" placeholder="nombre"/>
      <input  name="document"type="text" placeholder="documento"/>
      <input name="email" type="text" placeholder="email"/>
      <?php echo CustomerDataController::countriesList();?>      
      <input name="password" type="password" placeholder="contraseña"/>
      <input name="password2" type="password" placeholder="Repite tu contraseña"/>
      <button>Registrar</button>
      <p class="message">Ya estas registrado? <a href="/">Ingresa</a></p>
      <?php if (isset($data['msg'])) {?>
        <p class="message error"><?php echo $data['msg']; ?></p>
      <?php }?>
    </form>
  </div>
</div>