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
    $('#bobinaCorteAddForm').submit(function(){
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
                    var bobinadecorte = data.respuesta.bobinasdecorte;
                    var empleado = data.respuesta.empleado;
                    var bobinasorigens = data.respuesta.bobinasorigens;
                    var cortadora = data.respuesta.cortadora;
                    loadBobinaCorte(bobinadecorte,empleado,bobinasorigens,cortadora);
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
        var tieneimpresion = $("#tieneimpresion").val(); 
        if(tieneimpresion){
            getListaBobinaImpresionParaCorte(); 
        }else{
            getListaBobinasExtrusionParaCorte();
        }    
       
    }) ;
    $('#cerrarOrdenDeTrabajo').submit(function(){
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
                }

            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    $("#terminacion").on('change',function(){
        getBobinasExtrusionsParciales();
    });
});
function getBobinasExtrusionsParciales(){
    var ordenesdetrabajoId = $("#ordenesdetrabajo-id").val();
    if($("#terminacion").val()=='Complementaria'){
        $.ajax({
            type: 'POST',
            url: serverLayoutURL+'bobinasdeextrusions/getparciales/'+ordenesdetrabajoId+'.json',
            data: '',
            success: function(response,textStatus,xhr){
                if(response.respuesta.error!=0){
                    Toast.fire({
                      icon: 'error',
                      title: data.data.respuesta
                    })
                }else{
                    var bobinasdeextrusionsparciales = response.respuesta.data;
                    
                    var hayBobinasDeExtrusion = false;
                    for (var p in bobinasdeextrusionsparciales) {
                        if( bobinasdeextrusionsparciales.hasOwnProperty(p) ) {
                            $("#modalAddBobinaEstrusion #bobinasdeextrusion-id").append(
                                '<option value="'+p+'">'+bobinasdeextrusionsparciales[p]+'</option>'
                            );
                            hayBobinasDeExtrusion = true;
                        } 
                    }       
                    if(hayBobinasDeExtrusion){
                        Toast.fire({
                          icon: 'success',
                          title: 'Se cargo la lista de bobinas de extrusion parciales.'
                        });                   
                        $("#bobinasdeextrusion-id").attr('disabled',false);
                    }else{
                        Toast.fire({
                          icon: 'error',
                          title: "no hay bobinas de extrusion parciales para usar."
                        });
                        $("#terminacion").val('Completa');
                        $("#bobinasdeextrusion-id").find('option')
                                                   .remove();
                        $("#bobinasdeextrusion-id").attr('disabled',true);
                    }
                }
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
    }else{
        $("#bobinasdeextrusion-id").find('option')
                                   .remove();
        $("#bobinasdeextrusion-id").attr('disabled',true);
    }
}
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
                var bobinasdeextrusions = response.respuesta.data;
                
                var hayBobinasDeExtrusion = false;
                for (var p in bobinasdeextrusions) {
                    if( bobinasdeextrusions.hasOwnProperty(p) ) {
                        $("#modalAddBobinaImpresion #bobinasdeextrusion-id").append('<option value="'+p+'">'+bobinasdeextrusions[p]+'</option>');
                        hayBobinasDeExtrusion = true;
                    } 
                }       
                if(hayBobinasDeExtrusion){
                    Toast.fire({
                      icon: 'success',
                      title: 'Se cargo la lista de bobinas de extrusion.'
                    })                   
                }else{
                    Toast.fire({
                      icon: 'error',
                      title: "no hay bobinas de extrusion para usar"
                    });
                    $('#modalAddBobinaImpresion').modal('hide');                    
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
                var hayBobinasDeExtrusion = false;
                for (var p in bobinasdeextrusions) {
                    if( bobinasdeextrusions.hasOwnProperty(p) ) {
                        hayBobinasDeExtrusion = true;
                        $("#modalAddBobinaCorte #bobinasdeextrusion-id").append('<option value="'+p+'">'+bobinasdeextrusions[p]+'</option>');
                    } 
                }         
                if(hayBobinasDeExtrusion){
                    Toast.fire({
                      icon: 'success',
                      title: 'Se cargo la lista de bobinas de extrusion.'
                    })                   
                }else{
                    Toast.fire({
                      icon: 'error',
                      title: "no hay bobinas de extrusion para usar"
                    });
                    $('#modalAddBobinaCorte').modal('hide');                    
                }
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function getListaBobinaImpresionParaCorte(){
    var ordenesdetrabajoId = $("#ordenesdetrabajo-id").val();
    //limpiamos la lista
    $("#modalAddBobinaCorte #bobinasdeimpresion-id")
        .find('option')
        .remove();
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'bobinasdeimpresions/getlist/'+ordenesdetrabajoId+'.json',
        data: '',
        success: function(response,textStatus,xhr){
            if(response.respuesta.error!=0){
                Toast.fire({
                  icon: 'error',
                  title: data.data.respuesta
                })
            }else{
                var bobinasdeimpresions = response.respuesta.data;
                var hayBobinasDeImpresion = false;
                for (var p in bobinasdeimpresions) {
                    if( bobinasdeimpresions.hasOwnProperty(p) ) {
                        hayBobinasDeImpresion = true;
                        $("#modalAddBobinaCorte #bobinasdeimpresion-id").append('<option value="'+p+'">'+bobinasdeimpresions[p]+'</option>');
                    } 
                }        
                if(hayBobinasDeImpresion){
                    Toast.fire({
                      icon: 'success',
                      title: 'Se cargo la lista de bobinas de impresion.'
                    })                   
                }else{
                    Toast.fire({
                      icon: 'error',
                      title: "No hay bobinas de impresion para usar."
                    });
                    $('#modalAddBobinaCorte').modal('hide');                    
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
                    .html(bobinaestrusion.metros)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.scrap)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.observacion)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.terminacion)
            )
            .append(
                $("<td>")
                    .append(
                        $("<button>")
                            .attr('type','button')
                            .attr('name','button')
                            .attr('onclick',"imprimir("+bobinaestrusion.id+")")
                            .addClass("btn btn-warning btn-sm")
                            .append(
                                $("<i>").addClass("fas fa-print")
                            )
                    )
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
function loadBobinaCorte(bobinadecorte, empleado, bobinasorigens, cortadora){
    var tblBobinasdeEstrusion = $("#tblBobinasdeCorte");
    var misBobinasOrigenes = "";
    var tieneimpresion = $("#tieneimpresion").val(); 
    $(bobinasorigens).each(function(){
        if(tieneimpresion){
            misBobinasOrigenes += this.bobinasdeimpresion.numero+"-";    
        }
        
    });
    tblBobinasdeEstrusion.append(
        $("<tr>")
            .append(
                $("<td>")
                    .html(bobinadecorte.numero)
            )
            .append(
                $("<td>")
                    .html(cortadora.nombre)
            )
            .append(
                $("<td>")
                    .html(misBobinasOrigenes)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.fecha)
            )
            .append(
                $("<td>")
                    .html(empleado.nombre)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.horas)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.kilogramos)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.scrap)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.observacion)
            )
    )
}
