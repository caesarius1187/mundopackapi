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
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
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
});
var cantMateriales = 0;
function loadMaterial(){
    var $tableBody = $('#tblMateriales').find("tbody"),
    $trLast = $tableBody.find("tr:last"),
    $trNew = $trLast.clone();
    $trLast.after($trNew);
    var newcantMateriales = cantMateriales+1;
    var nameMaterial = "Materialesots["+newcantMateriales+"][material]";
    var idMaterial = "materialesots-"+newcantMateriales+"-material";
    var inputMateriales = $trNew.find("#materialesots-"+cantMateriales+"-material")
        .attr('name',nameMaterial)
        .attr('id',idMaterial);
    var nameTipo = "Materialesots["+newcantMateriales+"][tipo]";
    var idTipo = "materialesots-"+newcantMateriales+"-tipo";
    var inputTipo = $trNew.find("#materialesots-"+cantMateriales+"-tipo")
        .attr('name',nameTipo)
        .attr('id',idTipo);
    var namePorcentaje = "Materialesots["+newcantMateriales+"][porcentaje]";
    var idPorcentaje = "materialesots-"+newcantMateriales+"-porcentaje";
    var inputPorcentaje = $trNew.find("#materialesots-"+cantMateriales+"-porcentaje")
        .attr('name',namePorcentaje)
        .attr('id',idPorcentaje);
    cantMateriales++;
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
                $("<td>").html(showSiNo(impreso))
            )
            .append(
                $("<td>").html(showSiNo(cortado))
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
