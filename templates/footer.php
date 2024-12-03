  
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <!-- /.content-wrapper -->
 <!-- <footer class="main-footer">    
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer> -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/moment/locales.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- barcode -->
<script type="text/javascript" src="../dist/js/barcode.js"></script>
<script type="text/javascript" src="../dist/js/barcode.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- dropzonejs -->
<script src="../plugins/dropzone/min/dropzone.min.js"></script>

<script>  
  
  // Mascara para el input de edit fecha de producto
  $(function () {
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

    })


  //calendario
  $(function () {
    $('#fechaGarantia, #fechaGarantia_edit').datetimepicker({
      locale: 'es',
      format: 'DD/MM/YYYY',
      daysOfWeekDisabled: [6],
      //defaultDate: "11/1/2013",
      disabledDates: [
        // moment("12/25/2013"),
        "11-11-2021",
        "11-10-2021",
        "11-05-2021"
      ], });
});

  $(function () {
  //Initialize Select2 Elements
    $('.select2').select2()

  //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })


    //  CONFIGURANDO TABLAS
    $(document).ready(function () {
      var table = $("#listaClientes, #listaProcesos, #listaArchivos").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "language": {
            "decimal":        ",",
            "thousands":      ".",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty":      "Mostrando 0 a 0 de 0 Páginas",
            "infoFiltered":   "(filtrado de _MAX_ entradas totales)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron registros coincidentes",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
            "aria": {
                "sortAscending":  ": Activar para ordenar la columna en orden ascendente",
                "sortDescending": ": Activar para ordenar la columna en orden descendente"
            }
        }
      });

      table.buttons().container().appendTo('#vBuscar_wrapper .col-md-6:eq(0)');
    });

    //Eliminar Archivo de un proceso
    function eliminarArchivo(idArchivo, boton) {
    if (confirm("¿Estás seguro de que deseas eliminar este archivo?")) {
        fetch('eliminar_archivo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_archivo=${idArchivo}`
        })
        .then(response => response.text())
        .then(data => {
            if (data === "success") {
                // Eliminar la fila del archivo en la tabla
                const fila = boton.closest('tr');
                fila.remove();
                alert("Archivo eliminado correctamente.");
            } else {
                alert("Error al eliminar el archivo: " + data);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Ocurrió un error al eliminar el archivo.");
        });
    }
}
  // Cerrar session sola 
  function cerrarSesion() {
        document.getElementById('cerrarSesion').click();
    }
</script>
</body>
</html>