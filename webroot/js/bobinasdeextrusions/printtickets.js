function imprimir(){
  $.ajax({
      type: 'POST',
      url: serverLayoutURL+'bobinasdeextrusions/printticket.json',
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
