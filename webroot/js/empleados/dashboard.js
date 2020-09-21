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

                $('#myModalMaquina').find('#tblPendientes').append(
                    $("<tr>")
                        .append(
                            $("<td class='text-center'>").html("P"+this.ordenesdetrabajo.ordenesdepedido.numero+"-"+this.ordenesdetrabajo.numero)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.aextrusar)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.extrusadas)
                        )
                         .append(
                            $("<td class='text-center'>").html(impresas)
                        )
                        .append(
                            $("<td class='text-center'>").html(cortadas)
                        )
                        .append(
                          $("<td class='align-middle'>")
                            .append(
                                $("<div>")
                                    .addClass('progress progress-xs')
                                    .append(
                                        $("<div>")
                                            .addClass('progress-bar '+classProgress)
                                            .css('width',porcentaje+'%')
                                    )
                            )
                        )
                        .append(
                          $("<td>")
                              .append(
                                  $("<span>")
                                      .addClass('badge bg-danger')
                                      .html(porcentaje+"%")
                              )
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
                        )
                )
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
function loadOTImpresora(impresoraId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'impresoras/view/'+impresoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            $('#myModalMaquina').modal('toggle');
            $('#myModalMaquina').find('.modal-title').html('<i class="fas fa-print"></i>'+data.impresora.nombre);
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

                $('#myModalMaquina').find('#tblPendientes').append(
                    $("<tr>")
                        .append(
                            $("<td class='text-center'>").html("OT "+this.ordenesdetrabajo.numero)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.aextrusar)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.extrusadas)
                        )
                         .append(
                            $("<td class='text-center'>").html(impresas)
                        )
                        .append(
                            $("<td class='text-center'>").html(cortadas)
                        )
                        .append(
                          $("<td class='align-middle'>")
                            .append(
                                $("<div>")
                                    .addClass('progress progress-xs')
                                    .append(
                                        $("<div>")
                                            .addClass('progress-bar '+classProgress)
                                            .css('width',porcentaje+'%')
                                    )
                            )
                        )
                        .append(
                          $("<td>")
                              .append(
                                  $("<span>")
                                      .addClass('badge bg-danger')
                                      .html(porcentaje+"%")
                              )
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
                        )
                )
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
            $('#myModalMaquina').find('.modal-title').html('<i class="fas fa-cut"></i> '+data.cortadora.nombre);
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

                $('#myModalMaquina').find('#tblPendientes').append(
                    $("<tr>")
                        .append(
                            $("<td class='text-center'>").html("OT "+this.ordenesdetrabajo.numero)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.aextrusar)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdetrabajo.extrusadas)
                        )
                         .append(
                            $("<td class='text-center'>").html(impresas)
                        )
                        .append(
                            $("<td class='text-center'>").html(cortadas)
                        )
                        .append(
                          $("<td class='align-middle'>")
                            .append(
                                $("<div>")
                                    .addClass('progress progress-xs')
                                    .append(
                                        $("<div>")
                                            .addClass('progress-bar '+classProgress)
                                            .css('width',porcentaje+'%')
                                    )
                            )
                        )
                        .append(
                          $("<td>")
                              .append(
                                  $("<span>")
                                      .addClass('badge bg-danger')
                                      .html(porcentaje+"%")
                              )
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
                        )
                )
            });

        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
