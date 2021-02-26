<?php
use App\Kernel\Response;
session_start();
if (isset($_SESSION['userId'])) {?>

    <div class="welcome">
        <div class="wc">
          <div class="wc-t">Bienvenido, </div>
          <div class="wc-st"><?php echo $_SESSION['username'];?></div></div>
        <div class="logout"><a href="/logout">Cerrar sesión</a></div>
    </div>
    <div class="form2">
    <form enctype="multipart/form-data" action="search" method="post">
        <input type="text" placeholder="ingrese el documento o email para realizar la busqueda" name="dataField"></p>
        <button>BUSCAR</button>
    </form>
    </div>
 <?php if(isset($data["userCard"])){?>
<div class="login-page">
  <div class="form upsie">
      <p class="title">Usuario encontrado</p> 
      <input disabled type="text" value="<?php echo $data["userCard"]["name"];?>"/>
      <input disabled type="text" value="<?php echo $data["userCard"]['document']?>"/>
      <input disabled type="text" value="<?php echo $data["userCard"]['email']?>"/>
      <input disabled type="text" value="<?php echo $data["userCard"]['country']?>"/>
      <?php 
        }   
            if (isset($data['msg'])) {
                echo "<div class='form'><p style='color: red' class='title'>".$data['msg']."</p></div>";
            }
        } else {
            Response::redirect('/');
    }
?>
  </div>
</div>