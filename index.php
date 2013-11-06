<!DOCTYPE html>
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

  var flickerAPI = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
  $.getJSON( flickerAPI, {
    tags: "zurriola",
    tagmode: "any",
    format: "json"
  })
    .done(function( data ) {
      console.log(data);
      /*$.each( data.items, function( i, item ) {
        $( "<img>" ).attr( "src", item.media.m ).appendTo( "#images" );
        if ( i === 3 ) {
          return false;
        }
      });*/
    });

    
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
