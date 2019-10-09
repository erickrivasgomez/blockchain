function hola() {
    $('#thoteles').html("");
    $('#taviones').html("");
   
     var datos = {
       fecha: $("#fecha").val(),
       lugar: $("#lugar").val()
     };
       $.ajax({
         url: "ejemplo.php",
         data: datos,
         success: function(result){
           alert(result);
           result= JSON.parse(result) ;
           result.forEach(hotel => {
           var renglon =  '<tr>';
           renglon+=  '<th scope="row">'+hotel.id+'</th>';
           renglon+= '<td>'+hotel.nombre+'</td>';
           renglon+= '<td>'+hotel.precio+'</td>';
           renglon+= '<td>'+hotel.habitaciones+'</td></tr>';
       $('#thoteles').append(renglon);
               
           });
            }
   
         });
     
         $.ajax({
         url: "ejemplo2.php",
         data: datos,
         success: function(result){
           alert(result);
           var xmlDoc = $.parseXML( result );    
           var $xml = $(xmlDoc);
           var $person = $xml.find("return");
   
                   $person.each(function(){
   
                     var name = $(this).find('aerolinea').text(),
                       costo = $(this).find('costo').text(),
                       destino = $(this).find('destino').text(),
                       fecha = $(this).find('fecha').text(),
                       hora_salida = $(this).find('hora_salida').text(),
                       id = $(this).find('id').text();
   
       var renglon =  '<tr>';
           renglon+=  '<th scope="row">'+id+'</th>';
           renglon+= '<td>'+name+'</td>';
           renglon+= '<td>'+destino+'</td>';
       renglon+= '<td>'+fecha+'</td>';
           renglon+= '<td>'+hora_salida+'</td>';
           renglon+= '<td>'+costo+'</td></tr>';
   
                   $('#taviones').append(renglon);
                   
                   });
         }      
               
           });
   
        /*var datos_xml = "<?xml version='1.0' encoding='UTF-8'?><S:Envelope xmlns:S='http://schemas.xmlsoap.org/soap/envelope/' "+
            "xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'>"+
                "<SOAP-ENV:Header/>"+
                    "<S:Body>"+
                        "<ns2:listar xmlns:ns2='http://WebService/'>"+
                            "<destino>"    
                        "</ns2:listarResponse>"+
                    "</S:Body>"+
"</S:Envelope>";*/

        var datos2 = {
            fecha: $("#fecha").val(),
            destino: $("#lugar").val()
        };
       $.soap({
       url: 'https://cors-anywhere.herokuapp.com/http://11.0.3.52:8080/Aviones/ServiceVuelos',
       method: 'listar',
   
       data: datos2,
   
       success: function (result) {
           alert(result);
           var xmlDoc = $.parseXML( result );    
           var $xml = $(xmlDoc);
           var $person = $xml.find("return");
   
                   $person.each(function(){
   
                     var name = $(this).find('aerolinea').text(),
                       costo = $(this).find('costo').text(),
                       destino = $(this).find('destino').text(),
                       fecha = $(this).find('fecha').text(),
                       hora_salida = $(this).find('hora_salida').text(),
                       id = $(this).find('id').text();
   
       var renglon =  '<tr>';
           renglon+=  '<th scope="row">'+id+'</th>';
           renglon+= '<td>'+name+'</td>';
           renglon+= '<td>'+destino+'</td>';
       renglon+= '<td>'+fecha+'</td>';
           renglon+= '<td>'+hora_salida+'</td>';
           renglon+= '<td>'+costo+'</td></tr>';
   
                   $('#taviones').append(renglon);
                   
                   });
       // do stuff with soapResponse
           // if you want to have the response as JSON use soapResponse.toJSON();
           // or soapResponse.toString() to get XML string
           // or soapResponse.toXML() to get XML DOM
       },
       error: function (SOAPResponse) {
           // show error
       alert('Error en respuesta XML');
       }
   });
     
   //soapRequest();
    
   }
   function soapRequest(){
    var str = "<?xml version='1.0' encoding='UTF-8'?><S:Envelope xmlns:S='http://schemas.xmlsoap.org/soap/envelope/' "+
    "xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'>"+
        "<SOAP-ENV:Header/>"+
            "<S:Body>"+
                "<ns2:listar xmlns:ns2='http://WebService/'>"+
                    "<destino>"+
                    $("#lugar").val() +
                    "</destino> "+
                    "<fecha>"+
                    $("#fecha").val()+
                    "</fecha>"+
                "</ns2>"+
            "</S:Body>"+
"</S:Envelope>";
  
          function createCORSRequest(method, url) {
                      var xhr = new XMLHttpRequest();
                      if ("withCredentials" in xhr) {
                          xhr.open(method, url, false);
                      } else if (typeof XDomainRequest != "undefined") {
                          alert
                          xhr = new XDomainRequest();
                          xhr.open(method, url);
                      } else {
                          console.log("CORS not supported");
                          alert("CORS not supported");
                          xhr = null;
                      }
                      return xhr;
                  }
          var xhr = createCORSRequest("POST", 'http://11.0.3.52:8080/Aviones/ServiceVuelos?wsdl');
          if(!xhr){
           console.log("XHR issue");
           return;
          }
  
          xhr.onload = function (){
           var results = xhr.responseText;
           console.log(results);
          }
  
          xhr.setRequestHeader('Content-Type', 'text/xml');
          xhr.send(str);
   }
  
   
   
   /* $.soap({
       url: 'http://my.server.com/soapservices/',
       method: 'helloWorld',
   
       data: datos,
   
       success: function (soapResponse) {
           // do stuff with soapResponse
           // if you want to have the response as JSON use soapResponse.toJSON();
           // or soapResponse.toString() to get XML string
           // or soapResponse.toXML() to get XML DOM
       },
       error: function (SOAPResponse) {
           // show error
       }
   });  */