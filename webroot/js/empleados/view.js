$(document).ready(function() {
  $('#desde').datetimepicker({
        //minDate: new Date(),
        format: 'DD-MM-YYYY',
        locale: 'es'
    });
    $('#hasta').datetimepicker({
          //minDate: new Date(),
          format: 'DD-MM-YYYY',
          locale: 'es'
      });
    /*$('#empleadoConsultaForm').submit(function(){
        //serialize form data
        var formData = $(this).serialize();
        //get form action
        var formUrl = $(this).attr('action')+".json";
        $.ajax({
            type: 'POST',
            url: formUrl,
            data: formData,
            success: function(data,textStatus,xhr){

            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });*/
});
