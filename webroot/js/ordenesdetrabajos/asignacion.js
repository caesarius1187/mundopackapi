var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$(document).ready(function() {
    $('#ordenOtAddForm').submit(function(){
        //serialize form data
        var formData = $(this).serialize();
        //get form action
        var formUrl = $(this).attr('action')+".json";
        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(data,textStatus,xhr){
                //alert(data.data[0]);
                location.reload();
                $('#myModal').modal('toggle');
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    $(".tabbedDiv").hide();
    $(".programacionPendientes").show();
});

function playOT(oTId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdetrabajos/playot/'+oTId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            if(data.data.error!=0){
                alert(data.data.respuesta);
            }else{
                alert(data.data.respuesta);
                location.reload();
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function pausarOT(oTId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdetrabajos/pausarot/'+oTId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            if(data.data.error!=0){
                alert(data.data.respuesta);
            }else{
                alert(data.data.respuesta);
                location.reload();
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function cancelarOT(oTId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdetrabajos/cancelarot/'+oTId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            if(data.data.error!=0){
                alert(data.data.respuesta);
            }else{
                alert(data.data.respuesta);
                location.reload();
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function loadTab(clickedTab){
    $(".nav-link").removeClass("active");
    $(clickedTab).addClass("active");
    var target = $(clickedTab).attr("target");
    $(".tabbedDiv").hide();
    $("."+target).show();
}
function programarOT(OTId,numeroOT,nombrecliente){
    $('#myModal').find('.modal-title').html("Programar OT Numero: "+numeroOT+" del Cliente: "+nombrecliente);
    $("#id").val(0);
    $("#ordenesdetrabajo-id").val(OTId);
    $('#myModal').modal('toggle');
}
function editarProgramacionOt(ordenOTId,oTId,numeroOT,nombrecliente,estrusoraId,inicioEstrusion,impresoraId,inicioImpresion,cortadoraId,inicioCorte){
    $('#myModal').find('.modal-title').html("Programar OT Numero: "+numeroOT+" del Cliente: "+nombrecliente);
    $("#id").val(ordenOTId);
    $("#ordenesdetrabajo-id").val(oTId);
    //set Estrusora
    $("#extrusora_id").val(estrusoraId);
    $("#fechainicioextrusora").val(inicioEstrusion);
    //set Impresora
    $("#impresora-id").val(impresoraId);
    $("#fechainicioimpresora").val(inicioImpresion);
    //set Corte
    $("#cortadora-id").val(cortadoraId);
    $("#fechainiciocortadora").val(inicioCorte);
    $('#myModal').modal('toggle');
}
