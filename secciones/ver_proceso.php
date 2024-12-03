<?php include("../templates/header.php") ?>
<?php

$lista_procesos_link  = "index_procesos.php";
  
 

if (isset($_GET['txtID'])) {

    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
   
    //Obtener datos del proceso
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
    
    
}
// Recuperar el archivo y otros datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['documento'])) {
    
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    $id_proceso = $txtID; 
    $file = $_FILES['documento'];

    // Verificar si el archivo es un PDF
    if ($file['type'] == 'application/pdf') {
        $nombre_archivo = $file['name'];
        $archivo_tmp = $file['tmp_name'];
        $archivo_contenido = file_get_contents($archivo_tmp);

        // Preparar la consulta SQL para insertar el archivo
        $query = $conexion->prepare("INSERT INTO archivos (id_proceso, a_archivo, a_blob) VALUES (:id_proceso, :a_archivo, :a_blob)");
        $query->bindParam(":id_proceso", $id_proceso);
        $query->bindParam(":a_archivo", $nombre_archivo);
        $query->bindParam(":a_blob", $archivo_contenido, PDO::PARAM_LOB);

        // Ejecutar la consulta
        if ($query->execute()) {
            echo "Archivo subido exitosamente.";
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "Solo se permiten archivos PDF.";
    }
}

//Obtener los archivos del proceso
if (isset($_GET['txtID'])) {
    $archivos_proceso = $conexion->prepare("SELECT * FROM archivos WHERE id_proceso = :id_proceso");
    $archivos_proceso -> bindparam(":id_proceso", $txtID);
    $archivos_proceso -> execute();

    $registro_archivo = $archivos_proceso->fetchAll(PDO::FETCH_ASSOC);

    }
?>


<br>
    <div class="card card-warning" style="margin-top:5%">
        <div class="card-header">
            <h2 class="card-title textTabla">Radicado <?=$num_radicado?></h2>
        </div>
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
                    <table id="listaArchivos" class="table table-bordered table-striped" style="text-align:center; ">
                        <thead>
                        <tr>
                        <th style="width: 10%;">#</th>
                        <th style="width: 50%;">Nombre</th>
                        <th style="width: 10%;">Fecha</th>
                        <th style="width: 20%;">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $count = 0; // Contador para enumerar las filas
                            foreach ($registro_archivo as $registro) { 
                                $count++;
                            ?>
                                <tr>
                                    <td scope="row"><?= $count; ?></td>    
                                    <td><?= htmlspecialchars($registro['a_archivo']); ?></td> <!-- Muestra el nombre del archivo -->
                                    <td><?= htmlspecialchars($registro['a_fecha']); ?></td> <!-- Muestra la fecha -->
                                    <td>
                                        <!-- Botón para Ver el archivo -->
                                        <a href="ver_archivo.php?txtID=<?= $registro['id_archivo']; ?>" class="btn btn-info" target="_blank">Ver</a>

                                        <!-- Botón para eliminar -->
                                        <button class="btn btn-danger" 
                                        onclick="eliminarArchivo(<?= $registro['id_archivo']; ?>, this)">Eliminar</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>                 
                    </table>  
                        <!-- Subir Archivo -->
                    <div class="text-center " style="text-align:center; margin-top: 20px; padding: 20px;">
                        <form action="" method="post" enctype="multipart/form-data" style="display: inline-block;">
                            <label for="documento" style="display: block; margin-bottom: 10px; font-family: Arial, sans-serif; color: #555;">Selecciona un archivo:</label>
                            <input 
                                type="file" 
                                name="documento" 
                                id="documento" 
                                style="padding: 5px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;">                            
                            <input 
                                type="submit" 
                                value="Subir" 
                                style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 15px;"
                                onmouseover="this.style.backgroundColor='#0056b3'" 
                                onmouseout="this.style.backgroundColor='#007bff'">
                        </form>
                    </div>

                               
                    <div style="text-align:center; margin-top: 20px;">
                        <a role="button" href="<?php echo $url_base; ?>secciones/<?php echo $lista_procesos_link; ?>" class="btn btn-danger btn-lg">Salir</a>
                    </div>
            </div>
    </div>
    <?php include("../templates/footer.php") ?>