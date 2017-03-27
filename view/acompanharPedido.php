<!DOCTYPE html>
<html lang="pt">

<head>
	<meta charset="utf-8">
	<title>Paradise Pies</title>
	
	<link rel="shortcut icon" href="view/Imagens/favicon.png">
	<link rel="stylesheet" media="screen" href="view/style.css?v=8may2013">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Isabela Andrade">
	<meta name="robots" content="all">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<script>
	$(document).ready(function(){
	  // Add smooth scrolling to all links
	  $("a").on('click', function(event) {

		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
		  // Prevent default anchor click behavior
		  event.preventDefault();

		  // Store hash
		  var hash = this.hash;

		  // Using jQuery's animate() method to add smooth page scroll
		  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){
	   
			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		  });
		} // End if
	  });
	});
	</script>
	
	
	<script>
	function msg() {
		alert("Encomenda Realizada!");
	}
	</script>
	
	
	<script>
			$(document).ready(function() {
  
			  $(window).scroll(function () {
				  //if you hard code, then use console
				  //.log to determine when you want the 
				  //nav bar to stick.  
				  console.log($(window).scrollTop())
				if ($(window).scrollTop() > 210) {
				  $('nav').addClass('navbar-fixed');
				}
				if ($(window).scrollTop() < 211) {
				  $('nav').removeClass('navbar-fixed');
				}
			  });
			});
	</script>

<script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

<script>
$(document).ready(function() {

	//script de pop up
	//When you click on a link with class of poplight and the href starts with a # 
$('a.poplight[href^=#]').click(function() {
    var popID = $(this).attr('rel'); //Get Popup Name
    var popURL = $(this).attr('href'); //Get Popup href to define size
    //Pull Query & Variables from href URL
    var query= popURL.split('?');
    var dim= query[1].split('&');
    var popWidth = dim[0].split('=')[1]; //Gets the first query string value
    //Fade in the Popup and add close button
    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="view/Imagens/close.png" class="btn_close" title="Close Window" alt="Close" /></a>');
    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;
    //Apply Margin to Popup
    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });
    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 
    return false;
});

//Close Popups and Fade Layer

$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, a.close').remove();  //fade them both out
    });
    return false;
});
});

</script>

</head>

<body>

<span id="inicio"> </span>

<header></header>

<div id="sticky-anchor"></div>
<nav>
	<a href="/paradisepies?op=perfil2"> Voltar ao Início </a>

</nav>

<div class="caixas">

	<div class="caixa">
		
			<h1>Acompanhe seus Pedidos!</h1>			
			<table> 
			<tr>
			  <th>Número</th>
			  <th>Pedido</th>
			  <th>Quantidade</th>
			  <th>Data do Pedido</th>
			  <th>Prazo de Entrega</th>
			  <th>Status</th>
			</tr>
			
			<?php for($i=0; $i<$nPedidos; $i++)
			{ ?>
			<tr>
			  <td><?= $i+1 ?></td>
			  <td><?= $pedido[$i] ?></td>
			  <td><?= $quantidade[$i] ?></td>
			  <td><?= $dataPedido[$i] ?></td>
			  <td><?= $dataEntrega[$i] ?></td>
			  <td><?= $status[$i] ?></td>
			</tr>
			<?php }	?>
			
			  </table>
  
			
	</div>
	
	<footer>
	
			<div class="rs">
				<h2>Onde nos encontrar</h2>

			
					<a href="https://www.facebook.com/paradisepie/"> <img src="view/Social/facebook.png" alt="facebook"/> curta nossa página </a>
					<a href="https://www.instagram.com/paradise.pies/"> <img src="view/Social/instagram.png" alt="instagram"/> nos siga no instagram  </a>
					
					<br>
					 
					 <img src="view/Social/home.png" alt="Endereço"/> Rua 13 de Maio, 1220, Campo Grande - MS 
					 
					 <br>
					 
					 <img src="view/Social/email.png" alt="Email"/> paradisepies@gmail.com 
			
				
			</div>
			
			<div class="me">
			
			<h2>Sobre Mim</h2>
			
			<div class="caixaSobreMim">
			  
			  <img src="view/Imagens/me.jpg" class="portrait" alt="Sobre Mim"/> 
			  
			  Meu nome é Isabela, tenho 20 anos. Sou apaixonada por doces e por web design. Faço ambos com muito carinho, gosto de agradar as pessoas com as
			  coisas que eu sou boa. Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá Blá 
			  
			</div>
			
		
			
			<a href="https://www.facebook.com/isaverlac/"><img src="view/Social/facebook.png" alt="facebook"/></a>
			<a href="https://twitter.com/isaverlac"><img src="view/Social/instagram.png" alt="instagram"/></a>
			<a href="https://www.instagram.com/isaverlac/"><img src="view/Social/twitter.png" alt="twitter"/></a>
			<a href="https://city0fglass.tumblr.com"><img src="view/Social/tumblr.png" alt="tumblr"/></a>
			
			</div>
	
		<div class="disclaimer">
			<p> Layout inteiramente desenvolvido por Isabela Andrade Souza. Todos os direitos reservados. <br>
		Plágio é crime de acordo com a Lei Federal dos direitos autorais n°9610.</p>
		</div>
		
	</footer>
</div>


<div id="pop" class="popup_block">

<h2>Avaliação do Pedido <strong>02</strong></h2>
	
		<form>
		
		<label for="entrega">Nota:</label>
		
			<input type="radio" name="nota5" value="5" checked> 5
			<input type="radio" name="nota4" value="4"> 4
			<input type="radio" name="nota3" value="3"> 3
			<input type="radio" name="nota2" value="2"> 2
			<input type="radio" name="nota1" value="1"> 1
		   
		   <br><br>
			
			<label for="msg">Mensagem Opcional:</label> <br>
				<textarea id="msg" name="msg" rows="4" cols="64" placeholder="Digite sua mensagem">
					
				</textarea>
				
				<br><br>
				
					<button type="submit" value="Enviar">Enviar</button>
					<button type="reset" value="Cancelar">Resetar</button>
			</form>		
						

</div>

</body>
</html>