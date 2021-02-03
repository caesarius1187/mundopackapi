$(document).ready(function() {

});
function loadOTExtrusora(extrusoraId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'extrusoras/view/'+extrusoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            $('#myModalMaquina').modal('toggle');
            $('#myModalMaquina').find('.modal-title').html('<i class="fas fa-industry"></i>'+data.extrusora.nombre);
            $('#myModalMaquina').find('#tblPendientes tr').remove();
            $(data.extrusora.ordenots).each(function(){
                var porentaje = 0;
                var cantidad = this.ordenesdetrabajo.aextrusar;
                var impresas = "-";
                if(this.ordenesdetrabajo.impreso){
                    impresas = this.ordenesdetrabajo.impresas;
                    cantidad += this.ordenesdetrabajo.aextrusar*1;
                }
                var cortadas = "-";
                if(this.ordenesdetrabajo.cortado){
                    cortadas = this.ordenesdetrabajo.cortadas;
                    cantidad += this.ordenesdetrabajo.aextrusar*1;
                }

                var echas = this.ordenesdetrabajo.extrusadas;
                echas += this.ordenesdetrabajo.impresas;
                echas += this.ordenesdetrabajo.cortadas;

                porcentaje = cantidad==0 ? 0 : Math.round(echas/cantidad*10000)/100;
                var classProgress = '';
                if(porcentaje>=30 && porcentaje<60){
                  classProgress = 'bg-warning';
                }
                if(porcentaje>=60){
                  classProgress = 'bg-success';
                }
                var fechaInicio = getDateArray(this.ordenesdetrabajo.ordenesdepedido.fecha);
                var formatedFechaInicio = fechaInicio[2]+"-"+fechaInicio[1]+"-"+fechaInicio[0];
                var fechaFin = new Date(fechaInicio[0]+"-"+fechaInicio[1]+"-"+fechaInicio[2]);
                fechaFin.setDate(fechaFin.getDate() + 30);
                var fechaFinArray = getDateArrayFromDateObject(fechaFin);
                var formatedFechaFin = fechaFinArray[0]+"-"+fechaFinArray[1]+"-"+fechaFinArray[2];

                var fechaInicioTrabajo = getDateArray(this.fechainicioextrusora);
                var formatedFechaInicioTrabajo = fechaInicioTrabajo[2]+"-"+fechaInicioTrabajo[1]+"-"+fechaInicioTrabajo[0];

                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.extrusadas){
                  $BtnClassExtrusion="warning";
                }else{
                  $BtnClassExtrusion="success";                          
                }
                if(this.ordenesdetrabajo.extrusadas*1==0){
                  $BtnClassExtrusion="danger";                          
                }
                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.impresas){
                  $BtnClassImpresion="warning";
                }else{
                  $BtnClassImpresion="success";                          
                }
                if(this.ordenesdetrabajo.impresas*1==0){
                  $BtnClassImpresion="danger";                          
                }
                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.cortadas){
                  $BtnClassCorte="warning";
                }else{
                  $BtnClassCorte="success";                          
                }
                if(this.ordenesdetrabajo.cortadas*1==0){
                  $BtnClassCorte="danger";                          
                }
                var btnProgImp = "";
                if(this.ordenesdetrabajo.impreso){ 
                    btnProgImp = '<button type="button" class="btn btn-'+$BtnClassImpresion+'">'+this.ordenesdetrabajo.impresas*1+'/'+this.ordenesdetrabajo.aextrusar*1+'</button>';
                }else{
                    btnProgImp = '<button type="button" class="btn btn-success">NO</button>'
                }         
                var btnProgCorte = "";

                if(this.ordenesdetrabajo.cortado){ 
                  btnProgCorte = '<button type="button" class="btn btn-'+$BtnClassCorte+'">'+this.ordenesdetrabajo.cortadas*1+'/'+this.ordenesdetrabajo.aextrusar*1+'</button>';
                }else{
                  btnProgCorte = '<button type="button" class="btn btn-success">NO</button>';
                }

                var tr = $("<tr>")
                        .append(
                            $("<td class='text-center'>").html(this.prioridadextrusion)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaInicio)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaFin)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.ordenesdepedido.cliente.nombre)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.ordenesdepedido.numero+"-"+this.ordenesdetrabajo.numero)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.medida)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.cantidad)
                        )
                        .append(
                            $("<td class='text-center'>").html("materiales")
                        )
                        .append(
                            $("<td>").append(
                                $("<button>")
                                    .attr('type','button')
                                    .addClass("btn btn-"+$BtnClassExtrusion)
                                    .html(this.ordenesdetrabajo.extrusadas*1+"/"+this.ordenesdetrabajo.aextrusar*1)
                            )
                        )   
                        .append(
                            $("<td>").append(btnProgImp)
                        )   
                        .append(
                            $("<td>").append(btnProgCorte)
                        )                        
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.observaciones)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaInicioTrabajo)
                        )
                        .append(
                            $("<td class='text-center'>")
                              .append(
                                $("<button type='button' class='btn btn-default btn-xs'>")
                                .append(
                                    $("<i>")
                                        .addClass('fa fa-search')
                                        .attr('aria-hidden',"true")
                                        .attr('onclick','openOrdendetrabajo('+this.ordenesdetrabajo.id+')')
                                )
                              )
                        );
                $('#myModalMaquina').find('#tblHeader')
                  .removeClass('bg-info')
                  .removeClass('bg-warning')
                  .removeClass('bg-success')
                  .addClass('bg-info')

                $('#myModalMaquina').find('#tblPendientes')
                  .append(
                      tr
                  );
            });

        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}

function loadOTImpresora(impresoraId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'impresoras/view/'+impresoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            $('#myModalMaquina').modal('toggle');
            $('#myModalMaquina').find('.modal-title').html('<i class="fas fa-industry"></i>'+data.impresora.nombre);
            $('#myModalMaquina').find('#tblPendientes tr').remove();
            $(data.impresora.ordenots).each(function(){
                var porentaje = 0;
                var cantidad = this.ordenesdetrabajo.aextrusar;
                var impresas = "-";
                if(this.ordenesdetrabajo.impreso){
                    impresas = this.ordenesdetrabajo.impresas;
                    cantidad += this.ordenesdetrabajo.aextrusar*1;
                }
                var cortadas = "-";
                if(this.ordenesdetrabajo.cortado){
                    cortadas = this.ordenesdetrabajo.cortadas;
                    cantidad += this.ordenesdetrabajo.aextrusar*1;
                }

                var echas = this.ordenesdetrabajo.extrusadas;
                echas += this.ordenesdetrabajo.impresas;
                echas += this.ordenesdetrabajo.cortadas;

                porcentaje = cantidad==0 ? 0 : Math.round(echas/cantidad*10000)/100;
                var classProgress = '';
                if(porcentaje>=30 && porcentaje<60){
                  classProgress = 'bg-warning';
                }
                if(porcentaje>=60){
                  classProgress = 'bg-success';
                }
                var fechaInicio = getDateArray(this.ordenesdetrabajo.ordenesdepedido.fecha);
                var formatedFechaInicio = fechaInicio[2]+"-"+fechaInicio[1]+"-"+fechaInicio[0];
                var fechaFin = new Date(fechaInicio[0]+"-"+fechaInicio[1]+"-"+fechaInicio[2]);
                fechaFin.setDate(fechaFin.getDate() + 30);
                var fechaFinArray = getDateArrayFromDateObject(fechaFin);
                var formatedFechaFin = fechaFinArray[0]+"-"+fechaFinArray[1]+"-"+fechaFinArray[2];

                var fechaInicioTrabajo = getDateArray(this.fechainicioimpresora);
                var formatedFechaInicioTrabajo = fechaInicioTrabajo[2]+"-"+fechaInicioTrabajo[1]+"-"+fechaInicioTrabajo[0];

                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.extrusadas){
                  $BtnClassExtrusion="warning";
                }else{
                  $BtnClassExtrusion="success";                          
                }
                if(this.ordenesdetrabajo.extrusadas*1==0){
                  $BtnClassExtrusion="danger";                          
                }
                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.impresas){
                  $BtnClassImpresion="warning";
                }else{
                  $BtnClassImpresion="success";                          
                }
                if(this.ordenesdetrabajo.impresas*1==0){
                  $BtnClassImpresion="danger";                          
                }
                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.cortadas){
                  $BtnClassCorte="warning";
                }else{
                  $BtnClassCorte="success";                          
                }
                if(this.ordenesdetrabajo.cortadas*1==0){
                  $BtnClassCorte="danger";                          
                }
                var btnProgImp = "";
                if(this.ordenesdetrabajo.impreso){ 
                    btnProgImp = '<button type="button" class="btn btn-'+$BtnClassImpresion+'">'+this.ordenesdetrabajo.impresas*1+'/'+this.ordenesdetrabajo.aextrusar*1+'</button>';
                }else{
                    btnProgImp = '<button type="button" class="btn btn-success">NO</button>'
                }         
                var btnProgCorte = "";

                if(this.ordenesdetrabajo.cortado){ 
                  btnProgCorte = '<button type="button" class="btn btn-'+$BtnClassCorte+'">'+this.ordenesdetrabajo.cortadas*1+'/'+this.ordenesdetrabajo.aextrusar*1+'</button>';
                }else{
                  btnProgCorte = '<button type="button" class="btn btn-success">NO</button>';
                }

                var tr = $("<tr>")
                        .append(
                            $("<td class='text-center'>").html(this.prioridadimpresion)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaInicio)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaFin)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.ordenesdepedido.cliente.nombre)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.ordenesdepedido.numero+"-"+this.ordenesdetrabajo.numero)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.medida)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.cantidad)
                        )
                        .append(
                            $("<td class='text-center'>").html("materiales")
                        )
                        .append(
                            $("<td>").append(
                                $("<button>")
                                    .attr('type','button')
                                    .addClass("btn btn-"+$BtnClassExtrusion)
                                    .html(this.ordenesdetrabajo.extrusadas*1+"/"+this.ordenesdetrabajo.aextrusar*1)
                            )
                        )   
                        .append(
                            $("<td>").append(btnProgImp)
                        )   
                        .append(
                            $("<td>").append(btnProgCorte)
                        ) 
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.observaciones)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaInicioTrabajo)
                        )
                        .append(
                            $("<td class='text-center'>")
                              .append(
                                $("<button type='button' class='btn btn-default btn-xs'>")
                                .append(
                                    $("<i>")
                                        .addClass('fa fa-search')
                                        .attr('aria-hidden',"true")
                                        .attr('onclick','openOrdendetrabajo('+this.ordenesdetrabajo.id+')')
                                )
                              )
                        );
                        $('#myModalMaquina').find('#tblHeader')
                          .removeClass('bg-info')
                          .removeClass('bg-warning')
                          .removeClass('bg-success')
                          .addClass('bg-warning')

                        $('#myModalMaquina').find('#tblPendientes')
                          .append(
                              tr
                          );
            });

        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function loadOTCortadora(cortadoraId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'cortadoras/view/'+cortadoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            $('#myModalMaquina').modal('toggle');
            $('#myModalMaquina').find('.modal-title').html('<i class="fas fa-industry"></i>'+data.cortadora.nombre);
            $('#myModalMaquina').find('#tblPendientes tr').remove();
            $(data.cortadora.ordenots).each(function(){
                var porentaje = 0;
                var cantidad = this.ordenesdetrabajo.aextrusar;
                var impresas = "-";
                if(this.ordenesdetrabajo.impreso){
                    impresas = this.ordenesdetrabajo.impresas;
                    cantidad += this.ordenesdetrabajo.aextrusar*1;
                }
                var cortadas = "-";
                if(this.ordenesdetrabajo.cortado){
                    cortadas = this.ordenesdetrabajo.cortadas;
                    cantidad += this.ordenesdetrabajo.aextrusar*1;
                }

                var echas = this.ordenesdetrabajo.extrusadas;
                echas += this.ordenesdetrabajo.impresas;
                echas += this.ordenesdetrabajo.cortadas;

                porcentaje = cantidad==0 ? 0 : Math.round(echas/cantidad*10000)/100;
                var classProgress = '';
                if(porcentaje>=30 && porcentaje<60){
                  classProgress = 'bg-warning';
                }
                if(porcentaje>=60){
                  classProgress = 'bg-success';
                }
                var fechaInicio = getDateArray(this.ordenesdetrabajo.ordenesdepedido.fecha);
                var formatedFechaInicio = fechaInicio[2]+"-"+fechaInicio[1]+"-"+fechaInicio[0];
                var fechaFin = new Date(fechaInicio[0]+"-"+fechaInicio[1]+"-"+fechaInicio[2]);
                fechaFin.setDate(fechaFin.getDate() + 30);
                var fechaFinArray = getDateArrayFromDateObject(fechaFin);
                var formatedFechaFin = fechaFinArray[0]+"-"+fechaFinArray[1]+"-"+fechaFinArray[2];

                var fechaInicioTrabajo = getDateArray(this.fechainicioimpresora);
                var formatedFechaInicioTrabajo = fechaInicioTrabajo[2]+"-"+fechaInicioTrabajo[1]+"-"+fechaInicioTrabajo[0];

                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.extrusadas){
                  $BtnClassExtrusion="warning";
                }else{
                  $BtnClassExtrusion="success";                          
                }
                if(this.ordenesdetrabajo.extrusadas*1==0){
                  $BtnClassExtrusion="danger";                          
                }
                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.impresas){
                  $BtnClassImpresion="warning";
                }else{
                  $BtnClassImpresion="success";                          
                }
                if(this.ordenesdetrabajo.impresas*1==0){
                  $BtnClassImpresion="danger";                          
                }
                if(this.ordenesdetrabajo.aextrusar > this.ordenesdetrabajo.cortadas){
                  $BtnClassCorte="warning";
                }else{
                  $BtnClassCorte="success";                          
                }
                if(this.ordenesdetrabajo.cortadas*1==0){
                  $BtnClassCorte="danger";                          
                }
                var btnProgImp = "";
                if(this.ordenesdetrabajo.impreso){ 
                    btnProgImp = '<button type="button" class="btn btn-'+$BtnClassImpresion+'">'+this.ordenesdetrabajo.impresas*1+'/'+this.ordenesdetrabajo.aextrusar*1+'</button>';
                }else{
                    btnProgImp = '<button type="button" class="btn btn-success">NO</button>'
                }         
                var btnProgCorte = "";

                if(this.ordenesdetrabajo.cortado){ 
                  btnProgCorte = '<button type="button" class="btn btn-'+$BtnClassCorte+'">'+this.ordenesdetrabajo.cortadas*1+'/'+this.ordenesdetrabajo.aextrusar*1+'</button>';
                }else{
                  btnProgCorte = '<button type="button" class="btn btn-success">NO</button>';
                }
                
                var tr = $("<tr>")
                        .append(
                            $("<td class='text-center'>").html(this.prioridadcorte)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaInicio)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaFin)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.ordenesdepedido.cliente.nombre)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.ordenesdepedido.numero+"-"+this.ordenesdetrabajo.numero)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.medida)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.cantidad)
                        )
                        .append(
                            $("<td class='text-center'>").html("materiales")
                        )
                        .append(
                            $("<td>").append(
                                $("<button>")
                                    .attr('type','button')
                                    .addClass("btn btn-"+$BtnClassExtrusion)
                                    .html(this.ordenesdetrabajo.extrusadas*1+"/"+this.ordenesdetrabajo.aextrusar*1)
                            )
                        )   
                        .append(
                            $("<td>").append(btnProgImp)
                        )   
                        .append(
                            $("<td>").append(btnProgCorte)
                        ) 
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.observaciones)
                        )
                        .append(
                            $("<td class='text-center'>").html(formatedFechaInicioTrabajo)
                        )
                        .append(
                            $("<td class='text-center'>")
                              .append(
                                $("<button type='button' class='btn btn-default btn-xs'>")
                                .append(
                                    $("<i>")
                                        .addClass('fa fa-search')
                                        .attr('aria-hidden',"true")
                                        .attr('onclick','openOrdendetrabajo('+this.ordenesdetrabajo.id+')')
                                )
                              )
                        );
                        $('#myModalMaquina').find('#tblHeader')
                          .removeClass('bg-info')
                          .removeClass('bg-warning')
                          .removeClass('bg-success')
                          .addClass('bg-success')

                        $('#myModalMaquina').find('#tblPendientes')
                          .append(
                              tr
                          );
            });

        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function openOrdendetrabajo(ordenid){
    window.open(serverLayoutURL+'ordenesdetrabajos/view/'+ordenid,"_self");
}

function getDateArray(fecha){
    var arrayFecha = fecha.split('T');
    arrayFecha = arrayFecha[0].split('-');
    return arrayFecha;
}
function getDateArrayFromDateObject(fecha){
    var arrayFecha = [];
    arrayFecha[2]=fecha.getFullYear();
    if(fecha.getMonth()<10){
        arrayFecha[1]="0"+fecha.getDate();
    }else{
        arrayFecha[1]=fecha.getDate();
    }
    if(fecha.getDate()<10){
        arrayFecha[0]="0"+fecha.getDate();
    }else{
        arrayFecha[0]=fecha.getDate();
    }
    return arrayFecha;
}
