var usu_id = $('#usu_idx').val();

$(document).ready(function(){

    $('#detalle_form').on('click', function(e){
        guardarEditarImg(e);
    });

    $('#cur_id, #usu_id, #inst_id').select2();
    comboCurso(); 

    $('#cur_id').change(function(){
        $("#cur_id option:selected").each(function(){
            cur_id = $(this).val();
            $('#detalle_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons:[
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax": {
                    url: "../../controller/detallecurso.php?op=listarCursosUsuarioId",
                    type: "POST",
                    data: { cur_id: cur_id }
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

    });

});

function nuevo(){
    if ($('#cur_id').val() === '') {
        //Manejo de alertas
        Swal.fire({
            title: 'Error!',
            text: 'Seleccione un curso',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }else{
        var cur_id = $('#cur_id').val();
        listarUsarioModal(cur_id);
        $('#modalmantenimiento').modal('show');
    }
    $('#lblTitulo').html('Seleccionar Usuario:');
}

function registrarDetalle(){
    table = $('#usuario_data').DataTable();
    var usu_id=[];

    table.rows().every(function(rowIdx, tableLoop, rowLoop){
        cel1 = table.cell({row: rowIdx, column:0}).node();
        if($('input',cel1).prop("checked")==true){
            id = $('input',cel1).val();
            usu_id.push([id]);
        }
    });
    if(usu_id.length===0){
        //Manejo de alertas
        Swal.fire({
            title: 'Error!',
            text: 'Seleccione un un usuario',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return;
    }else{
        const formData = new FormData($("#form_detalle")[0]);
        formData.append('cur_id', cur_id);
        formData.append('usu_id', usu_id);
        $.ajax({
            url: "../../controller/detallecurso.php?op=guardar",//Guardamos el usuario
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {//Si es correcto
                //Hacemos un for por si hay mas de un usuario nuevo al curso
                data.forEach(e => {//Ingresamos al json
                    e.forEach(i=>{//Ingresamos al json
                        i.forEach(j=>{//Ingresamos al json
                            $.ajax({
                                type: "POST",
                                //Llamamos para que genere el qr
                                url: "../../controller/detallecurso.php?op=generarQr",
                                data: {curd_id:j['curd_id']},//De acuerdo al curd_id
                                dataType: 'json'
                            });
                        })
                    });
                });
                Swal.fire({
                    title: 'Éxito!',
                    text: 'Usuarios registrados correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    $('#detalle_data').DataTable().ajax.reload();
                    $('#usuario_data').DataTable().ajax.reload();
                    $('#modalmantenimiento').modal('hide'); // Cerrar modal si todo fue exitoso
                });
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un problema al registrar los usuarios',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }
}

function listarUsarioModal(cur_id){
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
            url: "../../controller/usuario.php?op=listarModal",
            type: "POST",
            data: { cur_id: cur_id }
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
}

function eliminar(curd_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eliminar el registro?',
        icon: 'error',
        confirmButtonText: 'Si',
        showCancelButton: true,
        cancelButtonText: 'No',
    }).then((result)=>{
        if(result.value){
            $.post("../../controller/detallecurso.php?op=eliminar",{curd_id:curd_id}, function(data){
                $('#detalle_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
        }
        $('#usuario_data').DataTable().ajax.reload();
    })
}

function certificado(curd_id){
    window.open('../Certificado/index.php?curd_id='+curd_id,'_BLANCK');    
}

function comboCurso(){
    $.post("../../controller/curso.php?op=combo", function(data){
        $('#cur_id').html(data);
    })
}