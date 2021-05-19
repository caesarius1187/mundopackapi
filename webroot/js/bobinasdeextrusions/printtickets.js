$(document).ready(function(){
  var data = $('#bobinasdeextrusion').val();
  console.log("DATOS:", data)
  $.ajax({
      type: 'POST',
      crossDomain: true,
      dataType: 'jsonp',
      headers: {
        'Access-Control-Allow-Origin': '*'
      },
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
