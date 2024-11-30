<?php include("../templates/header.php") ?>
<?php 

    
    
?>
<style>
  .empresa {
    transition: transform 0.5s ease;
}

.empresa:hover {
    transform: scale(0.9); 
}
</style>
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__shake" src="../dist/img/logos/logo_nube.png" alt="AdminLTELogo" height="60" width="80">
        </div>
        <br>
        <div class="row">
          <div class="col-3">

           <a href="crear_empresa.php"> <button type="button" class="btn btn-block btn-outline-primary btn-lg">Crear Negocio</button></a>
          
          </div>        
        </div>
        <div class="row mt-4">
        </div>
<?php include("../templates/footer.php") ?>