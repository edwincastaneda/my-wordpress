jQuery(document).ready(function () {
    jQuery('#tabla').DataTable({
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar por p&aacute;gina: _MENU_",
            info: "Mostrando del _START_ al _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando del 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ning&uacute;n dato disponible en esta tabla",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Anterior"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        }
    });


    var id_producto=jQuery("#id_producto").val();
    var seleccionado=jQuery("#producto-"+id_producto).val();
    jQuery('#imagen-producto').attr('src',seleccionado);
        
    jQuery("#id_producto").change(function () {
        var id_producto=jQuery("#id_producto").val();
        var seleccionado=jQuery("#producto-"+id_producto).val();
       jQuery('#imagen-producto').attr('src',seleccionado);
       
       
        if(jQuery(this).val()=="--"){
        jQuery('.error-id_producto').show();
        jQuery('#imagen-producto').attr('src','');
        }else{
         jQuery('.error-id_producto').hide();   
        }
       
    });
    
    jQuery("#id_animal").change(function () {
        if(jQuery(this).val()=="--"){
        jQuery('.error-id_animal').show();
        }else{
         jQuery('.error-id_animal').hide();   
        }
       
    });
    
    jQuery("#id_enfermedad").change(function () {
        if(jQuery(this).val()=="--"){
        jQuery('.error-id_enfermedad').show();
        }else{
         jQuery('.error-id_enfermedad').hide();   
        }
       
    });

});