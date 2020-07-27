var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$(document).ready(function() {
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
                var extrusoraId =data.data[1].extrusora_id;
                var impresoraId =data.data[1].impresora_id;
                var cortadoraId =data.data[1].cortadora_id;
                var myList;
                if(extrusoraId!=0){
                    myList = $("#ulExtrusora"+extrusoraId);
                }
                if(impresoraId!=0){
                    myList = $("#ulImpresora"+impresoraId);
                }
                if(cortadoraId!=0){
                    myList = $("#ulCortadora"+cortadoraId);
                }
                myList
                    .append(
                        $("<li>")
                            .attr("id",'liOrdenOt'+data.data[1].id)   
                            .html("OT "+$( "#ordenesdetrabajo-id option:selected" ).text())
                            .append(
                                $("<a>")
                                    .addClass("badge bg-secondary swalDefaultSuccess")  
                                    .attr('onclick','levelUp('+data.data[1].id+')')
                                    .append(                     
                                        $("<i>").addClass("fas fa-angle-up")                   
                                    )                           
                            )
                            .append(
                                $("<a>")
                                    .addClass("badge bg-secondary swalDefaultSuccess")  
                                    .attr('onclick','levelDown('+data.data[1].id+')')
                                    .append(                     
                                        $("<i>").addClass("fas fa-angle-down")                   
                                    ) 
                            )
                            .append(
                                $("<a>")
                                    .addClass("badge bg-secondary swalDefaultSuccess")  
                                    .attr('onclick','deleteOrdOt('+data.data[1].id+')')
                                    .append(                     
                                        $("<i>").addClass("fas fa-trash-alt")                   
                                    ) 
                            )
                    )
                $('#myModal').modal('toggle');
                
            },
            error: function(xhr,textStatus,error){
                bootstrapAlert(textStatus);
            }
        });
        return false;
    });
});
function levelUp(ordenOTId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenots/levelup/'+ordenOTId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            if(data.data.error!=0){
                Toast.fire({
                  icon: 'error',
                  title: data.data.respuesta
                })
            }else{
                Toast.fire({
                  icon: 'success',
                  title: 'Se cambió prioridad con éxito.'
                })
                var row = $("#liOrdenOt"+ordenOTId);
                row.insertBefore(row.prev());
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function levelDown(ordenOTId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenots/leveldown/'+ordenOTId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            if(data.data.error!=0){
                Toast.fire({
                  icon: 'error',
                  title: data.data.respuesta
                })
            }else{
                Toast.fire({
                  icon: 'success',
                  title: 'Se cambió prioridad con éxito.'
                })
                var row = $("#liOrdenOt"+ordenOTId);
                row.insertAfter(row.next());
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}
function deleteOrdOt(ordenOTId){
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenots/delete/'+ordenOTId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            if(data.data.error!=0){
                Toast.fire({
                  icon: 'error',
                  title: data.data.respuesta
                })
            }else{
                Toast.fire({
                  icon: 'success',
                  title: 'Se elimino prioridad con éxito.'
                })
                var row = $("#liOrdenOt"+ordenOTId);
                row.remove();
            }
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
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
function loadFormPrioridad(maquina,maquinaNombre,maquinaId){
    var controller = "";
    var Title = "";
    var extInputId = $("#extrusora-id");
    var impInputId = $("#impresora-id");
    var corInputId = $("#cortadora-id");
    extInputId.val(0);
    impInputId.val(0);
    corInputId.val(0);
    switch(maquina){
        case 'extrusora':
            controller = 'extrusoras';
            extInputId.val(maquinaId);
        break;
        case 'impresora':
            controller = 'impresoras';
            impInputId.val(maquinaId);
        break;
        case 'cortadora':
            controller = 'cortadoras';
            corInputId.val(maquinaId);
        break;
    }
    
    $.ajax({
        type: 'POST',
        url: serverLayoutURL+'ordenesdetrabajos/listaasignacion/'+maquina+"/"+maquinaId+'.json',
        data: '',
        success: function(data,textStatus,xhr){
            $('#myModal').find('.modal-title').html("Agregar OT a la lista de prioridad de "+maquinaNombre);
            $("#ordenesdetrabajo-id").empty();
            $(data.listOrdenes).each(function(){
                $("#ordenesdetrabajo-id").append('<option value="'+this.id+'">'+this.numero+'</option>');
            }); 
            $('#myModal').modal('toggle')
        },
        error: function(xhr,textStatus,error){
            alert(textStatus);
        }
    });
}