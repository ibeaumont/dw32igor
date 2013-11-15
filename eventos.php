<!DOCTYPE html>
<html>
  <head>
    <title>Zubiri Manteo MegaInsti-- Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
   
  </head>
  <body id="eventos">
		<section class="container">
			<div class="row">
         <?php include "componentes/header.php"; ?>
  			 
      </div>
<!--aqui vamos a introducir los thumbnails -->
      <div id='thumb'>
      </div>

  	
    <?php include "componentes/footer.php"; ?>
		</section><!-- container -->

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="js/app.js"></script>
    <script>
    var datos;
    var images;
//mostrar los conciertos de la sala rockstar
var url_rockStar='http://www.salarockstar.com/articles.html';
 
 $.getJSON('http://whateverorigin.org/get?url=' + 
          encodeURIComponent(url_rockStar) + '&callback=?',
          function cargaConciertos(data){
            datos=$(data.contents).find('.list1')
            images=$(datos).find('img').each(function(){
               $(this).attr('src','http://www.salarockstar.com/'+$(this).attr('src'))
            })
            var grupos=$(datos).find('img').siblings('strong')
            for(i=0;i<images.length;i++){
              if (i%3==0){
                //escribir una nueva linea
                $('#thumb').append('<div class="row">')
              }
              //añadir el thumbnail con los datos
              $('#thumb').append(showThumbnail($(grupos[i]).text(),$(images[i]).attr('src'),'url'));
            }

          })

 function showThumbnail(tit,img,url){
  var cod='<div class="col-md-4">'+
              '<div class="thumbnail">'+
              '<img src="'+img+'" alt="BesTrain">'+
                  '<div class="caption">'+
                  '<h3>'+tit+'</h3>'+
                  '<p></p>'+
                  '<p><a href="'+url+'" class="btn btn-primary">Mas info...</a></p>'+
                '</div>'+
            '</div>';
  return cod;
 }
    </script>
  </body>
</html>
