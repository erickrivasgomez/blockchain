function registrarUsuario() {
  
  var datos = {
    accion: "registrarUsuario",
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
        var resultado=JSON.parse(result);
        if (resultado != null) {
          // Redireccionar a home
        } else {
          // Alerta de datos incorrectos
        }
        
      }
    });
  }
