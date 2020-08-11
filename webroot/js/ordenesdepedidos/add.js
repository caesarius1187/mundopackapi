$(document).ready(function() {    
    $('#OPAddForm').submit(function(){
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
                var id = data.respuesta.ordenesdepedido.id;
                $('#OPAddForm #id').val(id);
                $('#OPAddForm .btn').html('<i class="fas fa-edit"></i>Modificar');

                $('#OTAddForm #ordenesdepedido-id').val(id);
                $('#OTAddForm .btn').show();
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    $('#OTAddForm').submit(function(){
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
                var id = data.respuesta.ordenesdepedido.id;
                $('#OPAddForm #id').val(id);
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
    
});