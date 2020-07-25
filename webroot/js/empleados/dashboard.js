$(document).ready(function() {
    
});
function loadOTExtrusora(extrusoraId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'extrusoras/view/'+extrusoraId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            $('#myModalMaquina').modal('toggle');
            $('#myModalMaquina').find('.modal-title').html(data.extrusora.nombre);
            $('#myModalMaquina').find('#tblPendientes tr').remove();
            $(data.extrusora.ordenots).each(function(){
                $('#myModalMaquina').find('#tblPendientes').append(
                    $("<tr>").append(
                        $("<td>").html("OT Numero "+this.ordenesdetrabajo.numero)
                    )
                    .append(
                        $("<td>").append(
                            $("<i>")
                                .addClass('fa fa-search')
                                .attr('aria-hidden',"true")
                                .attr('onclick','openOrdendetrabajo('+this.ordenesdetrabajo.id+')')
                        )
                    )
                );
            });
            
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function openOrdendetrabajo(ordenid){
    window.open(serverLayoutURL+'ordenesdetrabajos/view/'+ordenid,);
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
