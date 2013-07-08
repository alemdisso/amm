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
<a href="/home" title="Home">Home</a> &rsaquo; <a href="/livros" title="Livros">Livros</a> &rsaquo; Categoria: Infantis
</div>
<!-- /breadcrumb -->

<!-- conteudo -->
<div id="conteudo">

<h1><img src="/img/icone_livros.png" align="absmiddle" alt="Livros" /> Livros</h1>

<h2 class="categoria">Categoria: Infantis</h2>

<!-- legenda -->
<div class="box_conteudo"><img src="/img/detalhe_premio.png" align="absmiddle" /> <strong>Pr&ecirc;mios recebidos</strong> | <img src="/img/icone_livro_mais.png" align="absmiddle" /> <strong>Curiosidades sobre o livro</strong> | <img src="/img/detalhe_traducao.png" align="absmiddle" /> <strong>Livro traduzido</strong></div>
<!-- /legenda -->

<!-- item de repeticao -->
<div class="item_livro clearfix">
<a href="" class="thumbnail_livro"><img src="/img/marcacao_livro.png" /></a>
<div style="width:450px;" class="float_right"><!-- largura para quando existir thumbnail + class na div -->
<h3><a href="">Banho Sem Chuva</a> <a href=""><img src="/img/detalhe_premio.png" align="absmiddle" /></a><a href=""><img src="/img/detalhe_premio.png" align="absmiddle" /></a><a href=""><img src="/img/detalhe_premio.png" align="absmiddle" /></a></h3>
<p><strong>Salamandra, 1988</strong></p>
<p>Da s&eacute;rie Mico Maneco. Essa divertida hist&oacute;ria ajuda a treinar a leitura de palavras com d&iacute;grafos.</p>
<p><a href="" title="mais livros" class="mais">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->

<!-- item de repeticao -->
<div class="item_livro clearfix">
<a href="" class="thumbnail_livro"><img src="/img/marcacao_livro.png" /></a>
<div style="width:450px;" class="float_right"><!-- largura para quando existir thumbnail + class na div -->
<h3><a href="">Banho Sem Chuva</a> <a href=""><img src="/img/detalhe_premio.png" align="absmiddle" /></a><a href=""><img src="/img/detalhe_traducao.png" align="absmiddle" /></a><a href=""><img src="/img/icone_livro_mais.png" align="absmiddle" /></a></h3>
<p><strong>Salamandra, 1988</strong></p>
<p>Da s&eacute;rie Mico Maneco. Essa divertida hist&oacute;ria ajuda a treinar a leitura de palavras com d&iacute;grafos.</p>
<p><a href="" title="mais livros" class="mais">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->

<!-- item de repeticao -->
<div class="item_livro clearfix">
<a href="" class="thumbnail_livro"><img src="/img/marcacao_livro.png" /></a>
<div style="width:450px;" class="float_right"><!-- largura para quando existir thumbnail + class na div -->
<h3><a href="">Banho Sem Chuva</a> <a href=""><img src="/img/detalhe_premio.png" align="absmiddle" /></a><a href=""><img src="/img/detalhe_premio.png" align="absmiddle" /></a><a href=""><img src="/img/detalhe_premio.png" align="absmiddle" /></a></h3>
<p><strong>Salamandra, 1988</strong></p>
<p>Da s&eacute;rie Mico Maneco. Essa divertida hist&oacute;ria ajuda a treinar a leitura de palavras com d&iacute;grafos.</p>
<p><a href="" title="mais livros" class="mais">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->

<!-- paginacao -->
<div id="paginacao" class="clearfix">
<span class="float_left">Livros <strong>1 de 10</strong> de 33</span>
<span class="float_right">in&iacute;cio | <img src="/img/icone_anterior.png" align="absmiddle" /> anterior | <a href="" title=""><strong>pr&oacute;ximo</strong> <img src="/img/icone_mais.png" align="absmiddle" /></a> | <a href="" title=""><strong>fim</strong></a></span>
</div>
<!-- /paginacao -->

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