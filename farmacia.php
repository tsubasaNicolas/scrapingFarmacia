<?php

include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
//include 'templates/cabecera.php';

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rustic Deco Palet</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/masas.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Distribuidora de  Muebles</a>
       
        
                <a class="nav-link" href="mostrarCarrito.php">Carrito(<?php
                echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                ?>)</a>
            
      
     
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
              <a class="nav-link" href="./">Inicio
                
              </a>
            </li>
        
            <li class="nav-item active">
              <a class="nav-link" href="productos.php">Productos </a>
              <span class="sr-only">(current)</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contacto.php">Contacto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ubicacion.html">Ubicación</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- /.col-lg-3 --   row luego col , puede ser col 3-->
 <div class="row" style="margin-top: 30px">
   
<h1>Todos los Productos</h1>

 </div>
 
 <?php if($mensaje!=""){?>
<div class="alert alert-success">

    <?php echo $mensaje; ?>

 <a href="mostrarCarrito.php" class="badge badge-success">Ver Carrito</a>
</div>
<?php } ?>

          <div class="row">

            <?php
 
        $sentencia=$pdo->prepare("SELECT * FROM `productos`");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        //print_r($listaProductos);
    ?>
    
    <?php foreach($listaProductos as $producto){ ?>
    <div class="col-12 col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
            <img

            title= "<?php echo $producto['Nombre'];?>"
            alt="<?php echo $producto['Nombre'];?>"
             class="card-img-top" 
             src="productos/<?php echo $producto['Imagen'];?>"
             data-toggle="popover"
             data-trigger="hover"
             data-content="<?php echo $producto['Descripcion'];?>"
             height="317px"
             
             >
            <div class="card-body">
            <span><?php echo $producto['Nombre'];?></span>
                <h5 class="card-title">$<?php echo $producto['Precio'];?></h5>
                <p class="card-text">Descripción</p>

            <form action="" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['Id'],COD,KEY);?>">
            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
            <input type="hidden" name="precio" id="precioi" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">

            <button class="btn btn-primary " 
                name="btnAccion" 
                value="Agregar" 
                type="submit">
                Agregar al Carrito
                </button>

            
            </form>


               
            </div>
        </div>


    </div>

<?php }?>

</div>


</div>
<script>

$(function () {
   $('[data-toggle="popover"]').popover()
});
</script>

    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 ">
      <div class="container">
          <div class="social text-center">
        
         <a href="https://www.instagram.com/"> <i class="fab fa-instagram"></i> Búscanos en Instagram</a>
         
          <a href="https://www.facebook.com/rusticdecopalet/" > <i class="fab fa-facebook"></i> También estamos en Facebook</a>
          </div>
        <p class="m-0 text-center text-white">Copyright &copy; Rustic Deco Palet 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
