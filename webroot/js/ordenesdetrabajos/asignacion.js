var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$(document).ready(function() {
    $('#divfechainicioextrusora').datetimepicker({
        format: 'L',
        locale: 'es',
        value: new Date()
    });
    $('#divfechainicioimpresora').datetimepicker({
        //minDate: new Date(),
        format: 'L',
        locale: 'es'
    });
    $('#divfechainiciocortadora').datetimepicker({
        //minDate: new Date(),
        format: 'L',
        locale: 'es'
    });
    $('tbody').sortable({
      cancel: ".no",
      items: 'tr:not(tr:first-child)',
      placeholder: 'placeholder',
      cursor: 'move',
      axis: 'y',
      dropOnEmpty: false,
      start: function (e, ui) {
        ui.item.addClass("selected");
      },
      update: function (e, ui) {
        var contTable = $(this).closest('table').attr('id');
        console.log(contTable);
        var newOrders = [];
        $(this).children().each(function (index) {
          newOrders.push([index,String($(this).attr('id')).substr(10)]);
        });
        console.log(newOrders);
        switch (contTable[3]) {
          case 'P':
            $.ajax({
              type: 'POST',
              url: serverLayoutURL+'ordenots/reorderPendientes.json',
              data:{'data':newOrders},
              success: function (response) {
                console.log(response);
                $(newOrders).each(function(indice, elemento){
                  $("#trOrdenOtP"+elemento[1]).find("td:first").html(elemento[0]);
                });
              },
              error: function () {
                alert('error');
              }
            });
           break;
           case 'E':
             $.ajax({
               type: 'POST',
               url: serverLayoutURL+'ordenots/reorderE.json',
               data:{'data':newOrders},
               success: function (response) {
                 $(newOrders).each(function(indice, elemento){
                   $("#trOrdenOtE"+elemento[1]).find("td:first").html(elemento[0]);
                 });
               },
               error: function () {
                 alert('error');
               }
             });
            break;
            case 'I':
              $.ajax({
                type: 'POST',
                url: serverLayoutURL+'ordenots/reorderI.json',
                data:{'data':newOrders},
                success: function (response) {
                  $(newOrders).each(function(indice, elemento){
                    $("#trOrdenOtI"+elemento[1]).find("td:first").html(elemento[0]);
                  });
                },
                error: function () {
                  alert('error');
                }
              });
             break;
             case 'C':
               $.ajax({
                 type: 'POST',
                 url: serverLayoutURL+'ordenots/reorderC.json',
                 data:{'data':newOrders},
                 success: function (response) {
                   $(newOrders).each(function(indice, elemento){
                     $("#trOrdenOtC"+elemento[1]).find("td:first").html(elemento[0]);
                   });
                 },
                 error: function () {
                   alert('error');
                 }
               });
              break;
              default:
                console.log(contTable[3]);
        }

       },
      stop: function (e, ui) {
        ui.item.removeClass("selected");
      }
    });

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
    $("#tblOrdenesDeTrabajo").DataTable( {
        "scrollX": true,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar: ",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        },
        "autoWidth": true
    } );
});
function borrarProgramacion(){
    var ordenotId = $("#id").val();
    if(ordenotId==0){
        Toast.fire({
          icon: 'error',
          title: 'Debe seleccionar una programacion para eliminar'
        });
        return false;
    }
    var r = confirm("Esta seguro que quiere eliminar la programacion?");
    if(r){
        $.ajax({
            type: 'DELETE',
            url: serverLayoutURL+'ordenots/delete/'+ordenotId+'.json',
            data: '',
            success: function(data,textStatus,xhr){
                if(data.data.error!=0){
                    alert(data.data.respuesta);
                    location.reload();
                }else{
                    Toast.fire({
                      icon: 'success',
                      title: 'Se elimino la programacion con exito;'
                    });
                    $("#trOrdenOt"+ordenotId).remove();
                    location.reload();
                }
            },
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
        });
    }
}
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
function programarOT(OTId,numeroOT,nombrecliente){
    $('#myModal').find('.modal-title').html("Programar OT Numero: "+numeroOT+" del Cliente: "+nombrecliente);
    $("#id").val(0);
    $("#ordenesdetrabajo-id").val(OTId);
    $('#myModal').modal('toggle');

    $("#fechainicioextrusora").val($.datepicker.formatDate('dd/mm/yy', new Date()));
    $("#fechainicioimpresora").val(new Date());
    $("#fechainiciocortadora").val(new Date());
}
function editarProgramacionOt(ordenOTId,oTId,numeroOT,nombrecliente,estrusoraId,inicioEstrusion,impresoraId,inicioImpresion,cortadoraId,inicioCorte){
    $('#myModal').modal('toggle');
    $('#myModal').find('.modal-title').html("Programar OT N° "+numeroOT+" del cliente \""+nombrecliente+"\":");
    $("#id").val(ordenOTId);
    $("#ordenesdetrabajo-id").val(oTId);
    //set Estrusora
    $("#extrusora-id").val(estrusoraId);
    $("#fechainicioextrusora").val(inicioEstrusion);
    //set Impresora
    $("#impresora-id").val(impresoraId);
    $("#fechainicioimpresora").val(inicioImpresion);
    //set Corte
    $("#cortadora-id").val(cortadoraId);
    $("#fechainiciocortadora").val(inicioCorte);
}
function clonarProgramacionOt(oTId,numeroOT,nombrecliente,estrusoraId,inicioEstrusion,impresoraId,inicioImpresion,cortadoraId,inicioCorte){
    $('#myModal').find('.modal-title').html("Programar OT N° "+numeroOT+" del cliente \""+nombrecliente+"\":");
    $("#id").val(0);
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
