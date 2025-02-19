var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    // Cuando se muestra el modal, inicializa los eventos
    $('#modalmantenimiento').on('shown.bs.modal', function () {
        init();
    });

    function init() {
    
        // Asegurar que el evento submit se registre correctamente
        $(document).off("submit", "#cursos_form").on("submit", "#cursos_form", function(e) {
            e.preventDefault();
            guardarEditar(e);
        });

        // Asegurar que el evento submit se registre correctamente
        $(document).off("submit", "#detalle_form").on("submit", "#detalle_form", function(e) {
            e.preventDefault();
            guardarEditarImg();
        });
    }

    $('#cat_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });
    $('#inst_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    comboCategoria();
    comboInstructor();    

    $('#cursos_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/curso.php?op=listar",
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
});

function imagen(cur_id){
    $('#curx_idx').val(cur_id);
    $('#lblTitulo').html('Seleccionar Archivo:');
    $('#modalimg').modal('show');
};

function guardarEditarImg() {

    var formData = new FormData($("#detalle_form")[0]);

    $.ajax({
        url: "../../controller/curso.php?op=updateImagenCurso",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                Swal.fire({
                    title: 'Éxito!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    $('#cursos_data').DataTable().ajax.reload();
                    $('#modalimg').modal('hide'); // Cierra el modal tras éxito
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: response.message || 'Error en la actualización',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        },
        error: function (xhr) {
            console.log(formData);
            console.error("Error en la solicitud:", xhr.responseText);
            Swal.fire({
                title: 'Error!',
                text: 'Hubo un problema en el servidor',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    });

    return false; // Evita el envío tradicional del formulario
}

function guardarEditar(e) {
    e.preventDefault();

    var formData = new FormData($("#cursos_form")[0]);

    $.ajax({
        url: '../../controller/curso.php?op=guardarEditar',
        type: 'POST',
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response) {
            $('#cursos_data').DataTable().ajax.reload();
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
    $('#cursos_form')[0].reset();
    comboCategoria();
    comboInstructor();
    $('#modalmantenimiento').modal('show');
}

function editar(cur_id){
    $.post("../../controller/curso.php?op=mostrar",{cur_id:cur_id}, function(data){
        $('#cur_id').val(data.cur_id);
        $('#cat_id').val(data.cat_id).trigger('change');
        $('#cur_nombre').val(data.cur_nombre);
        $('#cur_descrip').val(data.cur_descrip);
        $('#cur_fechini').val(data.cur_fechini);
        $('#cur_fechfin').val(data.cur_fechfin);
        $('#inst_id').val(data.inst_id).trigger('change');
    });
    $('#lblTitulo').html('Modificar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(cur_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eliminar el registro?',
        icon: 'error',
        confirmButtonText: 'Si',
        showCancelButton: true,
        cancelButtonText: 'No',
    }).then((result)=>{
        if(result.value){
            $.post("../../controller/curso.php?op=eliminar",{cur_id:cur_id}, function(data){
                console.log("elimin")
                $('#cursos_data').DataTable().ajax.reload();
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

function comboCategoria(){
    $.post("../../controller/categoria.php?op=combo", function(data){
        $('#cat_id').html(data);
    })
}

function comboInstructor(){
    $.post("../../controller/instructor.php?op=combo", function(data){
        $('#inst_id').html(data);
    })
}

