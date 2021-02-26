<?php
use App\Kernel\Response;
  session_start();
  if (isset($_SESSION['userId'])) { 
    Response::redirect('search');
  }
?>
<div class="login-page">
  <div class="form">    
    <form enctype="multipart/form-data" action="/" method="post" class="login-form">
      <input name="document" type="text" placeholder="documento"/>
      <input name="password" type="password" placeholder="contraseña"/>
      <button>Ingresar</button>
      <p class="message">No te has registrado? <a href="register">Registrate</a></p>
      <?php if (isset($data['msg'])) {?>
        <p class="message error"><?php echo $data['msg']; ?></p>
      <?php }?>     
    </form>
  </div>
</div>