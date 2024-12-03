<?php
require_once __DIR__ . '/../db.php';
if (isset($_POST['id_archivo'])) {
    $id_archivo = $_POST['id_archivo'];

    // Eliminar el archivo de la base de datos
    $query = $conexion->prepare("DELETE FROM archivos WHERE id_archivo = :id_archivo");
    $query->bindParam(":id_archivo", $id_archivo);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "No se especificó un archivo.";
}


?>