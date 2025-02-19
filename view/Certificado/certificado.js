//Traer el elemento con id canvad
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

$(document).ready(function(){
    //Traer el curd_id desde la url
    var curd_id = getUrlParameter('curd_id');
    //Llamar a mi controlador para obtener los datos por curd_id
    $.post("../../controller/usuario.php?op=mostrarCursoDetalle", {curd_id: curd_id}, function(data){
        //Cargar la descripcion en la etiqueta con id cur_descrip
        $('#cur_descrip').html(data.cur_descrip)
        
        //Creamos una imagen para el certificado
        const image = new Image();
        //crear la imagen para el qr
        const imageqr = new Image();
        image.src = data.cur_img;
        imageqr.src ="../../public/qr/"+curd_id+".png";

        image.onload = function () {
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
            ctx.font = '45px Arial';
            ctx.textAlign = 'center';
            ctx.textBaseLine = 'middle';
            var x = canvas.width / 2;
            //Pasamos los datos de la consulta para que cada certificado sea único
            ctx.fillText(data.usu_nom+" "+data.usu_apep+" "+data.usu_apem, x, 280);
            ctx.font = '30px Arial';
            ctx.fillText(data.cur_nombre, x, 370);
            ctx.font = '18px Arial';
            ctx.fillText('Fecha inicio: '+data.cur_fechini+' / Fecha Fin: '+data.cur_fechfin, x, 580);
            //Lo colocamos y le damos 100 de alto y anchgo
            ctx.drawImage(imageqr, 0, 0, 100, 100);
        };
    });
});

$(document).on("click","#btnpng",function(){
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado.png";
    lblpng.href = canvas.toDataURL();
    lblpng.click();
})

$(document).on("click", "#btnpdf", function () {
    var element = document.getElementById("canvas"); // Elemento que queremos convertir en PDF
    html2pdf()
        .set({
            margin: 10,
            filename: 'Certificado.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4', compressPDF: true }
        })
        .from(element)
        .save();
});


//Funcion para obtener parametro del url:
var getUrlParameter = function getUrlParameter(sParam){
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
     
    for (i = 0;i < sURLVariables.length; i++){
        sParameterName = sURLVariables[i].split('=');

        if(sParameterName[0] === sParam){
            return sParameterName[1] === undefined ? true: sParameterName[1];
        }
    }
};