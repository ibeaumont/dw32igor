<!DOCTYPE html>
<html>
  <head>
    <title>Zubiri Manteo MegaInsti-- Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
   
  </head>
  <body id="mapa">
		<section class="container">
			<div class="content row">
          <?php include "componentes/header.php"; ?>
				<section class="main col col-lg-8">
          <?php include "componentes/map.php"; ?>
				</section><!-- main -->
				<section class="sidebar col col-lg-4">
          <?php include "componentes/indicaciones.php"; ?>
				</section><!-- sidebar -->
			</div><!-- content -->
    <?php include "componentes/footer.php"; ?>
		</section><!-- container -->

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKCfIwvBuXvsA2HdVQTb1Ny-zLQ1jjXjw
&sensor=true&libraries=places">
    </script>
    <script type="text/javascript">
    var mapa;
    var image;
    var marker, markerAquiToy;
    var pos;
    var zubiriPos;
    var autocomplete;
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();
    var kk;

    function showBusqueda(){
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': $('#txtBuscar').val()}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      mapa.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: mapa,
          position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
    }
    function showRuta(event){
      var destino;
      if ($(event.target).text()=="Buscar"){
        //buscar la ruta al lugar de la caja de texto
        destino=$('#txtBuscar').val();
      }else{
        // ha pulsado como llegar a zubiri
        destino=zubiriPos;
      }
      var directionsService = new google.maps.DirectionsService();
      
      directionsDisplay.setMap(mapa);
      var request = {
        origin:pos,
        destination:destino,
        travelMode: google.maps.TravelMode.WALKING
      };
        //calcula la ruta
          directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        }
      });
    }

      function initialize() {


        //añadir el evento
        $('#btnBuscar').on('click',showRuta);
        $('#btnComo').on('click',showRuta);
        //geolocalizacion de zubiri
        zubiriPos=new google.maps.LatLng(43.327347,-1.970941);
        //configuracion del mapa   
        var mapOptions = {
          center: zubiriPos,
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        //crear el mapa en el documento
        mapa = new google.maps.Map(document.getElementById("map"),
        mapOptions);
        
        //indicar el div donde mostrar las indicaciones
        directionsDisplay.setPanel(document.getElementById('indicaciones'));
        //crear una imagen para el marker
        image = new google.maps.MarkerImage('img/logoZubiri.png');
        image.scaledSize = new google.maps.Size(35, 35);
        image.anchor = new google.maps.Point(0, 35);
        
        
        
        //dibujar un marcador en la pos de zubiri con la imagen diseñada
        marker = new google.maps.Marker({
           position: zubiriPos,
            map: mapa,
            title: 'Zubiri Manteo',
            icon: image
        });

        //geolocalizacion detectada por el navagador
        if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function(position) {
            pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

            //colocar un nuevo marcador en la localizacion dada por el navegador
            markerAquiToy = new google.maps.Marker({
               position: pos,
               map: mapa,
               title: 'A ver a ver',
               icon: image
            });

          });
        }
        //autocompletar de google en la caja de texto buscar
        var input =document.getElementById('txtBuscar');
        autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', mapa);
        //fin autocompletar

}
      $(document).ready(initialize());
    </script>
    <script>
    //para calcular distancias entre geoposiciones
    /**
* @param {google.maps.LatLng} newLatLng
* @returns {number}
*/
google.maps.LatLng.prototype.distanceFrom = function(newLatLng) {
   // setup our variables
   var lat1 = this.lat();
   var radianLat1 = lat1 * ( Math.PI  / 180 );
   var lng1 = this.lng();
   var radianLng1 = lng1 * ( Math.PI  / 180 );
   var lat2 = newLatLng.lat();
   var radianLat2 = lat2 * ( Math.PI  / 180 );
   var lng2 = newLatLng.lng();
   var radianLng2 = lng2 * ( Math.PI  / 180 );
   // sort out the radius, MILES or KM?
   var earth_radius = 3959; // (km = 6378.1) OR (miles = 3959) - radius of the earth
 
   // sort our the differences
   var diffLat =  ( radianLat1 - radianLat2 );
   var diffLng =  ( radianLng1 - radianLng2 );
   // put on a wave (hey the earth is round after all)
   var sinLat = Math.sin( diffLat / 2  );
   var sinLng = Math.sin( diffLng / 2  ); 
 
   // maths - borrowed from http://www.opensourceconnections.com/wp-content/uploads/2009/02/clientsidehaversinecalculation.html
   var a = Math.pow(sinLat, 2.0) + Math.cos(radianLat1) * Math.cos(radianLat2) * Math.pow(sinLng, 2.0);
 
   // work out the distance
   var distance = earth_radius * 2 * Math.asin(Math.min(1, Math.sqrt(a)));
 
   // return the distance
   return distance;
}
    </script>
  </body>
</html>
