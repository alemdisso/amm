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
<a href="/home" title="Home">Home</a> &rsaquo; Livros
</div>
<!-- /breadcrumb -->

<!-- conteudo -->
<div id="conteudo">

<h1><img src="/img/icone_livros.png" align="absmiddle" alt="Livros" /> Livros</h1>

<!-- destaques -->
<div class="clearfix">

<div class="float_left livro_destaque">
<a href=""><img src="/img/marcacao_destaque_livro1.png" /></a>
<h3><a href="">Menina Bonita do La&ccedil;o de Fita</a></h3>
<p>Chamada do livro infantil/juvenil em destaque lorem ipsum dolor. <a href="" class="mais">mais</a></p>
</div>

<div class="float_right livro_destaque">
<a href=""><img src="/img/marcacao_destaque_livro2.png" /></a>
<h3><a href="">A Aud&aacute;cia dessa Mulher</a></h3>
<p>Chamada do livro adulto em destaque lorem ipsum dolor. <a href="" class="mais">mais</a></p>
</div>

</div>
<!-- /destaques -->

<!-- categorias -->
<div id="livros_categorias" class="clearfix">
<h2>Livros por categoria:</h2>
<a href="">Infantis</a><a href="">Fic&ccedil;&atilde;o</a><a href="">Juvenis</a><a href="">Ensaios</a>
</div>
<!-- categorias -->



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