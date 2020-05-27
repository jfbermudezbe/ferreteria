<?php 

require("conexion.php");
session_start();

if (!isset($_SESSION['usuario'])) {
  header('Location: login.php');
  return;
}

if (isset($_POST['nombreCategoria'])) {
  if (strlen($_POST['nombreCategoria']) >= 1){
    $nombreCategoria = $_POST['nombreCategoria'];
    $result = $pdo->query("INSERT INTO Categoria (nombre,habilitado) VALUES ('$nombreCategoria',1)");
  }else{
    $_SESSION['error'] = "Diligencie los campos completamente.";
  }
}

//---------CARGAR DATOS DE MARCAS -----------
$query = "SELECT * FROM producto";
$result = $pdo->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Juan Bermudez">

  <title>Productos</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
    $('#categorias').autocomplete("cargarCategorias.php");
  </script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include ("sidebar.php") ?> 

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <?php include("topbar.php") ?>

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form method='POST' class='user'>
            <div class='form-group'>
              <label for='nombreCategoria'>Nombre del Producto: *</label>
              <input type='text' name='nombreProducto' id='nombreProducto' class='form-control' placeholder='Ejemplo: Clavo acero 12pulg' required>
            </div>
            <div class='form-group'>
              <label for='precioVenta'>Precio de venta: *</label>
              <input type='text' name='precioVenta' id='precioVenta' class='form-control' placeholder='Ejemplo: 400' required>
            </div>
            <div class='form-group'>
              <label for='porcentajeMayoreo'>Porcentaje de mayoreo: *</label>
              <input type='number' name='porcentajeMayoreo' id='porcentajeMayoreo' class='form-control' placeholder='Ejemplo: 5' min="0" max="100" required>
            </div>
            <div class='form-group'>
              <label for="radioGarantia">¿Este producto tiene garantía? *</label><br>
              <label class="radio-inline"><input type="radio" name="radioGarantia" value="1">Sí</label>
              <label class="radio-inline"><input type="radio" name="radioGarantia" value="0" checked>No</label>
            </div>
            <div class='form-group'>
              <label for="categoria">Seleccione una categoria: *</label>
              <input type="text" name="categoria" class="form-control" id="categorias" placeholder="Selecciona una del desplegable o escriba una nueva">
            </div>
            <div class='form-group'>
              <label for="marca">Seleccione una marca: *</label>
              <input type="text" name="marca" class="form-control" id="marca" placeholder="Selecciona una del desplegable o escriba una nueva">
            </div>
            <div class='form-group'>
              <input type='submit' class='btn btn-primary' value='Registrar'>
            </div>
          </form>

          <div class="row">
            <div class="d-sm-flex align-items-center mb-4 col-10">
              <h1 class="h2 mb-0 text-gray-800">Productos</h1>
            </div>
            <div class="d-sm-flex align-items-right mb-4 col-2">
              <button id="crearProducto" class="btn btn-primary">Crear producto</button>
            </div>
          </div>

          <div class="row">
            <table class="table table-striped">
              <thead class="thead-dark">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Opciones</th>
              </thead>
              <tbody class="tbody-light">
                <?php 
                  if ($result) {
                    foreach ($result as $fila) {
                ?>
                <tr>
                  <td><?= $fila['idCategoria'] ?></td>
                  <td><?= $fila['nombre'] ?></td>
                  <td><button class="btn btn-warning"><i class="far fa-edit"></i></button><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></td>

                </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>            
          </div>
          
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Juan Bermúdez 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <script type="text/javascript">


    
    
    $('#marca').autocomplete({
      source : "cargarMarcas.php"
    });
  </script>

  <script type="text/javascript">
    $('#crearProducto').click(function() {
       Swal.fire({
        title: 'Ventana en mantenimiento',
        text: 'Estamos mejorando para ti.',
        icon: 'info',
        showCancelButton: false
      });
        })
  </script>

</body>

</html>
