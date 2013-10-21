<!DOCTYPE html>
<html>
  <head>
    <title>Zubiri Manteo MegaInsti-- Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
   
  </head>
  <body id="formacion">
		<section class="container">
			<div class="content row" >
        <?php include "componentes/header.php"; ?>
      </div>
      <div class="content row">
        <section class="sidebar col col-sm-4">
          <?php include "componentes/menuFormacion.php"; ?>
        </section><!-- sidebar -->
      
				<section class="main col col-sm-8">
          <?php include "componentes/mainFormacion.php"; ?>

				</section><!-- main -->
      </div>
		<div>
      <?php include "componentes/footer.php"; ?>
    </div>
		</section><!-- container -->

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="js/app.js"></script>
   <script>
   $('#mainForm').scrollspy({
      target: '#navFormacion',
      offset: 400
    }); 
    
});
    </script>
  </body>
</html>
