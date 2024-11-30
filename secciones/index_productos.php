<?php include("../templates/header.php") ?>
<?php 

if(isset($_GET['link'])){
  $link=(isset($_GET['link']))?$_GET['link']:"";
}

//Eliminar Elementos
if(isset($_GET['txtID'])){

  $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

  $sentencia=$conexion->prepare("DELETE FROM producto WHERE producto_id=:producto_id");
  $sentencia->bindParam(":producto_id",$txtID);
  $sentencia->execute();
  
}
$responsable = $_SESSION['usuario_id'];
$sentencia=$conexion->prepare("SELECT p.*, c.* FROM producto p LEFT JOIN categoria c ON p.categoria_id = c.categoria_id ");


$sentencia->execute();
$lista_producto=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
      <br>
      <div class="card card-primary">
        <div class="card-header">
          <h2 class="card-title textTabla">LISTA DE PRODUCTOS &nbsp;<a class="btn btn-warning" style="color:black" href="<?php echo $url_base;?>secciones/<?php echo $crear_producto_link;?>">Crear Producto</a></h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="listaProductos" class="table table-bordered table-striped" style="text-align:center">
            <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Precio de compra</th>     
              <th>Categoría</th>
              <th>Cantidad en Stock</th>
              <th>Garantía</th>
              <th>Opciones</th> 
            </tr>
            </thead>
            <tbody>
              <?php $count = 0;
              foreach ($lista_producto as $registro) {?>
                <tr class="">
                  <td scope="row"><?php $count++; echo $count; ?></td>
                  <td><?php echo $registro['producto_nombre']; ?></td>
                  <td><?php echo $registro['producto_marca']; ?></td>
                  <td><?php echo $registro['producto_modelo']; ?></td>
                  <td class="tdColor"><?php echo '$' . number_format($registro['producto_precio_compra'], 0, '.', ','); ?></td>  
                  <td><?php echo $registro['categoria_nombre']; ?></td>
                  <td><?php echo $registro['producto_stock_total']; ?></td>
                  <td><?php echo $registro['producto_fecha_garantia']; ?></td>
                  <td>                    
                   <a class="btn btn-info" href="<?php echo $url_base;?>secciones/<?php echo $editar_producto_link . '?' . http_build_query(['data-value' => $registro['link']]); ?><?php echo '&txtID=' . $registro['producto_id']; ?>" role="button" title="Editar">
                      <i class="fas fa-edit"></i>Editar
                   </a>                    
                    <a class="btn btn-danger" href="index_productos.php?txtID=<?php echo $registro['producto_id']; ?>" role="button" title="Eliminar">
                      <i class="far fa-trash-alt"></i>Eliminar 
                    </a>
                  </td>
                </tr>  
              <?php } ?>
            </tbody>                  
          </table>
        </div>
      </div>
      <?php include("../templates/footer.php") ?>