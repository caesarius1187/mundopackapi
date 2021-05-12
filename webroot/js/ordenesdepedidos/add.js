var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$(document).ready(function() {
    $('#reservationdate').datetimepicker({
          //minDate: new Date(),
          format: 'L',
          locale: 'es'
      });
    $('.select2').select2()
    $('#OrdenesDePedidoAddForm').submit(function(){
        var r = confirm("Esta seguro que quiere guardar la Orden de Pedido?");
        if(r){
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
                        var id = data.respuesta.ordenesdepedido.id;
                        $('#OrdenesDePedidoAddForm #id').val(id);
                        $('#OrdenesDePedidoAddForm .btn').html('<i class="fas fa-edit"></i>Modificar');

                        $('#OrdenesDeTrabajoAddForm #ordenesdepedido-id').val(id);
                        $('#OrdenesDeTrabajoAddForm .btn').show();

                        $(".card-secondary").show();
                    }

                },
                error: function(xhr,textStatus,error){
                    bootstrapAlert(textStatus);
                }
            });
        }
        return false;
    });
    $('#OrdenesDeTrabajoAddForm').submit(function(){
        //vamos a revisar que los porcentajes sumen 100
        var suma = 0;
        $(".porcentaje").each(function(){
            suma+=$(this).val()*1;
        })
        if(suma!=100){
            Toast.fire({
              icon: 'error',
              title: "Los porcentajes de materiales no suman 100"
            })
            return false;
        }
        var r = confirm("Esta seguro que quiere guardar la Orden de Trabajo?");
        if(r){
            //serialize form data
            var formData = $(this).serialize();
            //get form action
            var formUrl = $(this).attr('action')+".json";
            $.ajax({
                type: 'POST',
                url: formUrl,
                data: formData,
                success: function(data,textStatus,xhr){
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
                    cargarOTenTbl(data.respuesta.ordenesdetrabajo);
                    clearOTForm();
                },
                error: function(xhr,textStatus,error){
                    bootstrapAlert(textStatus);
                }
            });
        }
        return false;
    });
    $('#OrdenesDeTrabajoEditForm').submit(function(){
        //vamos a revisar que los porcentajes sumen 100
        var suma = 0;
        $(".porcentaje").each(function(){
            suma+=$(this).val()*1;
        })
        if(suma!=100){
            Toast.fire({
              icon: 'error',
              title: "Los porcentajes de materiales no suman 100"
            })
            return false;
        }
        var r = confirm("Esta seguro que quiere modificar la Orden de Trabajo?");
        if(r){
            return true;
        }
        return false;
    });
    
    $(".inputCalculoOT").on('change',function(){
        var tipocorte = $("#tipocorte").val();
        if(tipocorte=='lateral 2l'){
            calcularOTInverso();
        }else{
            calcularOT();
        }

    });
    calcularKilosDeMateriales();
});
function clearOTForm(){
    $("#color").val("");
    $("#fuelle").val("NO");
    $("#tipofuelle").val("NO");
    $("#tratado").val("NO");
    $("#perf").prop( "checked", false );;
    $("#ancho").val("");
    $("#largo").val("");
    $("#espesor").val("");
    $("#cantidad").val("");
    $("#pesoxmil").val("");
    $("#metrototal").val("");
    $("#aextrusar").val("");
    $("#pesobob").val("");
    $("#metrobob").val("");
    $("#manija").val("nO");
    $("#tipoimpresion").val("sin impresion");
    $("#tipoimpresion").trigger("change");
    $("#tipocorte").val("sin corte");
    $("#tipocorte").trigger("change");
    var $tableBody = $('#tblMateriales').find("tbody"),
    $trs = $tableBody.find("tr");
    $trs.each(function(){
        var rowCount = $('#tblMateriales tr').length;
        if(rowCount>1){
            $(this).remove();
        }
    });
    $("#preciounitario").val("");
    $("#observaciones").val("");
    $("#observacionesextrusion").val("");
    $("#observacionesimpresion").val("");
    $("#observacionescorte").val("");
}
function cambiarImpreso(){
  if ($('#tipoimpresion').val() == 'sin impresion'){
    $('#impreso').val('0');
  } else {
    $('#impreso').val('1');
  }
}
function cambiarCortado(){
  if ($('#tipocorte').val() == 'sin corte'){
    $('#cortado').val('0');
  } else {
    $('#cortado').val('1');
  }
}
var cantMateriales = 0;
function buscarOt(){
    var clienteId = $("#cliente-id").val();
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdetrabajos/buscarporcliente/'+clienteId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            if(data.error!=0){
                alert(data.respuesta);
                location.reload();
            }else{
                Toast.fire({
                  icon: 'success',
                  title: "Se encontraron las siguientes Ordenes de trabajo del cliente seleccionado"
                })
                $('#myModalMaquina')
                    .find('#tblOrdenesAntiguas')
                    .find('tr').remove();
                $(data.ordenesdetrabajos).each(function(){
                    var fechaInicio = getDateArray(this.ordenesdepedido.fecha);
                    var formatedFechaInicio = fechaInicio[2]+"-"+fechaInicio[1]+"-"+fechaInicio[0];

                    var tr = $("<tr>")
                        .append(
                            $("<td class='text-center'>").html(formatedFechaInicio)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdepedido.cliente.nombre)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.ordenesdepedido.numero+"-"+this.numero)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.medida)
                        )
                        .append(
                            $("<td class='text-center'>").html(this.cantidad)
                        )
                        .append(
                            $("<td class='text-center'>").html("materiales")
                        )
                         .append(
                            $("<td class='text-center'>").html(this.impreso?'SI':'NO')
                        )
                        .append(
                            $("<td class='text-center'>").html(this.cortado?'SI':'NO')
                        )
                        .append(
                            $("<td class='text-center'>").html(this.observaciones)
                        )
                        .append(
                            $("<td class='text-center'>")
                              .append(
                                $("<button type='button' class='btn btn-default btn-xs'>")
                                .append(
                                    $("<i>")
                                        .addClass('fa fa-chevron-circle-right')
                                        .attr('aria-hidden',"true")
                                        .attr('onclick','cargarOrdendetrabajo('+this.id+')')
                                )
                              )
                        );

                    $('#myModalMaquina')
                        .find('#tblOrdenesAntiguas')
                            .append(tr);
                });
                $('#myModalMaquina').modal('show');
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function cargarOrdendetrabajo(otId){
     $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdetrabajos/view/'+otId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            $('#myModalMaquina').modal('hide');
            
            $("#color").val(data.ordenesdetrabajo.color);
            $("#fuelle option[value='"+data.ordenesdetrabajo.fuelle+"']").attr("selected", true);
            $("#tipofuelle option[value='"+data.ordenesdetrabajo.tipofuelle+"']").attr("selected", true);
            $("#tratado option[value='"+data.ordenesdetrabajo.tratado+"']").attr("selected", true);
            $("#perforado").val(data.ordenesdetrabajo.perforado);

            $("#ancho").val(data.ordenesdetrabajo.ancho);
            $("#largo").val(data.ordenesdetrabajo.largo);
            $("#espesor").val(data.ordenesdetrabajo.espesor);
            $("#cantidad").val(data.ordenesdetrabajo.cantidad);
            $("#pesoxmil").val(data.ordenesdetrabajo.pesoxmil);
            $("#metrototal").val(data.ordenesdetrabajo.metrototal);
            $("#aextrusar").val(data.ordenesdetrabajo.aextrusar);
            $("#pesobob").val(data.ordenesdetrabajo.pesobob);
            $("#metrobob").val(data.ordenesdetrabajo.metrobob);
            $("#manija option[value='"+data.ordenesdetrabajo.manija+"']").attr("selected", true);
            $("#tipoimpresion option[value='"+data.ordenesdetrabajo.tipoimpresion+"']").attr("selected", true);
            $("#tipoimpresion").trigger("change");
            $("#tipocorte option[value='"+data.ordenesdetrabajo.tipocorte+"']").attr("selected", true);
            $("#tipocorte").trigger("change");
            
            $("#preciounitario").val(data.ordenesdetrabajo.preciounitario);

            $("#observaciones").val(data.ordenesdetrabajo.observaciones);
            $("#observacionesextrusion").val(data.ordenesdetrabajo.observacionesextrusion);
            $("#observacionesimpresion").val(data.ordenesdetrabajo.observacionesimpresion);
            $("#observacionescorte").val(data.ordenesdetrabajo.observacionescorte);
            var miCantMateriales= cantMateriales;
            //load materiales
            $(data.ordenesdetrabajo.materialesots).each(function(){
                if(miCantMateriales!=0){
                    loadMaterial();     
                }
                $addedNumMaterial = getLastNumMaterial()*1-1;
                $("#materialesots-"+$addedNumMaterial+"-material option[value='"+this.material+"']").attr("selected", true);
                $("#materialesots-"+$addedNumMaterial+"-porcentaje").val(this.porcentaje);
                miCantMateriales++;
            });
            $('#cantmateriales').val(miCantMateriales);
            Toast.fire({
              icon: 'success',
              title: "Se encontraron las siguientes Ordenes de trabajo del cliente seleccionado"
            })
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function getDateArray(fecha){
    var arrayFecha = fecha.split('T');
    arrayFecha = arrayFecha[0].split('-');
    return arrayFecha;
}
function getLastNumMaterial(){
    $numMaterial = 0;
    $(".rowMaterial").each(function(){
        $numMaterialRow = $(this).attr("numMaterial");
        if($numMaterial*1<$numMaterialRow*1){
            $numMaterial=$numMaterialRow*1;
        }
    })
    return $numMaterial;
}
function loadMaterial(){
    var $tableBody = $('#tblMateriales').find("tbody"),
    $trLast = $tableBody.find("tr:last"),
    $trNew = $trLast.clone();
    $canMaterialLast = $($trNew).attr('numMaterial');
    $trLast.after($trNew);
    $numLastRoeMaterialLast = $canMaterialLast;
    $($trNew).attr('numMaterial',$numLastRoeMaterialLast*1+1)
    var newcantMateriales = $canMaterialLast;
    $canMaterialLast --;

    var nameMaterial = "Materialesots["+newcantMateriales+"][material]";
    var idMaterial = "materialesots-"+newcantMateriales+"-material";
    var inputMateriales = $trNew.find("#materialesots-"+$canMaterialLast+"-material")
        .attr('name',nameMaterial)
        .attr('id',idMaterial);
    var namePorcentaje = "Materialesots["+newcantMateriales+"][porcentaje]";
    var idPorcentaje = "materialesots-"+newcantMateriales+"-porcentaje";
    var inputPorcentaje = $trNew.find("#materialesots-"+$canMaterialLast+"-porcentaje")
        .attr('name',namePorcentaje)
        .attr('id',idPorcentaje);

    var nameId = "Materialesots["+newcantMateriales+"][id]";
    var idId = "materialesots-"+newcantMateriales+"-id";
    var inputId = $trNew.find("#materialesots-"+$canMaterialLast+"-id")
        .val(0)
        .attr('name',nameId)
        .attr('id',idId)
        .attr('value',0);

    var nameOrdenTrabajoId = "Materialesots["+newcantMateriales+"][ordenesdetrabajo_id]";
    var idOrdenTrabajoId = "materialesots-"+newcantMateriales+"-ordenesdetrabajo-id";
    var inputId = $trNew.find("#materialesots-"+$canMaterialLast+"-ordenesdetrabajo-id")
        .attr('name',nameOrdenTrabajoId)
        .attr('id',idOrdenTrabajoId);

    cantMateriales++;
    calcularKilosDeMateriales();
}
function deleteMaterial(buttonRemove){
    if ($('#tblMateriales tbody tr').length == 1) {
        alert('Debe haber por lo menos un material');
        calcularKilosDeMateriales();
        return;
    }
    $(buttonRemove).closest('tr').remove();
    calcularKilosDeMateriales();
}
function calcularKilosDeMateriales(){
    var pesoxmil = $("#pesoxmil").val()*1;
    $(".porcentaje").each(function(){
        var trMaterial = $(this).closest('tr');
        var porcentaje = $(this).val()*1;
        var spankilos = $(trMaterial).find('.spankilos');
        var kilosMaterial = pesoxmil/100*porcentaje;
        $(spankilos).html(kilosMaterial.toFixed(2));
    })
}
function calcularOT(){
    var ancho = $("#ancho").val();
    var largo = $("#largo").val();
    var espesor = $("#espesor").val();
    var cantidad = $("#cantidad").val();
    var aextrusar = $("#aextrusar").val()*1;

    var pesoxmil = ancho*largo*espesor*0.000184*cantidad/1000;
    var tipocorte = $("#tipocorte").val();
    if(tipocorte=='lateral 2l'){
        pesoxmil = pesoxmil/2;
    }
    $("#pesoxmil").val(pesoxmil.toFixed(2));
    var metrototal = pesoxmil/(ancho*espesor*0.000184)*10;
    $("#metrototal").val(metrototal.toFixed(2));
    if(aextrusar!=0){
        var pesobob = pesoxmil/aextrusar;
        $("#pesobob").val(pesobob.toFixed(2));
        var metrobob = metrototal/aextrusar;
        $("#metrobob").val(metrobob.toFixed(2));
    }

    calcularKilosDeMateriales();
    
}

function calcularOTInverso(){
    var ancho = $("#ancho").val();
    //var largo = $("#largo").val();
    var espesor = $("#espesor").val();
    var cantidad = $("#cantidad").val();
    var aextrusar = $("#aextrusar").val()*1;
    var pesoxmil = $("#pesoxmil").val();


    var largoalamenosuno = ancho*espesor*0.000184*cantidad/1000/pesoxmil;
    var largo = pesoxmil*1000/(ancho*espesor*0.000184*cantidad)
    $("#largo").val(largo.toFixed(2));
    pesoxmil = pesoxmil/2;
    var metrototal = pesoxmil/(ancho*espesor*0.000184)*10;
    $("#metrototal").val(metrototal.toFixed(2));
    if(aextrusar!=0){
        var pesobob = pesoxmil/aextrusar;
        $("#pesobob").val(pesobob.toFixed(2));
        var metrobob = metrototal/aextrusar;
        $("#metrobob").val(metrobob.toFixed(2));
    }
}
function cargarOTenTbl(ordenesdetrabajo){
    var tblOrdenes = $("#tblOrdenesDeTrabajo");
    tblOrdenes.append(
        $("<tr>")
            .append(
                $("<td>").html(ordenesdetrabajo.numero)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.cantidad)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.aextrusar)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.material)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.color)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.fuelle)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.medida)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.perf)
            )
            .append(
                $("<td>").html(showSiNo(ordenesdetrabajo.impreso))
            )
            .append(
                $("<td>").html(showSiNo(ordenesdetrabajo.cortado))
            )
            .append(
                $("<td>").html(ordenesdetrabajo.preciounitario)
            )
            .append(
                $("<td>").html(ordenesdetrabajo.observaciones)
            )
            .append(
                $("<td>")
                    .append(
                        $("<a>").append(
                            $("<i>").addClass('fas fa-search')
                        )
                        .attr('href',serverLayoutURL+'ordenesdetrabajos/view/'+ordenesdetrabajo.id)
                        .attr('escape',false)
                        .addClass('btn btn-info btn-sm')
                    )
                    .append(
                        $("<a>").append(
                            $("<i>").addClass('fas fa-edit')
                        )
                        .attr('href',serverLayoutURL+'ordenesdetrabajos/edit/'+ordenesdetrabajo.id)
                        .attr('escape',false)
                        .addClass('btn btn-info btn-sm')
                    )
            )
    )
}
function showSiNo(myBoolean){
    if(myBoolean){
        return 'SI';
    }else{
        return 'NO';
    }
}
