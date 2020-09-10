function playOP(oPId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdepedidos/playop/'+oPId+'.json',
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
function pausarOP(oPId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdepedidos/pausarop/'+oPId+'.json',
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
function cancelarOP(oPId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdepedidos/cancelarop/'+oPId+'.json',
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