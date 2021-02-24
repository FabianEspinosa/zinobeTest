
 <form enctype="multipart/form-data" action="login" method="post">
   <h1 class="">Sistema de login</h1>
   <p>Usuario <input type="text" placeholder="ingrese su nombre" name="user"></p>
   <p>Contraseña <input type="password" placeholder="ingrese su contraseña" name="password"></p>
<input type="submit" value="Ingresar">
 </form>
 <form enctype="multipart/form-data" action="create/user" method="post">
   <h1 class="">Registrarse en el sistema</h1>
   <p>Nombre de usuario <input type="text" placeholder="ingrese su nombre" name="username"></p>
   <p>Documento <input type="text" placeholder="ingrese su documento" name="document"></p>
   <p>Correo electronico <input type="text" placeholder="ingrese su correo" name="email"></p>
   <p>Pais <input type="text" placeholder="ingrese su pais" name="country"></p>
   <p>Password <input type="password" placeholder="ingrese su contraseña" name="password"></p>
   <p>Confirme su Password <input type="password" placeholder="confirme su contraseña" name="password2"></p>
<input type="submit" value="Registrar">
 </form>
 <?php if ($data['userAlreadyExist']) { ?>
  <div> El usuario ya existe </div>
<?php }?>
 <?php if ($data['userCreated']) { ?>
  <div> Usuario creado con exito </div>
<?php }?>
