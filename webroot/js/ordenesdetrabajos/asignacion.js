function loadFormPrioridad(maquina,extrusoraId){
    var controller = "";
    switch(maquina){
        case 'extrusora':
            controller = 'extrusoras';
        break;
        case 'impresora':
            controller = 'impresoras';
        break;
        case 'cortadora':
            controller = 'cortadoras';
        break;
    }
    $('#myModal').modal('toggle')
    /*$.ajax({
        type: 'POST',
        url: serverLayoutURL+controller+'/view/'+extrusoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            alert(data.extrusora.id);            
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });*/
}