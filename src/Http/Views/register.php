<?php 
use App\Http\Controllers\CustomerDataController;
?>
<form enctype="multipart/form-data" action="register" method="post">
   <h1 class="">Registrarse en el sistema</h1>   
   <p>Nombre de usuario <input type="text" placeholder="ingrese su nombre" name="username"></p>
   <p>Documento <input type="text" placeholder="ingrese su documento" name="document"></p>
   <p>Correo electronico <input type="text" placeholder="ingrese su correo" name="email"></p>
   <p>Pais <?php echo CustomerDataController::countriesList();?></p>
   <p>Password <input type="password" placeholder="ingrese su contraseña" name="password"></p>
   <p>Confirme su Password <input type="password" placeholder="confirme su contraseña" name="password2"></p>
<input type="submit" value="Registrar"><a href="/">Logear</a>
 </form>
 <?php if (isset($data['userAlreadyExist']) ) {?>
  <div> El usuario ya existe </div>
<?php }?>
 <?php if (isset($data['userCreated'])) {?>
  <div> Usuario creado con exito </div>
<?php }?>
 <?php if (isset($data['msg'])) {
    echo $data['msg'];
}?>
