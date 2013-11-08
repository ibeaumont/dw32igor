<!DOCTYPE html>
<?php header('Access-Control-Allow-Origin: *'); ?>
<html>
  <head>
    <title>Zubiri Manteo MegaInsti-- Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
   
  </head>
  <body id="inicio">
		<section class="container">
			<div class="content row">
          <?php include "componentes/header.php"; ?>
				<section class="main col col-lg-8">
          <?php include "componentes/main.php"; ?>
				</section><!-- main -->
				<section class="sidebar col col-lg-4">
          <?php include "componentes/noticias.php"; ?>
				</section><!-- sidebar -->
			</div><!-- content -->
    </section><!-- container -->
    <!--pruebas con ajax - json-->
    <div id="json">
      <!--ajax json-->
      <ul></ul>
    </div>
    <!--FIN pruebas con ajax - json-->
    <div class="row" id="footer">
      <?php include "componentes/footer.php"; ?>
    </div>


    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="js/app.js"></script>
    <script>
    var datos;
var url_hoy='http://opendata.euskadi.net/contenidos/prevision_tiempo/met_forecast/es_today/adjuntos/forecast.xml';
var url_man='http://opendata.euskadi.net/contenidos/prevision_tiempo/met_forecast/es_tomorrow/adjuntos/forecast.xml';
var yql = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent('select * from xml where url="' + url_hoy+ '"') + '&format=xml&callback=?';
 
    // Request that YSQL string, and run a callback function.
    // Pass a defined function to prevent cache-busting.
    $.getJSON(yql, function(data){
      //parsear el xml enviado por euskalmet
      var xmlDoc = $.parseXML( data.results[0])
      //obtner el pronostico para hoy
      $(xmlDoc).find("descriptionPeriodData").text()
      //escribir el pronostico de hoy en el tablon de anuncios
      $('#accordion .panel-body').first().html('<p>'+$(xmlDoc).find("descriptionPeriodData").text()+'</p>')
      datos=xmlDoc;
      //obtner la imagen del tiempo para donosti
      $('#accordion .panel-body').first().append(
        $('<img>').attr('src','http://opendata.euskadi.net'+
          $(xmlDoc).find("cityForecastData").filter(function(){
            return $(this).attr('cityCode')=='17'}).find('symbol').text())
      )

      
      //var imagen="opendata.euskadi.net"+
      //$('#accordion .panel-body').append($('<img >').attr('src',imagen)

    });
  //obtener el pronostico de mañana
  yql = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent('select * from xml where url="' + url_man+ '"') + '&format=xml&callback=?';
 
    // Request that YSQL string, and run a callback function.
    // Pass a defined function to prevent cache-busting.
    $.getJSON(yql, function(data){
      //parsear el xml enviado por euskalmet
      var xmlDoc = $.parseXML( data.results[0])
      //obtner el pronostico para hoy
      $(xmlDoc).find("descriptionPeriodData").text()
      //escribir el pronostico de hoy en el tablon de anuncios
      $('#accordion .panel-body').eq(1).html('<p>'+$(xmlDoc).find("descriptionPeriodData").text()+'</p>')

//obtner la imagen del tiempo para donosti
      $('#accordion .panel-body').eq(1).append(
        $('<img>').attr('src','http://opendata.euskadi.net'+
          $(xmlDoc).find("cityForecastData").filter(function(){
            return $(this).attr('cityCode')=='17'}).find('symbol').text())
      )
      
    });

//cargar el combo de poblaciones con los datos devueltos por euskalmet
$(datos).find('cityForecastDataList').children().each(
  function(id,el){
    $('#cmbPoblaciones').append(
      '<option value="'+$(el).attr('cityCode')+'">'
      +$(el ).find('cityName').text()+'</option>')
  })

//añadir un handler cuando se cambia una poblacion
$('#cmbPoblaciones').change(function(){
var datosPobSel=$(datos).find('cityForecastData')
    .filter(function(){
      return $(this).attr('cityCode')==$('#cmbPoblaciones').val()
    }).children()

//escribir fila min
var min='<tr><td>min</td>"+<td>'+$(datosPobSel).find('tempMin').text()+"</td></tr>"
//escribir col max
//dibujar imagen
$('#tPoblaciones').append(min)
})

 /* EJEMPLO MANEJO AJAX - DATOS XML EUSKALMET*/
    /*var datos;
    var url='http://opendata.euskadi.net/contenidos/prevision_tiempo/met_forecast/es_today/adjuntos/forecast.xml';
    jQuery.support.cors = true;
   var ajaxConn=$.ajax({
        url : 'http://opendata.euskadi.net/contenidos/prevision_tiempo/met_forecast/es_today/adjuntos/forecast.xml',
        type : 'GET',
        contentType: 'text/xml; charset=utf-8',
        dataType : 'jsonp'
    })

    ajaxConn.done(function(data) {
      console.log("1");
      datos=data;
      console.log(data);
    })
 */
 
  /*var fotos;
  var flickerAPI = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
  $.getJSON( flickerAPI, {
    tags: "zurriola",
    tagmode: "any",
    format: "json"
  })


    .done(function( data ) {
      fotos=data;
$('.carousel-inner img').each(function(idx,el){$(el).attr('src',fotos.items[idx].media.m)})      });
    });
*/
    
  /*  var ajaxConn=$.ajax({
        url : '/data/people.json',
        type : 'GET',
        dataType : 'json'
    })

    ajaxConn.done(function(data) {
          var lista=$('#json ul')
          $(data.people).each(function(ind,el){

            $(lista).append('<li>'+el.name+'</li>')
          })
            
      })*/
      
    </script>
  </body>
</html>
