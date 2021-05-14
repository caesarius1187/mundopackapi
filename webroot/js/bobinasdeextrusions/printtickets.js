$(document).ready(function(){
  var data = $('#bobinasdeextrusion').val();
  $.ajax({
      type: 'POST',
      url: 'http://localhost/ticket/ticket.php',
      data: data,
      success: function(data,textStatus,xhr){
        Toast.fire({
          icon: 'success',
          title: 'Imprimiendo..'
        })
      },
      error: function(xhr,textStatus,error){
          alert(textStatus);
      }
  });
});
