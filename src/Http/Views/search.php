<?php 
use App\Kernel\Response;
session_start();
if (isset($_SESSION['userId'])) { ?>
    <div>Bienvenido </div> <?php echo $_SESSION['username'];?>
<?php }
else {
    Response::redirect('/');
}
?>