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
        
        console.log(result);  
        var resultado=JSON.parse(result);      
        console.log(JSON.parse(result));
        alert(resultado.usuario[0]);
        
      }
    });
  }
