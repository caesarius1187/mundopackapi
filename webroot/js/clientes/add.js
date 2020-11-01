$(document).ready(function(){
  $('#cuit').mask('00-00000000-0');
  document.getElementById('dnicuit').pattern="^[0-9]{2}-[0-9]{8}-[0-9]$";
});
