var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$(document).ready(function() {
    $('#bobinaEstrusionAddForm').submit(function(){
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
                if(data.respuesta.error!=0){
                Toast.fire({
                      icon: 'error',
                      title: data.respuesta.respuesta
                    })
                }else{
                    Toast.fire({
                      icon: 'success',
                      title: data.respuesta.respuesta
                    })
                    loadBobinaEstrusion(data.respuesta.bobinasdeextrusion,data.respuesta.empleado,data.respuesta.extrusora);
                    $('#modalAddBobinaEstrusion').modal('hide');
                }
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    $('#bobinaImpresionAddForm').submit(function(){
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
                if(data.respuesta.error!=0){
                Toast.fire({
                      icon: 'error',
                      title: data.respuesta.respuesta
                    })
                }else{
                    Toast.fire({
                      icon: 'success',
                      title: data.respuesta.respuesta
                    })
                    loadBobinaImpresion(data.respuesta.bobinasdeimpresion,data.respuesta.empleado,data.respuesta.bobinasdeextrusion,data.respuesta.impresora);
                    $('#modalAddBobinaImpresion').modal('hide');
                }
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    $('#modalAddBobinaImpresion').on('shown.bs.modal', function() { 
       getListaBobinasExtrusionParaImpresion();
    }) ;
    $('#modalAddBobinaCorte').on('shown.bs.modal', function() { 
       getListaBobinasExtrusionParaCorte();
    }) ;
});
function getListaBobinasExtrusionParaImpresion(){
    var ordenesdetrabajoId = $("#ordenesdetrabajo-id").val();
    //limpiamos la lista
    $("#modalAddBobinaImpresion #bobinasdeextrusion-id")
        .find('option')
        .remove();
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'bobinasdeextrusions/getlist/'+ordenesdetrabajoId+'.json',
        data: '',
        success: function(response,textStatus,xhr){
            if(response.respuesta.error!=0){
                Toast.fire({
                  icon: 'error',
                  title: data.data.respuesta
                })
            }else{
                if(bobinasdeextrusions.count()==0){
                    Toast.fire({
                      icon: 'error',
                      title: "no hay bobinas de extrusion para usar"
                    });
                    $('#modalAddBobinaImpresion').modal('hide');
                    return false;
                }

                Toast.fire({
                  icon: 'success',
                  title: 'Se cargo la lista de bobinas de extrusion.'
                })
                var bobinasdeextrusions = response.respuesta.data;

                for (var p in bobinasdeextrusions) {
                    if( bobinasdeextrusions.hasOwnProperty(p) ) {
                        $("#modalAddBobinaImpresion #bobinasdeextrusion-id").append('<option value="'+p+'">'+bobinasdeextrusions[p]+'</option>');
                    } 
                }         
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function getListaBobinasExtrusionParaCorte(){
    var ordenesdetrabajoId = $("#ordenesdetrabajo-id").val();
    //limpiamos la lista
    $("#modalAddBobinaCorte #bobinasdeextrusion-id")
        .find('option')
        .remove();
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'bobinasdeextrusions/getlist/'+ordenesdetrabajoId+'.json',
        data: '',
        success: function(response,textStatus,xhr){
            if(response.respuesta.error!=0){
                Toast.fire({
                  icon: 'error',
                  title: data.data.respuesta
                })
            }else{
                var bobinasdeextrusions = response.respuesta.data;
                if(bobinasdeextrusions.count()==0){
                    Toast.fire({
                      icon: 'error',
                      title: "no hay bobinas de extrusion para usar"
                    });
                    $('#modalAddBobinaCorte').modal('hide');
                    return false;
                }

                Toast.fire({
                  icon: 'success',
                  title: 'Se cargo la lista de bobinas de extrusion.'
                })
               

                for (var p in bobinasdeextrusions) {
                    if( bobinasdeextrusions.hasOwnProperty(p) ) {
                        $("#modalAddBobinaCorte #bobinasdeextrusion-id").append('<option value="'+p+'">'+bobinasdeextrusions[p]+'</option>');
                    } 
                }         
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function loadBobinaEstrusion(bobinaestrusion, empleado,estrusora){
    var tblBobinasdeEstrusion = $("#tblBobinasdeEstrusion");
    tblBobinasdeEstrusion.append(
        $("<tr>")
            .append(
                $("<td>")
                    .html(bobinaestrusion.numero)
            )
            .append(
                $("<td>")
                    .html(estrusora.nombre)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.fecha)
            )
            .append(
                $("<td>")
                    .html(empleado.nombre)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.horas)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.kilogramos)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.scrap)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.observacion)
            )
    )
}
function loadBobinaImpresion(bobinaimpresion, empleado, bobinasdeestrusion, impresora){
    var tblBobinasdeEstrusion = $("#tblBobinasdeImpresion");
    tblBobinasdeEstrusion.append(
        $("<tr>")
            .append(
                $("<td>")
                    .html(bobinaimpresion.numero)
            )
            .append(
                $("<td>")
                    .html(impresora.nombre)
            )
            .append(
                $("<td>")
                    .html(bobinasdeestrusion.numero)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.fecha)
            )
            .append(
                $("<td>")
                    .html(empleado.nombre)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.horas)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.kilogramos)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.scrap)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.observacion)
            )
    )
}
