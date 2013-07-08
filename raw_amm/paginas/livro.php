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
<div id="livros" class="clearfix">

<!-- topo -->
<?php include ("../includes/topo.php") ?>
<!-- /topo -->

<!-- breadcrumb -->
<div id="breadcrumb">
<a href="/home" title="Home">Home</a> &rsaquo; <a href="/livros" title="Livros">Livros</a> &rsaquo; Menina Bonita do La&ccedil;o de Fita
</div>
<!-- /breadcrumb -->

<!-- conteudo -->
<div id="conteudo">

<h1><img src="/img/icone_livros.png" align="absmiddle" alt="Livros" /> Livros</h1>

<a href=""><img src="/img/marcacao_livro.png" class="float_left livro" /></a>
<h3>Menina Bonita do La&ccedil;o de Fita</h3>
<p><strong>&Aacute;tica, 2000</strong></p>
<p>Era uma menina linda. A pele era escura e lustrosa, que nem p&ecirc;lo da pantera quando pula na chuva. Do lado da casa dela morava um coelho que achava a menina a pessoa mais linda que ele j&aacute; vira na vida. Queria ter uma filha linda e pretinha como ela. Um dos maiores sucesso da autora.</p>

<p><small>
Cole&ccedil;&atilde;o: Barquinho de Papel<br />
Capa: Claudius<br />
Ilustra&ccedil;&otilde;es: Claudius<br />
ISBN: 8508066392<br />
24 p&aacute;ginas<br />
</small></p>

<form>
<input type="submit" value="Comprar online" />
</form>

<!-- mais sobre o livro -->
<div class="box_conteudo" style="margin-top:20px;"><img src="/img/icone_livro_mais.png" align="absmiddle" /> <a href=""><strong>Mais curiosidades sobre este livro</strong></a></div>
<!-- /mais sobre o livro -->

<!-- premios -->
<div class="box_conteudo">
<h4 class="premio">Pr&ecirc;mios</h4>
<ul>
<li>1997 - Pr&ecirc;mio Am&eacute;ricas (Melhores livros latinos nos EUA)</li>
<li>1996 - Altamente Recomend&aacute;vel, Fundalectura, Bogot&aacute;, Col&ocirc;mbia</li>
<li>1996 - Melhor Livro Infantil Latino-americano, ALIJA - Buenos Aires></li>
<li>1995 - Pr&ecirc;mio Melhores do Ano, Biblioteca Nacional da Venezuela</li>
<li>1988 - Pr&ecirc;mio Bienal de S&atilde;o Paulo, Bienal de S&atilde;o Paulo (Men&ccedil;&atilde;o Honrosa - Uma das Cinco Melhores Obras do Bi&ecirc;nio)</li>
</ul>
</div>
<!-- /premios -->

</div>
<!-- /conteudo -->

<!-- lateral -->
<div id="lateral">
<?php include ("../includes/box_livros_categorias.php") ?>
<?php include ("../includes/box_busca.php") ?>
</div>
<!-- /lateral -->

<!-- rodape -->
<?php include ("../includes/rodape.php") ?>
<!-- /rodape -->

</div>
<!-- /container -->

</body>
</html>