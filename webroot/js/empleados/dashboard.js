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

                var tr = $("<tr>")
                        .append(
                            $("<td class='text-center'>").html(this.prioridad)
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
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.impreso?'SI':'NO')
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.cortado?'SI':'NO')
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

                var tr = $("<tr>")
                        .append(
                            $("<td class='text-center'>").html(this.prioridad)
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
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.impreso?'SI':'NO')
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.cortado?'SI':'NO')
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

                var tr = $("<tr>")
                        .append(
                            $("<td class='text-center'>").html(this.prioridad)
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
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.impreso?'SI':'NO')
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.cortado?'SI':'NO')
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
    window.open(serverLayoutURL+'ordenesdetrabajos/view/'+ordenid,);
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
