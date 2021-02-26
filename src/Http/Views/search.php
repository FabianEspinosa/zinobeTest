<?php
use App\Kernel\Response;
session_start();
if (isset($_SESSION['userId'])) {?>

    <div>Bienvenido </div> <?php echo $_SESSION['username']; ?><a href="/logout">Cerrar sesión</a>
     <p>Buscar usuario</p>
     <form enctype="multipart/form-data" action="search" method="post">
    <p>Documento o email <input type="text" placeholder="ingrese el documento o email para realizar la busqueda" name="dataField"></p>
    <input type="submit" value="Buscar">
 </form>
 <?php if(isset($data["userCard"])){?>
 <div class='card'>                      
    <div class='container'>
        <h4><b><?php echo $data["userCard"]['name']?></b></h4>
        <b>Documento: </b><?php echo $data["userCard"]['document']?>
        <b>Email: </b><?php echo $data["userCard"]['email']?>
        <b>Pais: </b><?php echo $data["userCard"]['country']?>
    </div>
</div>
 <?php 
 }   
    if (isset($data['msg'])) {
        echo $data['msg'];
    }
} else {
    Response::redirect('/');
}
?>