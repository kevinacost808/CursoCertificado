var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    // Cuando se muestra el modal, inicializa los eventos
    $('#modalmantenimiento').on('shown.bs.modal', function () {
        init();
    });

    function init() {
    
        // Asegurar que el evento submit se registre correctamente
        $(document).off("submit", "#usuario_form").on("submit", "#usuario_form", function(e) {
            e.preventDefault();
            guardarEditar(e);
        });
    }

    $('#rol_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    comboRol();  

    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/usuario.php?op=listar",
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

    var formData = new FormData($("#usuario_form")[0]);

    $.ajax({
        url: '../../controller/usuario.php?op=guardarEditar',
        type: 'POST',
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function(response) {
            $('#usuario_data').DataTable().ajax.reload();
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
    $('#usuario_form')[0].reset();
    comboRol();
    $('#modalmantenimiento').modal('show');
}

function editar(usu_id){
    $.post("../../controller/usuario.php?op=mostrar",{usu_id:usu_id}, function(data){
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_sex').val(data.usu_sex);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_tele').val(data.usu_tele);
        $('#rol_id').val(data.rol_id).trigger('change');
    });
    $('#lblTitulo').html('Modificar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(usu_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eliminar el registro?',
        icon: 'error',
        confirmButtonText: 'Si',
        showCancelButton: true,
        cancelButtonText: 'No',
    }).then((result)=>{
        if(result.value){
            $.post("../../controller/usuario.php?op=eliminar",{usu_id:usu_id}, function(data){
                $('#usuario_data').DataTable().ajax.reload();
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

function comboRol(){
    $.post("../../controller/rol.php?op=combo", function(data){
        $('#rol_id').html(data);
    })
}

// Definición global
function plantilla(){
    $('#lblTitulo').html('Selecciona Archivo');
    $('#modalplantilla').modal('show');
}
var ExcelToJSON = function() {

    this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            }); 
            workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                userList = JSON.parse(json_object);

                for (i = 0; i < userList.length; i++) {
                    var columns = Object.values(userList[i]);
                    $.post("../../controller/usuario.php?op=guardarDesdeExcel",{
                        usu_nom: columns[0],
                        usu_apep:columns[1],
                        usu_apem:columns[2],
                        usu_sex:columns[3],
                        usu_correo:columns[4],
                        usu_pass:columns[5],
                        usu_tele:columns[6],
                        rol_id:columns[7]
                    }, function(data){
                    });
                }
                document.getElementById('upload').value=null; //Vaciar campo despues de agregar excel
                $('#usuario_data').DataTable().ajax.reload();//Recargar la tabla
                $('#modalplantilla').modal('hide'); // Cierra el modal tras éxito
                //Manejo de alertas
                Swal.fire({
                    title: 'Correcto!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });


            });
        };
        reader.onerror = function(ex) {
            console.log(ex);
        };

            reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {

    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);
