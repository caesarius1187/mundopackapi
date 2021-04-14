var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  function cambiarImpreso(){
    if ($('#tipoimpresion').val() == 'sin impresion'){
      $('#impreso').val('0');
    } else {
      $('#impreso').val('1');
    }
  }
  function cambiarCortado(){
    if ($('#tipocorte').val() == 'sin corte'){
      $('#impreso').val('0');
    } else {
      $('#impreso').val('1');
    }
  }
var cantMateriales = 0;
$(document).ready(function() {
    cantMateriales = $("#cantmateriales").val();
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
                window.location.href = serverLayoutURL+'ordenesdepedidos/add/'+data.respuesta.ordenesdetrabajo.ordenesdepedido_id;
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    $(".inputCalculoOT").on('change',function(){
        calcularOT();
    });
});
function loadMaterial(){
    var $tableBody = $('#tblMateriales').find("tbody"),
    $trLast = $tableBody.find("tr:last"),
    $trNew = $trLast.clone();
    $trLast.after($trNew);
    var newcantMateriales = cantMateriales*1;
    var lastcantMateriales = cantMateriales*1-1;

    var nameId = "Materialesots["+newcantMateriales+"][id]";
    var idId = "materialesots-"+newcantMateriales+"-id";
    var inputId = $trNew.find("#materialesots-"+lastcantMateriales+"-id")
        .attr('name',nameId)
        .attr('id',idId)
        .attr('value',0);
    var nameOrdenesdetrabajoId = "Materialesots["+newcantMateriales+"][ordenesdetrabajo_id]";
    var idOrdenesdetrabajoId = "materialesots-"+newcantMateriales+"-ordenesdetrabajo-id";
    var inputMateriales = $trNew.find("#materialesots-"+lastcantMateriales+"-ordenesdetrabajo-id")
        .attr('name',nameOrdenesdetrabajoId)
        .attr('id',idOrdenesdetrabajoId);

    var nameMaterial = "Materialesots["+newcantMateriales+"][material]";
    var idMaterial = "materialesots-"+newcantMateriales+"-material";
    var inputMateriales = $trNew.find("#materialesots-"+lastcantMateriales+"-material")
        .attr('name',nameMaterial)
        .attr('id',idMaterial);
    var nameTipo = "Materialesots["+newcantMateriales+"][tipo]";
    var idTipo = "materialesots-"+newcantMateriales+"-tipo";
    var inputTipo = $trNew.find("#materialesots-"+lastcantMateriales+"-tipo")
        .attr('name',nameTipo)
        .attr('id',idTipo);
    var namePorcentaje = "Materialesots["+newcantMateriales+"][porcentaje]";
    var idPorcentaje = "materialesots-"+newcantMateriales+"-porcentaje";
    var inputPorcentaje = $trNew.find("#materialesots-"+lastcantMateriales+"-porcentaje")
        .attr('name',namePorcentaje)
        .attr('id',idPorcentaje);
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
function showSiNo(myBoolean){
    if(myBoolean){
        return 'SI';
    }else{
        return 'NO';
    }
}
