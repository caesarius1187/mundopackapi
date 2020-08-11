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
                    loadBobinaEstrusion(data.respuesta.bobinasdeextrusion,data.respuesta.empleado);
                    
                }
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
});
function loadBobinaEstrusion(bobinaestrusion, empleado){
    var tblBobinasdeEstrusion = $("#tblBobinasdeEstrusion");
    tblBobinasdeEstrusion.append(
        $("<tr>")
            .append(
                $("<td>")
                    .html(bobinaestrusion.numero)
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
                    .html(bobinaestrusion.scrap)
            )
            .append(
                $("<td>")
                    .html(bobinaestrusion.observacion)
            )
    )
}
