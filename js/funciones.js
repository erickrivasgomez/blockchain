function registrarUsuario() {
  
  var datos = {
    nombre: $("#inputnombre").val(),
    firma: $("#inputfirma").val(),
    password: $("#inputpassword").val()
  };
  $.ajax({
    url: "./api.php",
    method: "POST",
    data: datos,
    success: function(result) {
      alert("Se ha registrado correctamente");
      
    }
  });
}
function autenticarUsuario() {
   
    var datos = {
      accion: "autenticarUsuario",  
      nombre: $("#loginnombre").val(),
      password: $("#loginpassword").val()
    };
    $.ajax({
      url: "./api.php",
      method: "POST",
      data: datos,
      success: function(result) {
        alert("Se ha iniciado sesión correctamente");
        
      }
    });
  }
