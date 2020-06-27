$(document).ready(function() {
    
});
function loadOTExtrusora(extrusoraId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'extrusoras/view/'+extrusoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            alert(data.extrusora.id);            
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function loadOTImpresora(impresoraId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'impresoras/view/'+impresoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            alert(data.impresora.id);            
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
            alert(data.cortadora.id);            
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
