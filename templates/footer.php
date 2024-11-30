  
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

    // Escucha los cambios en los campos precio menor y mayor
    $(document).on('input', '.precio_menor', function () {
      var fila = $(this).closest('tr');
      var tipoPrecio = $('input[name="tipo-precio"]:checked').val(); 
      actualizarTotal(fila, tipoPrecio); 
    });
    $(document).on('input', '.precio_mayor', function () {
      var fila = $(this).closest('tr');
      var tipoPrecio = $('input[name="tipo-precio"]:checked').val(); 
      actualizarTotal(fila, tipoPrecio); 
    });

    

// Función para actualizar el campo de cambio
function actualizarCampoCambio() {
    let total_factura = $(".campo-total-global").val();
    total_factura = total_factura.replace(/[$,]/g, "");
    let recibido = $("#recibido").val();
    recibido = recibido.replace(/[$,.]/g, "");

    // Calcula el cambio
    let cambio = recibido - total_factura;
    // Actualiza el campo "Se devuelve"
    let cambioFormateado = cambio.toLocaleString('en-US', {style: 'currency', currency: 'USD', minimumFractionDigits: 0});
    // Actualiza el campo "Se devuelve"
    $('.se_devuelve').val(cambioFormateado);
}
 
    //  CONFIGURANDO TABLAS
    $(document).ready(function () {
      var table = $("#listaClientes, #listaProductos, #lista_categoria").DataTable({
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

    // Quitar las flechas de los campos number
    document.addEventListener('DOMContentLoaded', function() {
      var numberInput = document.getElementById('producto_stock_total');
      var numberInput_2 = document.getElementById('producto_modelo');
      var numberInput_add = document.getElementById('producto_stock_total_add');

      numberInput.addEventListener('focus', function() {
          this.setAttribute('type', 'text');
      });
      numberInput.addEventListener('blur', function() {
          this.setAttribute('type', 'number');
      });

      numberInput_2.addEventListener('focus', function() {
          this.setAttribute('type', 'text');
      });
      numberInput_2.addEventListener('blur', function() {
          this.setAttribute('type', 'number');
      });

      numberInput_add.addEventListener('focus', function() {
          this.setAttribute('type', 'text');
      });
      numberInput_add.addEventListener('blur', function() {
          this.setAttribute('type', 'number');
      });
    });

    // Ocultar y mostrar campo de cuotas cuando pagan a credito
    document.addEventListener("DOMContentLoaded", function () {
      mostrarOcultarPartes();
    });


    // Función formato dinero 
  $(document).ready(function() {
      function formatDineroSinDecimales(valor) {
          return "$" + parseFloat(valor).toFixed(0).replace(/\d(?=(\d{3})+$)/g, "$&,");
      }
      $("#producto_precio_compra, #producto_precio_venta" + "#producto_precio_compra_edit, #producto_precio_venta_edit,#precio_compra_stock, #precio_venta_stock").on("input", function() {
          var valor = $(this).val().replace(/[^0-9]/g, '');
          $(this).val(formatDineroSinDecimales(valor));
      });

      // Evento al enviar el formulario
      $("form").submit(function() {
          var valor = $("#producto_precio_compra, #producto_precio_venta," + "#producto_precio_compra_edit,#precio_compra_stock,#precio_venta_stock").val().replace(/[^0-9]/g, ''); 
          $("#cajaEfectivo").val(valor);
      });
  });

  // Validar los select obligatorios
  function validarFormulario(id) {
    if (id == 1) {
      var categoriaSeleccionada = document.forms["formProducto"]["categoria_id"].value;
     // var proveedorSeleccionado = document.forms["formProducto"]["proveedor_id"].value;
      if (categoriaSeleccionada == "") {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Por favor, seleccione una categoría.',
          });
          return false;
      }
      // if (proveedorSeleccionado == "") {
      //     Swal.fire({
      //         icon: 'error',
      //         title: 'Oops...',
      //         text: 'Por favor, seleccione un proveedor.',
      //     });
      //     return false;
      // }
    }else if(id == 2){
      var rolSeleccionado = document.forms["formEmpleado"]["usuario_empresa"].value;
    //   var cajaSeleccionado = document.forms["formEmpleado"]["usuario_caja"].value;

      if (rolSeleccionado == "") {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Por favor, seleccione un negocio donde va a laboral el empleado.',
          });
          return false;
      }
    //   if (cajaSeleccionado == "") {
    //       Swal.fire({
    //           icon: 'error',
    //           title: 'Oops...',
    //           text: 'Por favor, seleccione una Caja para el empleado.',
    //       });
    //       return false;
    //   }
    }else if (id == 3) {
      var usuario_empresaSeleccionada = document.forms["formGastos"]["usuario_empresa_gastos"].value;
      if (usuario_empresaSeleccionada == "") {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Por favor, seleccione una Empresa.',
          });
          return false;
      }
    }else if (id == 4) {
      var negocioSeleccionada = document.forms["formNomina"]["nomina_empresa"].value;
      var nomina_empleadosSeleccionada = document.forms["formNomina"]["nomina_empleados"].value;
      if (negocioSeleccionada == "") {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Por favor, seleccione una Empresa.',
          });
          return false;
      }
      if (nomina_empleadosSeleccionada == "") {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Por favor, seleccione un Empleado.',
          });
          return false;
      }
    }
    return true;
}
    
  // Cerrar session sola 
  function cerrarSesion() {
        document.getElementById('cerrarSesion').click();
    }
</script>
</body>
</html>