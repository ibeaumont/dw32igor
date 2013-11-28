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
          <?php include "componentes/noticias.php"; ?>
				</section><!-- sidebar -->
			</div><!-- content -->
    <?php include "componentes/footer.php"; ?>
		</section><!-- container -->

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKCfIwvBuXvsA2HdVQTb1Ny-zLQ1jjXjw
&sensor=true&libraries=places"">
    </script>
    <script type="text/javascript">
    var mapa;
    var image;
    var marker, markerAquiToy;
    var pos;
    var zubiriPos;

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
    function showRuta(){
      var directionsService = new google.maps.DirectionsService();
      var directionsDisplay = new google.maps.DirectionsRenderer();
      directionsDisplay.setMap(mapa);
      var request = {
        origin:pos,
        destination:$('#txtBuscar').val(),
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
        var types = document.getElementById('type-selector');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        //fin autocompletar

}
      $(document).ready(initialize());
    </script>
  </body>
</html>
