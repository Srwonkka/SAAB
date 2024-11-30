<?php include("../templates/header.php") ?>
<?php 
  $crear_proceso_link  = "crear_proceso.php";
  $editar_proceso  = "editar_proceso.php?txtID";
  $lista_procesos_link  = "index_procesos.php?txtID";
  $ver_proceso  = "ver_proceso.php?txtID";

//Eliminar Elementos
if(isset($_GET['txtID'])){

  $txtID = (isset($_GET['txtID']))?$_GET['txtID']:"";
  
  $sentencia=$conexion->prepare("DELETE FROM procesos WHERE id_proceso =:id_proceso");
  $sentencia->bindParam(":id_proceso",$txtID);
  $sentencia->execute();
  
}
$linkeo = 0;
if(isset($_GET['link'])){ $linkeo=(isset($_GET['link']))?$_GET['link']:"";}

  $responsable = $_SESSION['usuario_id'];


  $sentencia=$conexion->prepare("SELECT p.* FROM procesos p");
  
  $sentencia->execute();
  $lista_proveedores=$sentencia->fetchAll(PDO::FETCH_ASSOC); 

?>
      <br>
      <div class="card card-primary ">
        <div class="card-header text-center ">
        <h2 class="card-title textTabla">LISTA DE PROCESOS  &nbsp; <a href="<?php echo $url_base;?>secciones/<?php echo $crear_proceso_link;?>" class="btn btn-warning" style="color:black"> Registrar Proceso </a> </h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="listaProcesos" class="table table-bordered table-striped" style="text-align:center ">
            <thead>
            <tr>
              <th>#</th>
              <th>Radicado</th>
              <th>Demandante/Denunciante</th>
              <th>CC/Nit</th>
              <th>Demandado</th>
              <th>CC/Nit</th>
              <th>Clase Proceso</th>
              <th>Autoridad</th>
              <th>Observaciones</th>
              <th>Documentos del Proceso</th>
              <th>Opciones</th>

            </tr>
            </thead>
            <tbody>
              <?php foreach ($lista_proveedores as $registro) {?>
                <tr>
                  <td scope="row"><?php echo $registro['id_proceso']; ?></td>
                  <td><?php echo $registro['radicado_proceso']; ?></td>
                  <td><?php echo $registro['denunciante_proceso']; ?></td>
                  <td><?php echo $registro['cc_denunciante_proceso']; ?></td>
                  <td><?php echo $registro['demandado_proceso']; ?></td>                
                  <td><?php echo $registro['cc_demandado_proceso']; ?></td>                                  
                  <td><?php echo $registro['clase_proceso']; ?></td>                                  
                  <td><?php echo $registro['autoridad_proceso']; ?></td>                                  
                  <td><?php echo $registro['observacion_proceso']; ?></td>                                  
                  <td>
                    <a class="btn btn-info btn-sm" href="<?php echo $url_base;?>secciones/<?php echo $ver_proceso;?>=<?php echo $registro['id_proceso']; ?>"role="button" title="Ver documentos">
                      <i class="fa fa-folder-open"></i> Documentos
                    </a>
                  </td>                                   
                  <td>
                    <a class="btn btn-info btn-sm" href="<?php echo $url_base;?>secciones/<?php echo $editar_proceso;?>=<?php echo $registro['id_proceso']; ?>"role="button" title="Editar">
                      <i class="fas fa-edit"></i> Editar
                    </a>
                    <a class="btn btn-danger btn-sm" href="<?php echo $url_base;?>secciones/<?php echo $lista_procesos_link;?>=<?php echo $registro['id_proceso']; ?>" role="button" title="Eliminar">
                      <i class="fas fa-trash"></i> Eliminar 
                    </a>
                  </td>
                </tr>  
              <?php } ?>
            </tbody>                  
          </table>
        </div>
      </div>
      <?php include("../templates/footer.php") ?>