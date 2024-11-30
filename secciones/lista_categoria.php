<?php include("../templates/header.php") ?>
<?php 

  $crear_categoria_link  = "crear_categoria.php";

//Eliminar Elementos
if(isset($_GET['txtID'])){
  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
  
  $sentencia=$conexion->prepare("DELETE FROM categoria WHERE categoria_id=:categoria_id");
  $sentencia->bindParam(":categoria_id",$txtID);
  $sentencia->execute();
  
}
$responsable = $_SESSION['usuario_id'];
$link = "sudo_admin";


$sentencia=$conexion->prepare("SELECT c.* FROM categoria c");

$sentencia->execute();
$lista_producto=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
      <br>
      <div class="card card-primary">
        <div class="card-header">
        <h2 class="card-title textTabla">LISTA DE CATEGORÍAS &nbsp;<a class="btn btn-warning" style="color:black" href="<?php echo $url_base;?>secciones/<?php echo $crear_categoria_link;?>">Crear Categoría</a></h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="lista_categoria" class="table table-bordered table-striped" style="text-align:center">
            <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Nombre</th>
              <th>Fecha de creación</th>     
              <th>Editar</th>
            </tr>
            </thead>
            <tbody>
              <?php $count = 0;
              foreach ($lista_producto as $registro) {?>
                <tr class="">
                  <td scope="row"><?php $count++; echo $count; ?></td>
                  <td><?php echo $registro['categoria_id']; ?></td>
                  <td><?php echo $registro['categoria_nombre']; ?></td>                               
                  <td><?php echo $registro['categoria_fecha_creacion']; ?></td>     
                  <td>
                    <a class="btn btn-danger" href="lista_categoria.php?txtID=<?php echo $registro['categoria_id']; ?>" role="button" title="Eliminar">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </a>
                  </td>    
                </tr>  
              <?php } ?>
            </tbody>                  
          </table>
        </div>
      </div>
      <?php include("../templates/footer.php") ?>