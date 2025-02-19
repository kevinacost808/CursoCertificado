var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("../../controller/usuario.php?op=totalCursos", {usu_id: usu_id}, function(data){
        //Cargar el total en la etiqueta totalcurso
        $('#lblTotalCursos').html(data.total)
        
    });

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
})

function certificado(curd_id){
    window.open('../Certificado/index.php?curd_id='+curd_id,'_BLANCK');    
}