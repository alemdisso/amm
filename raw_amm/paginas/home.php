<?php 
require "../includes/doctype.html.php";
?>
<head>
<?php
require "../includes/meta.html.php";
require "../includes/css.html.php";
?>

<title><?php echo $dadosPagina['title']?></title>

<script type="text/javascript" src="/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="/js/easytabs.js"></script>

</head>

<body>
<!-- container -->
<div id="home" class="clearfix">

<!-- topo -->
<?php include ("../includes/topo.php") ?>
<!-- /topo -->

<!-- conteudo -->
<div id="conteudo" class="conteudo_1coluna">

<!-- livros -->
<div id="livros_home" class="clearfix">
<div class="coluna1 clearfix">
<img src="img/icone_livros.png" align="top" class="float_left" />
<div class="float_left">
<h2>Livros</h2>
<h4>Mil hist&oacute;rias num s&oacute; lugar</h4>
</div>
</div>

<ul class="coluna2">
<li><a href="" title="Infantis">Infantis</a></li>
<li><a href="" title="Juvenis">Juvenis</a></li>
<li><a href="" title="Fic&ccedil;&atilde;o e Poesia">Fic&ccedil;&atilde;o e Poesia</a></li>
<li><a href="" title="Ensaios">Ensaios</a></li>
</ul>

<div class="coluna3 clearfix">
<div class="float_left">
<h3>Aos Quatro Ventos</h3>
<p>Finalista do Premio Jabuti, Camara Brasileira do Livro.</p>
<p><a href="" title="Mais" class="mais">mais</a></p>
</div>
<a href="" class="float_right" title=""><img src="../img/marcacao_capa.png" alt="" /></a>
</div>

</div>
<!-- /livros -->

<!-- novidades -->
<div id="novidades_home">

<div class="coluna1 clearfix">
<img src="img/icone_novidades.png" align="top" class="float_left" />
<div class="float_left">
<h2>Novidades</h2>
<h4>O que a Ana anda aprontando por a&iacute;</h4>
</div>
</div>

<div class="coluna2">
<!-- item de repeticao -->
<h3><a href="" title="">Silenciosa Algazarra sera tema de conversa com professores na PUC/RJ</a></h3>
<p>28.08.2012 | <a href="" title=""><strong>2 coment&aacute;rios</strong></a></p>
<!-- /item de repeticao -->
<!-- item de repeticao -->
<h3><a href="" title="">Ana Maria Machado e Ruth Rocha no Salao do Livro Infantil em Belo Horizonte</a></h3>
<p>28.08.2012 | <a href="" title=""><strong>Comente</strong></a></p>
<!-- /item de repeticao -->
</div>

</div>
<!-- /novidades -->

<!-- biografia -->
<div id="biografia_home">

<div class="coluna1 clearfix">
<img src="img/icone_biografia.png" align="top" class="float_left" />
<div class="float_left">
<h2>Biografia</h2>
<h4>Um resumo da vida e obra da artista</h4>
</div>
</div>

<div class="coluna2">
<p>Meu nome e Ana Maria Machado e eu vivo inventando historias. E dessas que eu escrevo, algumas viram livros. </p>
<p><a href="" title="Mais" class="mais">mais</a></p>
</div>

</div>
<!-- /biografia -->

<!-- contato -->
<div id="contato_home">

<div class="coluna1 clearfix">
<img src="img/icone_contato.png" align="top" class="float_left" />
<div class="float_left"><h2>Contato</h2>
<h4>Tire suas d&uacute;vidas ou entre em contato</h4>
</div>
</div>

<div class="coluna2">
<p>A resposta para a sua duvida pode estar aqui:</p>
<form>
<select class="duvidas">
<option selected="selected">Selecione</option>
</select>
</form>
</div>

</div>
<!-- /contato -->

</div>
<!-- /conteudo -->

<!-- rodape -->
<?php include ("../includes/rodape_home.php") ?>
<!-- /rodape -->

</div>
<!-- /container -->

</body>
</html>