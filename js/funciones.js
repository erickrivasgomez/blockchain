function registrarUsuario() {
  //$("#formregistro").submit();
  alert(
    $("#inputnombre").val() + $("#inputfirma").val() + $("#inputpassword").val()
  );
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
