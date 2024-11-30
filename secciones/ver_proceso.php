<?php include("../templates/header.php") ?>
<?php

if ($_SESSION['valSudoAdmin']) {
    $lista_procesos_link  = "index_procesos.php";
  
 }else{
    $lista_procesos_link  = "index_procesos.php?link=".$link;
 }

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
   
    // Obtener los procesos
    $datos_proveedores = $conexion->prepare("SELECT * FROM procesos WHERE id_proceso = :id_proceso");

    $datos_proveedores->bindParam(":id_proceso", $txtID);
    $datos_proveedores->execute();
    $registro = $datos_proveedores->fetch(PDO::FETCH_ASSOC);

    $num_radicado = $registro['radicado_proceso'];
    $denunciante_proceso = $registro['denunciante_proceso'];
    $cc_denunciante_proceso = $registro['cc_denunciante_proceso'];
    $demandado_proceso = $registro['demandado_proceso'];
    $cc_demandado_proceso = $registro['cc_demandado_proceso'];
    $claset_proceso = $registro['clase_proceso'];
    $autoridad_proceso = $registro['autoridad_proceso'];
    $observaciones_proceso = $registro['observacion_proceso'];

    $link_proveedores = $registro['link'];
    
    if ($_POST) {
        $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
        $radicado_proceso = isset($_POST['num_radicado']) ? $_POST['num_radicado'] : " ";
        $denunciante_proceso = isset($_POST['denunciante_proceso']) ? $_POST['denunciante_proceso'] : " ";
        $cc_denunciante_proceso = isset($_POST['cc_denunciante_proceso']) ? $_POST['cc_denunciante_proceso'] : " ";
        $demandado_proceso = isset($_POST['demandado_proceso']) ? $_POST['demandado_proceso'] : " ";
        $cc_demandado_proceso = isset($_POST['cc_demandado_proceso']) ? $_POST['cc_demandado_proceso'] : " ";
        $clase_proceso = isset($_POST['claset_proceso']) ? $_POST['claset_proceso'] : " ";
        $autoridad_proceso = isset($_POST['autoridad_proceso']) ? $_POST['autoridad_proceso'] : " ";
        $observacion_proceso = isset($_POST['observaciones_proceso']) ? $_POST['observaciones_proceso'] : " ";

        $link = isset($_POST['link']) ? $_POST['link'] : " ";

        $sentencia_edit = $conexion->prepare("UPDATE procesos SET 
        radicado_proceso=:radicado_proceso, denunciante_proceso=:denunciante_proceso, cc_denunciante_proceso=:cc_denunciante_proceso,
        demandado_proceso=:demandado_proceso, cc_demandado_proceso=:cc_demandado_proceso,clase_proceso=:clase_proceso,autoridad_proceso=:autoridad_proceso,observacion_proceso=:observacion_proceso, link=:link WHERE id_proceso=:id_proceso");

        $sentencia_edit->bindParam(":id_proceso", $txtID);
        $sentencia_edit->bindParam(":radicado_proceso", $radicado_proceso);
        $sentencia_edit->bindParam(":denunciante_proceso", $denunciante_proceso);
        $sentencia_edit->bindParam(":cc_denunciante_proceso", $cc_denunciante_proceso);
        $sentencia_edit->bindParam(":demandado_proceso", $demandado_proceso);
        $sentencia_edit->bindParam(":cc_demandado_proceso", $cc_demandado_proceso);
        $sentencia_edit->bindParam(":clase_proceso", $clase_proceso);
        $sentencia_edit->bindParam(":autoridad_proceso", $autoridad_proceso);
        $sentencia_edit->bindParam(":observacion_proceso", $observacion_proceso);

        $sentencia_edit->bindParam(":link", $link);

        $resultado_edit = $sentencia_edit->execute();

        if ($resultado_edit) {
            echo '<script>
            Swal.fire({
                title: "¡Proceso Editado Exitosamente!",
                icon: "success",
                confirmButtonText: "¡Entendido!"
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location.href = "'.$url_base.'secciones/'.$lista_procesos_link.'";
                }
            })
        </script>';
        } else {
            echo '<script>
            Swal.fire({
                title: "Error al Actualizar el Proceso",
                icon: "error",
                confirmButtonText: "¡Entendido!"
            });
            </script>';
            }
    }
}

?>

<br>
    <div class="card card-warning" style="margin-top:5%">
        <div class="card-header">
            <h2 class="card-title textTabla">Radicado <?=$num_radicado?></h2>
        </div>
        <form action=" " method="post">
            <div class="card-body">
                <input type="hidden" name="txtID" value="<?= $txtID ?>">
                <input type="hidden" name="link" value="<?= $link_proveedores ?>">                
                <!---->
                <div class="row" style="justify-content:center">                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Demandante/Denunciante</label> &nbsp;<i class="nav-icon"></i>
                            <input type="text" class="form-control camposTabla" name="denunciante_proceso" value="<?=$denunciante_proceso?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">CC/Nit</label> &nbsp;<i class="nav-icon"></i>
                            <input type="text" class="form-control camposTabla" name="cc_denunciante_proceso" value="<?=$cc_denunciante_proceso?>" readonly>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row" style="justify-content:center">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Demandado</label> &nbsp;<i class="nav-icon"></i>
                            <input type="text" class="form-control camposTabla" name="demandado_proceso" value="<?=$demandado_proceso?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">CC/Nit</label> &nbsp;<i class="nav-icon"></i>
                            <input type="text" class="form-control camposTabla" name="cc_demandado_proceso" value="<?=$cc_demandado_proceso?>" readonly>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>                    
                </div>
                <!---->
                <div class="row" style="justify-content:center">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Clase Proceso</label> &nbsp;<i class="nav-icon"></i>
                            <input type="text" class="form-control camposTabla" name="claset_proceso" value="<?=$claset_proceso?>" readonly>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Autoridad</label> &nbsp;<i class="nav-icon"></i>
                            <input type="text" class="form-control camposTabla" name="autoridad_proceso" value="<?=$autoridad_proceso?>" readonly>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row" style="justify-content:center">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="textLabel">Observaciones</label> &nbsp;<i class="nav-icon"></i>
                            <input type="text" class="form-control camposTabla" name="observaciones_proceso" value="<?=$observaciones_proceso?>" readonly>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <!--Tabla de Archivos -->      
                    <table id="listaArchivos" class="table table-bordered table-striped" style="text-align:center">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- <?php $count = 0;
                        foreach ($lista_archivo as $registro) {?> -->
                                <!-- <?php } ?> -->
                            <tr>
                            <td scope="row"><?php $count++;  echo $count; ?></td>    
                            <td>nombre el archivo</td>
                            <td>fecha</td>          
                            <td>
                                Aqui boton descarga / eliminar                    
                            </td>
                            </tr>  
                        </tbody>                  
                    </table>                
                    <div style="text-align:center; margin-top: 20px;">
                        <a role="button" href="<?php echo $url_base; ?>secciones/<?php echo $lista_procesos_link; ?>" class="btn btn-danger btn-lg">Salir</a>
                    </div>

            </div>
        </form>
    </div>
    <?php include("../templates/footer.php") ?>