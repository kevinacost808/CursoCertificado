var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    // Cuando se muestra el modal, inicializa los eventos
    $('#modalmantenimiento').on('shown.bs.modal', function () {
        // Asegurar que el evento submit se registre correctamente
        $(document).off("submit", "#categoria_form").on("submit", "#categoria_form", function(e) {
            e.preventDefault();
            guardarEditar(e);
        });
    }); 

    $('#categoria_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/categoria.php?op=listar",
            type: "POST",
            data: { usu_id: usu_id }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength":15,
        "order":[[0,"desc"]],
        "language":{
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _Menu_ Registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate":{
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria":{
                "sSortAscending":"Activar para ordenar la columna de manera Ascendente",
                "sSortDescending":"Activar para ordenar la columna de manera Descendente"
            }
        }
    });
})

function guardarEditar(e) {
    e.preventDefault();

    var formData = new FormData($("#categoria_form")[0]);

    $.ajax({
        url: '../../controller/categoria.php?op=guardarEditar',
        type: 'POST',
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response) {
            $('#categoria_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide'); // Cierra el modal tras éxito
            //Manejo de alertas
            Swal.fire({
                title: 'Correcto!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición:", error);
            //Manejo de alertas
            Swal.fire({
                title: 'Error!',
                text: 'NO se ha registrado correctamente',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

function nuevo(){
    $('#lblTitulo').html('Nuevo Registro');
    $('#categoria_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

function editar(cat_id){
    $.post("../../controller/categoria.php?op=mostrar",{cat_id:cat_id}, function(data){
        $('#cat_id').val(data.cat_id);
        $('#cat_nombre').val(data.cat_nombre);
    });
    $('#lblTitulo').html('Modificar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(cat_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eliminar el registro?',
        icon: 'error',
        confirmButtonText: 'Si',
        showCancelButton: true,
        cancelButtonText: 'No',
    }).then((result)=>{
        if(result.value){
            $.post("../../controller/categoria.php?op=eliminar",{cat_id:cat_id}, function(data){
                $('#categoria_data').DataTable().ajax.reload();
                console.log(data.status);
                Swal.fire({
                    title: 'Error!',
                    text: data.message,
                    icon: data.status,
                    confirmButtonText: 'Aceptar'
                });
            });
        }
    })
}
