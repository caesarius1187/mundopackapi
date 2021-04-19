var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$(document).ready(function() {
    $('#bobinaEstrusionAddForm').submit(function(){
        var empleadoId = $('#bobinaEstrusionAddForm').find("#empleado-id").val();
        if(!empleadoId){
            Toast.fire({
              icon: 'error',
              title: "Debe seleccionar un empleado."
            })
            return false;
        }
        var kilogramos = $('#bobinaEstrusionAddForm').find("#kilogramos").val();
        if(!kilogramos){
            Toast.fire({
              icon: 'error',
              title: "Debe Cargar kilogramos."
            })
            return false;
        }
        var metros = $('#bobinaEstrusionAddForm').find("#metros").val();
        if(!metros){
            Toast.fire({
              icon: 'error',
              title: "Debe Cargar metros."
            })
            return false;
        }
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
                    //mostramos +1 en el btn de extrusadas
                    if($("#modalAddBobinaEstrusion").find("#terminacion").val()!='Parcial'){
                        var aextrusar = $("#aextrusar").val();
                        var extrusadas = $("#extrusadas").val();
                        if($("#btnExtruasdas").length>0){
                            extrusadas++;
                            $("#btnExtruasdas").html(extrusadas+"/"+aextrusar);
                        }
                        $("#extrusadas").val(extrusadas);
                    }
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
        var empleadoId = $('#bobinaImpresionAddForm').find("#empleado-id").val();
        if(!empleadoId){
            Toast.fire({
              icon: 'error',
              title: "Debe seleccionar un empleado."
            })
            return false;
        }
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
                    //mostramos +1 en el btn de extrusadas
                    if(data.respuesta.bobinasdeimpresion.terminacion!='Parcial'&&data.respuesta.bobinasdeextrusion.terminacion!='Parcial'){
                        var aextrusar = $("#aextrusar").val();
                        var impresas = $("#impresas").val();
                        if($("#btnImpresas").length>0){
                            impresas++;
                            $("#btnImpresas").html(impresas+"/"+aextrusar);
                        }
                        $("#impresas").val(impresas);
                    }
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
        var bobinasimpresions = $('#bobinaCorteAddForm').find("#bobinasdeimpresion-id").val();
        var bobinasdeextrusions = $('#bobinaCorteAddForm').find("#bobinasdeextrusion-id").val();
        if(bobinasimpresions && bobinasimpresions.length==0){
            Toast.fire({
              icon: 'error',
              title: "Debe seleccionar la/s bobina/s de impresion que se usaron."
            })
            return false;
        }
        if(bobinasdeextrusions && bobinasdeextrusions.length==0){
            Toast.fire({
              icon: 'error',
              title: "Debe seleccionar la/s bobina/s de extrusion que se usaron."
            })
            return false;
        }
        var empleadoId = $('#bobinaCorteAddForm').find("#empleado-id").val();
        if(!empleadoId){
            Toast.fire({
              icon: 'error',
              title: "Debe seleccionar un empleado."
            })
            return false;
        }
        var kilogramos = $('#bobinaCorteAddForm').find("#kilogramos").val();
        if(!kilogramos){
            Toast.fire({
              icon: 'error',
              title: "Debe Cargar kilogramos."
            })
            return false;
        }
        if ( $('#divRowBobinasAgregadas').children().length == 0 ) {
            Toast.fire({
              icon: 'error',
              title: "Debe Agregar Bobinas de extrusion o impresion a la bobina de corte."
            })
            return false;
        }
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
                    //mostramos +1 en el btn de extrusadas
                    var tieneimpresion = $("#tieneimpresion").val();
                    $(bobinasorigens).each(function(){
                        if(tieneimpresion){
                            var aextrusar = $("#aextrusar").val();
                            var cortadas = $("#cortadas").val();
                            if($("#btnCortadas").length>0){
                                cortadas++;
                                $("#btnCortadas").html(cortadas+"/"+aextrusar);
                            }
                            $("#cortadas").val(cortadas);
                        }else{
                            if(this.bobinasdeextrusion.terminacion!='Parcial'){
                                var aextrusar = $("#aextrusar").val();
                                var cortadas = $("#cortadas").val();
                                if($("#btnCortadas").length>0){
                                    cortadas++;
                                    $("#btnCortadas").html(cortadas+"/"+aextrusar);
                                }
                                $("#cortadas").val(cortadas);
                            }
                        }
                        
                    });
                    

                    $('#modalAddBobinaCorte').modal('hide');
                }
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    $("#modalAddBobinaEstrusion").on('shown.bs.modal', function() {
        $("#modalAddBobinaEstrusion").find("#empleado-id").val('');
        $("#modalAddBobinaEstrusion").find("#horas").val('');
        $("#modalAddBobinaEstrusion").find("#terminacion").val('Completa');
        $("#modalAddBobinaEstrusion").find("#bobinasdeextrusion-id").val('');
        $("#modalAddBobinaEstrusion").find("#kilogramos").val('');
        $("#modalAddBobinaEstrusion").find("#metros").val('');
        $("#modalAddBobinaEstrusion").find("#scrap").val('');
        $("#modalAddBobinaEstrusion").find("#observacion").val('');
    });
    $('#modalAddBobinaImpresion').on('shown.bs.modal', function() {
        $("#modalAddBobinaImpresion").find("#empleado-id").val('');
        $("#modalAddBobinaImpresion").find("#bobinasdeextrusion-id").val('');
        $("#modalAddBobinaImpresion").find("#horas").val('');
        $("#modalAddBobinaImpresion").find("#kilogramos").val('');
        $("#modalAddBobinaImpresion").find("#metros").val('');
        $("#modalAddBobinaImpresion").find("#scrap").val('');
        $("#modalAddBobinaImpresion").find("#observacion").val('');
        getListaBobinasExtrusionParaImpresion();
    }) ;
    $('#modalAddBobinaCorte').on('shown.bs.modal', function() {
        $("#modalAddBobinaCorte").find("#empleado-id").val('');
        $("#modalAddBobinaCorte").find("#bobinasdeextrusion-id").val('');
        $("#modalAddBobinaCorte").find("#horas").val('');
        $("#modalAddBobinaCorte").find("#kilogramos").val('');
        $("#modalAddBobinaCorte").find("#scrapsacabocado").val('');
        $("#modalAddBobinaCorte").find("#scrap").val('');
        $("#modalAddBobinaCorte").find("#cantidad").val('');
        $("#modalAddBobinaCorte").find("#observacion").val('');
        $("#modalAddBobinaCorte").find("#terminacion").val('Completa');
        $('#divRowBobinasAgregadas').empty();
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
    $("#modalAddBobinaEstrusion #terminacion").on('change',function(){
        getBobinasExtrusionsParciales();
    });
    $("#modalAddBobinaImpresion #terminacion").on('change',function(){
        getBobinasImpresionsParciales();
    });
    $("#modalAddBobinaCorte #terminacion").on('change',function(){
        getBobinasCortesParciales();
    });
    $("#modalAddBobinaImpresion #bobinasdeimpresion-id").on('change',function(){
        selectBobExtParcialCorrespondiente();
    });
});
function getBobinasExtrusionsParciales(){
    var ordenesdetrabajoId = $("#ordenesdetrabajo-id").val();
    if($("#modalAddBobinaEstrusion #terminacion").val()=='Complementaria'){
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
                        $("#modalAddBobinaEstrusion #bobinasdeextrusion-id").attr('disabled',false);
                    }else{
                        Toast.fire({
                          icon: 'error',
                          title: "no hay bobinas de extrusion parciales para usar."
                        });
                        $("#modalAddBobinaEstrusion #terminacion").val('Completa');
                        $("#modalAddBobinaEstrusion #bobinasdeextrusion-id").find('option')
                                                   .remove();
                        $("#modalAddBobinaEstrusion #bobinasdeextrusion-id").attr('disabled',true);
                    }
                }
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
    }else{
        $("#modalAddBobinaEstrusion #bobinasdeextrusion-id").find('option')
                                   .remove();
        $("#modalAddBobinaEstrusion #bobinasdeextrusion-id").attr('disabled',true);
    }
}
function getBobinasImpresionsParciales(){
    var ordenesdetrabajoId = $("#ordenesdetrabajo-id").val();
    if($("#modalAddBobinaImpresion #terminacion").val()=='Complementaria'){
        $.ajax({
            type: 'POST',
            url: serverLayoutURL+'bobinasdeimpresions/getparciales/'+ordenesdetrabajoId+'.json',
            data: '',
            success: function(response,textStatus,xhr){
                if(response.respuesta.error!=0){
                    Toast.fire({
                      icon: 'error',
                      title: data.data.respuesta
                    })
                }else{
                    var bobinasdeimpresionsparciales = response.respuesta.data;

                    var hayBobinasDeImpresion = false;
                    for (var p in bobinasdeimpresionsparciales) {
                        if( bobinasdeimpresionsparciales.hasOwnProperty(p) ) {
                            $("#modalAddBobinaImpresion #bobinasdeimpresion-id").append(
                                '<option value="'+p+'">'+bobinasdeimpresionsparciales[p]+'</option>'
                            );

                            hayBobinasDeImpresion = true;
                        }
                    }
                    selectBobExtParcialCorrespondiente();
                    if(hayBobinasDeImpresion){
                        Toast.fire({
                          icon: 'success',
                          title: 'Se cargo la lista de bobinas de impresion parciales.'
                        });
                        $("#modalAddBobinaImpresion #bobinasdeimpresion-id").attr('disabled',false);
                    }else{
                        Toast.fire({
                          icon: 'error',
                          title: "no hay bobinas de impresion parciales para usar."
                        });
                        $("#modalAddBobinaImpresion #terminacion").val('Completa');
                        $("#modalAddBobinaImpresion #bobinasdeimpresion-id").find('option')
                                                   .remove();
                        $("#modalAddBobinaImpresion #bobinasdeimpresion-id").attr('disabled',true);
                    }
                }
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
    }else{
        $("#modalAddBobinaImpresion #bobinasdeimpresion-id").find('option')
                                   .remove();
        $("#modalAddBobinaImpresion #bobinasdeimpresion-id").attr('disabled',true);
    }
}
function getBobinasCortesParciales(){
    var ordenesdetrabajoId = $("#ordenesdetrabajo-id").val();
    if($("#modalAddBobinaCorte #terminacion").val()=='Complementaria'){
        var tieneimpresion = $("#tieneimpresion").val();
        $.ajax({
            type: 'POST',
            url: serverLayoutURL+'bobinascorteorigens/getparciales/'+ordenesdetrabajoId+'/'+tieneimpresion+'.json',
            data: '',
            success: function(response,textStatus,xhr){
                if(response.respuesta.error!=0){
                    Toast.fire({
                      icon: 'error',
                      title: data.data.respuesta
                    })
                }else{
                    var bobinasdecortesparciales = response.respuesta.data;

                    var hayBobinasDeCorte = false;
                    $("#origenbobinasdeimpresion-id").find('option')
                                                   .remove();
                    for (var p in bobinasdecortesparciales) {
                        if( bobinasdecortesparciales.hasOwnProperty(p) ) {
                            if(tieneimpresion){
                                
                                $("#origenbobinasdeimpresion-id").append(
                                    '<option value="'+p+'">'+bobinasdecortesparciales[p]+'</option>'
                                );
                            }else{
                                $("#origenbobinasdeextrusion-id").find('option')
                                                   .remove();
                                $("#origenbobinasdeextrusion-id").append(
                                    '<option value="'+p+'">'+bobinasdecortesparciales[p]+'</option>'
                                );
                            }
                            hayBobinasDeCorte = true;
                        }
                    }
                    //selectBobExtParcialCorrespondiente();
                    if(hayBobinasDeCorte){
                        Toast.fire({
                          icon: 'success',
                          title: 'Se cargo la lista de bobinas de corte parciales.'
                        });
                    }else{
                        Toast.fire({
                          icon: 'error',
                          title: "no hay bobinas de corte parciales para usar."
                        });
                        $("#modalAddBobinaCorte #terminacion").val('Completa');
                        $("#origenbobinasdeextrusion-id").find('option')
                                                   .remove();
                        if(tieneimpresion){
                            getListaBobinaImpresionParaCorte();
                        }else{
                            getListaBobinasExtrusionParaCorte();
                        }
                    }
                }
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
    }else{
        var tieneimpresion = $("#tieneimpresion").val();
        if(tieneimpresion){
            getListaBobinaImpresionParaCorte();
        }else{
            getListaBobinasExtrusionParaCorte();
        }
    }
}
function selectBobExtParcialCorrespondiente(){
    var numBobinaImpParcialSelect = $("#modalAddBobinaImpresion #bobinasdeimpresion-id").val();
    var numBobinaExtrRelacionada = $("#bobinasdeextrusiondeimp"+numBobinaImpParcialSelect).val();
    var mymodal = $("#modalAddBobinaImpresion");
    var mySelect = mymodal.find("#bobinasdeextrusion-id")
    mySelect.find("option").removeAttr('selected');
    var myOption = mySelect.find("option[value='"+numBobinaExtrRelacionada+"']")
    mySelect.prop('selectedIndex',0);
    myOption.attr("selected", true);
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
    $("#modalAddBobinaCorte #origenbobinasdeextrusion-id")
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
                        $("#modalAddBobinaCorte #origenbobinasdeextrusion-id").append('<option value="'+p+'">'+bobinasdeextrusions[p]+'</option>');
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
    $("#modalAddBobinaCorte #origenbobinasdeimpresion-id")
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
                        $("#modalAddBobinaCorte #origenbobinasdeimpresion-id").append('<option value="'+p+'">'+bobinasdeimpresions[p]+'</option>');
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
    var f=new Date(bobinaestrusion.fecha);
    var dia=String(f.getDate()).padStart(2,"0");
    var mes=String(f.getMonth()+1).padStart(2,"0");
    var anio=String(f.getFullYear());
    var hora=String(f.getHours()).padStart(2,"0");
    var minutos=String(f.getMinutes()).padStart(2,"0");
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
                    .html(dia+'-'+mes+'-'+anio+' '+hora+':'+minutos)
            )
            .append(
                $("<td>")
                    .html(empleado.nombre)
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
    var f=new Date(bobinaimpresion.fecha);
    var dia=String(f.getDate()).padStart(2,"0");
    var mes=String(f.getMonth()+1).padStart(2,"0");
    var anio=String(f.getFullYear());
    var hora=String(f.getHours()).padStart(2,"0");
    var minutos=String(f.getMinutes()).padStart(2,"0");
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
                    .append(
                        $("<input>")
                            .attr('type','hidden')
                            .attr('name','bobinasdeextrusiondeimp'+bobinaimpresion.id)
                            .attr('id','bobinasdeextrusiondeimp'+bobinaimpresion.id)
                            .attr('value',bobinasdeestrusion.id)
                    )
                    .append(
                        bobinasdeestrusion.numero
                    )
            )
            .append(
                $("<td>")
                    .html(dia+'-'+mes+'-'+anio+' '+hora+':'+minutos)
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
                    .html(bobinaimpresion.metros)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.scrap)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.terminacion)
            )
            .append(
                $("<td>")
                    .html(bobinaimpresion.observacion)
            )
    )
}
var bobinasOrigenesAgregadas = 0;
function loadBobinaOrigen(){
    var tieneimpresion = $("#tieneimpresion").val();
    var misBobinasOrigenId = 0;
    var nameSelectBobinaOrigen = 0;
    var selectedBobinaText = "";
    if(tieneimpresion){
        misBobinasOrigenId = $("#origenbobinasdeimpresion-id").val();
        idSelectBobinaOrigen = "bobinasdeimpresion-id";
        nameSelectBobinaOrigen = "bobinasdeimpresion_id";
        selectedBobinaText =  $("#origenbobinasdeimpresion-id option:selected").html();
    }else{
        misBobinasOrigenId = $("#origenbobinasdeextrusion-id").val();
        idSelectBobinaOrigen = "bobinasdeestrusion-id";
        nameSelectBobinaOrigen = "bobinasdeestrusion_id";
        selectedBobinaText =  $("#origenbobinasdeextrusion-id option:selected").html();
    }
    var terminacion = $("#bobinaCorteAddForm #terminacion").val();
    var bobinaParcialOrigen = $("#bobinascorteorigen-id").val();

    var divRowBobinasAgregadas = $('#divRowBobinasAgregadas');

    $inputIdBobinaOrigen = $("<input>")
                .attr('type','hidden')
                .attr('maxlength','50')
                .attr('name','bobinascorteorigen['+bobinasOrigenesAgregadas+']['+nameSelectBobinaOrigen+']')
                .attr('id','bobinascorteorigen-'+bobinasOrigenesAgregadas+'-'+idSelectBobinaOrigen)
                .val(misBobinasOrigenId)
                .addClass('form-control');
    $labelBobinaOrigen = $("<label>")
                .html(selectedBobinaText)
    $inputTerminacion = $("<input>")
                .attr('attr','text')
                .attr('readonly',true)
                .attr('maxlength','50')
                .attr('name','bobinascorteorigen['+bobinasOrigenesAgregadas+'][terminacion]')
                .attr('id','bobinascorteorigen-'+bobinasOrigenesAgregadas+'-terminacion')
                .val(terminacion)
                .addClass('form-control');    
    $divCol1 = $("<div>")
                    .addClass('col-sm-6')
                    .append($inputIdBobinaOrigen)
                    .append($labelBobinaOrigen);
    $divCol2 = $("<div>")
                    .addClass('col-sm-6')
                    .append($inputTerminacion);    
    divRowBobinasAgregadas.append($divCol1).append($divCol2);
    bobinasOrigenesAgregadas++;
}
function loadBobinaCorte(bobinadecorte, empleado, bobinasorigens, cortadora){
    var tblBobinasdeCorte = $("#tblBobinasdeCorte");
    var misBobinasOrigenes = "";
    var tieneimpresion = $("#tieneimpresion").val();
    $(bobinasorigens).each(function(){
        if(tieneimpresion){
            misBobinasOrigenes += this.bobinasdeimpresion.numero+"-";
        }else{
            misBobinasOrigenes += this.bobinasdeextrusion.numero+"-";
        }
    });
    var f=new Date(bobinadecorte.fecha);
    var dia=String(f.getDate()).padStart(2,"0");
    var mes=String(f.getMonth()+1).padStart(2,"0");
    var anio=String(f.getFullYear());
    var hora=String(f.getHours()).padStart(2,"0");
    var minutos=String(f.getMinutes()).padStart(2,"0");
    tblBobinasdeCorte.append(
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
                    .html(dia+'-'+mes+'-'+anio+' '+hora+':'+minutos)
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
                    .html(bobinadecorte.metros)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.scrap)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.scrapsacabocado)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.cantidad)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.terminacion)
            )
            .append(
                $("<td>")
                    .html(bobinadecorte.observacion)
            )
    )
}
