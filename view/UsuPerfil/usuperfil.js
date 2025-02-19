var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("../../controller/usuario.php?op=mostrarPerfil", {usu_id: usu_id}, function(data){
        //Cargar el total en la etiqueta totalcurso
        $('#usu_nom').val(data.usu_nom),
        $('#usu_apep').val(data.usu_apep),
        $('#usu_apem').val(data.usu_apem),
        $('#usu_correo').val(data.usu_correo),
        $('#usu_pass').val(data.usu_pass),
        $('#usu_tele').val(data.usu_tele),
        //para el select 2
        $('#usu_sex').val(data.usu_sex).trigger('change');
    });
});

    
$(document).on("click","#btnActualizar", function(){
    $.post("../../controller/usuario.php?op=actualizarPerfil", 
        {
            usu_id   : usu_id,
            usu_nom  : $('#usu_nom').val(),
            usu_apep : $('#usu_apep').val(),
            usu_apem : $('#usu_apem').val(),
            usu_pass : $('#usu_pass').val(),
            usu_tele : $('#usu_tele').val(),
            usu_sex  : $('#usu_sex').val()   
        }, function(data){
    });
    //Manejo de alertas
    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })
         
});