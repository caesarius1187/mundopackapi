var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$(document).ready(function() {    
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
});
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
                $("<td>").html(ordenesdetrabajo.tipo)
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
                $("<td>").append(
                    $("<a>").append(
                        $("<i>").addClass('fas fa-search')
                    )
                    .attr('href',serverLayoutURL+'ordenesdetrabajos/view/'+ordenesdetrabajo.id)
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