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
//mostrar los conciertos de la sala rockstar
var url_rockStar='http://www.salarockstar.com/articles.html';
//var yql = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent('select * from xml where url="' + url_rockStar+ '"') + '&format=xml&callback=?';

   var yql_url = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22" + encodeURIComponent(url_rockStar) + "%22%20and%0A%20%20%20%20%20%20xpath%3D'%2F%2Ftitle'&format=json&callback=?";
 
 $.ajax({
    url:url_rockStar,
    type:'GET',
    dataType:'JSONP',
    success: function(data){
        datos=data;
    }
});


//mostrar las noticias del rss de zubiri manteo en el accordion
/*
    var URL_RSS_ZUBIRI="http://www.zubirimanteo.hezkuntza.net/web/guest/noticias/-/journal/rss/19560/NOTICIAS?doAsGroupId=19560&refererPlid=224134?languageId=eu_ES"
 $.ajax({
    url: document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&callback=?&q=' + encodeURIComponent(URL_RSS_ZUBIRI),
    dataType: 'jsonp',
    success: function (data) {
      datos=data.responseData.feed.entries
      //eliminar todas los elementos del accordion menos el primero
      $('#accordion .panel-default').not(':first').remove()
      //cargar los titulo y contenido de cada noticia en el acordeon
      $(datos).each(function(id,el){
        if (id>0){
          //clonar el primer elem de accordion
          $('#accordion .panel-default').filter(':first').clone().appendTo('#accordion')
        }
        //añadir el titulo de la noticia
        $('#accordion h4 a').eq(id).text(el.title);
        //modificar el href del a
        $('#accordion h4 a').eq(id).attr('href','collapse'+id);
        //añadir el contenido de la noticia
        $('#accordion .panel-body').eq(id).html(el.content)
        //modificar el id del panel
        $('#accordion .panel-default .panel-collapse').eq(id).attr('id','collapse'+id)
      })
      
      //cerrar todos los elementos del accordion  
      $("#accordion .collapse").collapse()
      
      //cuando se clicka un titulo muestra u oculta su contenido
      $('[class*="accordion-toggle"]').on('click',function(){
        $('#accordion .in').collapse('hide');
        $('#'+$(this).attr('href')).collapse('show')
      })

      //modificar los img para que se cojan de la página de zubiri
      $('#accordion .panel-body img').each(function(idx,el){
        $(el).attr('src','http://www.zubirimanteo.com'+$(el).attr('src'))})
    },
    error: function () {}
    
});
// FIN MOSTRAR DATOS DEL RSS DE ZUBIRIMANTEO   
*/ 

/*
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

//cargar el combo de poblaciones con los datos devueltos por euskalmet
$(datos).find('cityForecastDataList').children().each(
  function(id,el){
    $('#cmbPoblaciones').append(
      '<option value="'+$(el).attr('cityCode')+'">'
      +$(el ).find('cityName').text()+'</option>')
  })
      
    });


//añadir un handler cuando se cambia una poblacion
$('#cmbPoblaciones').change(function(){
var datosPobSel=$(datos).find('cityForecastData')
    .filter(function(){
      return $(this).attr('cityCode')==$('#cmbPoblaciones').val()
    }).children()

//escribir fila min
var min='<tr><td>min</td>"+<td>'+$(datosPobSel[2]).text()+"</td></tr>"
//escribir col max
var max='<tr><td>Max</td>"+<td>'+$(datosPobSel[0]).text()+"</td></tr>"
//dibujar imagen
var image='<tr><td>Imagen</td>"+<td><img src="'+$(datosPobSel[2]).text()+'"/></td></tr>'
$('#tPoblaciones').children().remove();
$('#tPoblaciones').append(min+max+image)
})
*/

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
