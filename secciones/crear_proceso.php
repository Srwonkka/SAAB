<?php include("../templates/header.php") ?>
<?php

if ($_POST) {
    $num_radicado= isset($_POST['num_radicado']) ? $_POST['num_radicado'] : " ";
    $denunciante_proceso= isset($_POST['denunciante_proceso']) ? $_POST['denunciante_proceso'] : " ";
    $cc_denunciante_proceso= isset($_POST['cc_denunciante_proceso']) ? $_POST['cc_denunciante_proceso'] : " ";
    $demandado_proceso= isset($_POST['demandado_proceso']) ? $_POST['demandado_proceso'] : " ";
    $cc_demandado_proceso= isset($_POST['cc_demandado_proceso']) ? $_POST['cc_demandado_proceso'] : " ";
    $claset_proceso= isset($_POST['claset_proceso']) ? $_POST['claset_proceso'] : " ";
    $autoridad_proceso= isset($_POST['autoridad_proceso']) ? $_POST['autoridad_proceso'] : " ";
    $observaciones_proceso= isset($_POST['observaciones_proceso']) ? $_POST['observaciones_proceso'] : " ";   

    $responsable = $_SESSION['usuario_id'];

    $link =  isset($_POST['link']) ? $_POST['link'] : "";
    if ($responsable == 1) {
        $link =  "sudo_admin";
    }
    $sentencia = $conexion->prepare("INSERT INTO procesos (id_proceso ,
        radicado_proceso, denunciante_proceso, cc_denunciante_proceso, demandado_proceso, cc_demandado_proceso,clase_proceso,autoridad_proceso,observacion_proceso, link) 
        VALUES (NULL,:radicado_proceso,:denunciante_proceso,:cc_denunciante_proceso,:demandado_proceso,:cc_demandado_proceso,:clase_proceso,:autoridad_proceso,:observacion_proceso,:link)");

    $sentencia->bindParam(":radicado_proceso", $num_radicado);
    $sentencia->bindParam(":denunciante_proceso", $denunciante_proceso);
    $sentencia->bindParam(":cc_denunciante_proceso", $cc_denunciante_proceso);
    $sentencia->bindParam(":demandado_proceso", $demandado_proceso);
    $sentencia->bindParam(":cc_demandado_proceso", $cc_demandado_proceso);
    $sentencia->bindParam(":clase_proceso", $claset_proceso);
    $sentencia->bindParam(":autoridad_proceso", $autoridad_proceso);
    $sentencia->bindParam(":observacion_proceso", $observaciones_proceso);
    $sentencia->bindParam(":link", $link);

    $resultado = $sentencia->execute();

    if ($resultado) {
        echo '<script>
        Swal.fire({
            title: "Proceso creado Exitosamente!",
            icon: "success",
            confirmButtonText: "¡Entendido!"
        }).then((result)=>{
            if(result.isConfirmed){
                window.location.href= "'.$url_base.'secciones/'.$lista_procesos_link.'"
            }
        })
        </script>';
    } else {
        echo '<script>
        Swal.fire({
            title: "Error al Crear el Proceso!",
            icon: "error",
            confirmButtonText: "¡Entendido!"
        });
        </script>';
    }
}
?>

<br>
<!-- left column -->
<div class="">
    <!-- general form elements -->
    <div class="card card-primary" style="margin-top:5%">
        <div class="card-header">
            <h2 class="card-title textTabla">REGISTRAR PROCESO &nbsp;  <a href="<?php echo $url_base;?>secciones/<?php echo $lista_procesos_link;?>" class="btn btn-warning" style="color:black"> Lista procesos </a></h2>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" " method="post">
            <div class="card-body">
            <div class="row" style="justify-content:center">
                <div class="col-sm-2">
                    <div class="form-group">
                            <label for="producto_nombre" class="textLabel">Radicado</label> &nbsp;<i class="nav-icon fas fa-edit">  </i>
                            <input type="text" class="form-control camposTabla" name="num_radicado" required>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row" style="justify-content:center">                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Demandante/Denunciante</label> &nbsp;<i class="nav-icon fas fa-edit"></i>
                            <input type="text" class="form-control camposTabla" name="denunciante_proceso" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">CC/Nit</label> &nbsp;<i class="nav-icon fas fa-edit"></i>
                            <input type="text" class="form-control camposTabla" name="cc_denunciante_proceso" required>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row" style="justify-content:center">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Demandado</label> &nbsp;<i class="nav-icon fas fa-edit"></i>
                            <input type="text" class="form-control camposTabla" name="demandado_proceso" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">CC/Nit</label> &nbsp;<i class="nav-icon fas fa-edit"></i>
                            <input type="text" class="form-control camposTabla" name="cc_demandado_proceso" required>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>                    
                </div>
                <!---->
                <div class="row" style="justify-content:center">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Clase Proceso</label> &nbsp;<i class="nav-icon fas fa-edit"></i>
                            <input type="text" class="form-control camposTabla" name="claset_proceso" required>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="textLabel">Autoridad</label> &nbsp;<i class="nav-icon fas fa-edit"></i>
                            <input type="text" class="form-control camposTabla" name="autoridad_proceso" required>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row" style="justify-content:center">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="textLabel">Observaciones</label> &nbsp;<i class="nav-icon fas fa-edit"></i>
                            <input type="text" class="form-control camposTabla" name="observaciones_proceso" required>
                            <div id="mensaje" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="link" value="<?php echo $link ?>">
                <div  style="text-align:center">
                    <button type="submit" class="btn btn-primary btn-lg" name="guardar">Guardar</button>
                    <a role="button" href="<?php echo $url_base;?>secciones/<?php echo $lista_procesos_link;?>" class="btn btn-danger btn-lg">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
<?php include("../templates/footer.php") ?>