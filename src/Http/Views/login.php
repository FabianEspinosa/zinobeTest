<?php
use App\Kernel\Response;
  session_start();
  if (isset($_SESSION['userId'])) { 
    Response::redirect('search');
  }
?>
 <form enctype="multipart/form-data" action="/" method="post">
   <h1 class="">Sistema de login</h1>
   <p>Documento <input type="text" placeholder="ingrese su documento" name="document"></p>
   <p>Contraseña <input type="password" placeholder="ingrese su contraseña" name="password"></p>
<input type="submit" value="Ingresar"><a href="register">Registrar Usuario</a>
 </form>
<?php if (isset($data['msg'])) {
    echo $data['msg'];
}?>
