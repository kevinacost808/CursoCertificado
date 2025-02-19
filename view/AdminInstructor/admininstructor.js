var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    // Cuando se muestra el modal, inicializa los eventos
    $('#modalmantenimiento').on('shown.bs.modal', function () {
        init();
    });

    function init() {
    
        // Asegurar que el evento submit se registre correctamente
        $(document).off("submit", "#instructor_form").on("submit", "#instructor_form", function(e) {
            e.preventDefault();
            guardarEditar(e);
        });
    }  

    $('#instructor_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/instructor.php?op=listar",
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

    var formData = new FormData($("#instructor_form")[0]);

    $.ajax({
        url: '../../controller/instructor.php?op=guardarEditar',
        type: 'POST',
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response) {
            $('#instructor_data').DataTable().ajax.reload();
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
    $('#instructor_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

function editar(inst_id){
    $.post("../../controller/instructor.php?op=mostrar",{inst_id:inst_id}, function(data){
        $('#inst_id').val(data.inst_id);
        $('#inst_nombre').val(data.inst_nombre);
        $('#inst_apep').val(data.inst_apep);
        $('#inst_apem').val(data.inst_apem);
        $('#inst_tele').val(data.inst_tele);
        $('#inst_sex').val(data.inst_sex).trigger('change');
        $('#inst_correo').val(data.inst_correo);
    });
    $('#lblTitulo').html('Modificar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(inst_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eliminar el registro?',
        icon: 'error',
        confirmButtonText: 'Si',
        showCancelButton: true,
        cancelButtonText: 'No',
    }).then((result)=>{
        if(result.value){
            $.post("../../controller/instructor.php?op=eliminar",{inst_id:inst_id}, function(data){
                console.log("elimin")
                $('#instructor_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
        }
    })
}
