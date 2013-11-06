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
    <div class="row" id="footer">
      <?php include "componentes/footer.php"; ?>
    </div>
		</section><!-- container -->
    <div id="json">
      <!--ajax json-->
      
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="js/app.js"></script>
    <script>
    var kk;
    $.ajax({
        url : '/data/people.json',
        type : 'GET',
        dataType : 'json',
        success : function(data) {
          kk=data;
            /*$('#json').append("<ul>")
            $()
            $('<h1/>').text(json.title).appendTo('body');
            $('<div class="content"/>')
            .html(json.html).appendTo('body');*/
            },
       error : function(jqXHR, status, error) {
            alert('Disculpe, existió un problema');
      },
      
      });
    </script>
  </body>
</html>
