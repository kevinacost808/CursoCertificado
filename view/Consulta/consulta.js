$(document).ready(function(){
    //Ocultamos el panel
    $('#divpanel').hide();
    //cuando le damos click al btn conusltar
    $(document).on("click", "#btnConsultar", function(){
        //Extraer correo y eliminar los espacios en blanco
        var usu_correo = $('#usu_correo').val().trim();
        //verificar si el correo es vacio
        if(usu_correo===''){
            //Manejo de alertas
            Swal.fire({
                title: 'Error!',
                text: 'Correo vacio',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        //Si ha mandado un correo    
        }else{
            //Verificar si el correo existe en la bd
            $.post("../../controller/usuario.php?op=consultaCorreo",{usu_correo:usu_correo}, function(data){
                //Si hay datos
                if(data.length>0){
                    //Extraemos el id
                    var usu_id = data[0].usu_id;
                    var usu_nom = data[0].usu_nom;
                    var usu_apep = data[0].usu_apep;
                    var usu_apem = data[0].usu_apem;
                    $('#lblDatos').html(usu_nom+" "+usu_apep+" "+usu_apem);
                    // MOstramos el panel
                    $('#divpanel').show();
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
                            url: "../../controller/usuario.php?op=listarCursosTop10",
                            type: "POST",   
                            data: { usu_id: usu_id }
                        },
                        "bDestroy": true,
                        "responsive": true,
                        "bInfo": true,
                        "iDisplayLength":10,
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
                    })
                }else{
                    //Manejo de alertas
                    Swal.fire({
                        title: 'Error!',
                        text: 'No existe usuario con ese correo',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    })
                }
            });
        }
    });
});

//TODO Funcion para ver el ccertificado en otra pestaña
function certificado(curd_id){
    window.open('../Certificado/index.php?curd_id='+curd_id,'_BLANCK');    
};