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
   //codigo para detectar los movimientos del scrollspy
   $('#navFormacion').on('activate.bs.scrollspy', function () {
      //obtner el texto del elem. seleccionado en navFormacion
      var txtSel=$('#navFormacion li').filter(
        function(){
        return $(this).hasClass('active')
      }).children().text()

      //seleccionar del menu principal el elem. seleccionado en navFormacion
      $('.dropdown-menu').children().filter(
        function(){
          return ($(this).children().text()===txtSel)
        }
      ).addClass('active')

   })
    
});
    </script>
  </body>
</html>
