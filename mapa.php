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
&sensor=true">
    </script>
    <script type="text/javascript">
    var mapa;
    var image;
    var marker, markerAquiToy;

      function initialize() {
        var pos;
        //geolocalizacion de zubiri

        var zubiriPos=new google.maps.LatLng(43.327347,-1.970941);
        //geolocalizacion detectada por el navagador
        if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
        pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        console.log(pos);

          });
        }
        var mapOptions = {
          center: pos,
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        mapa = new google.maps.Map(document.getElementById("map"),
            mapOptions);

  image = new google.maps.MarkerImage('img/logoZubiri.png');
  image.scaledSize = new google.maps.Size(35, 35);
  image.anchor = new google.maps.Point(0, 35);
  //colocar un nuevo marcador en la localizacion dada por el navegador
  console.log(pos);
  markerAquiToy = new google.maps.Marker({
     position: pos,
      map: mapa,
      title: 'A ver a ver',
      icon: image


  });

  marker = new google.maps.Marker({
     position: pos,
      map: mapa,
      title: 'Intza hemen dago!',
      icon: image
  });
  

var contentString='<div> Akerrak adarrak okerrak ditu<br/>Adarrak okerrak akerrak ditu</div>';
var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

 
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(mapa,marker);
  });
      }
      $(document).ready(initialize());
    </script>
  </body>
</html>
