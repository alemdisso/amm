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
<div id="novidades" class="clearfix">

<!-- topo -->
<?php include ("../includes/topo.php") ?>
<!-- /topo -->

<!-- breadcrumb -->
<div id="breadcrumb">
<a href="/home" title="Home">Home</a> &rsaquo; Novidades
</div>
<!-- /breadcrumb -->

<!-- conteudo -->
<div id="conteudo">

<h1><img src="/img/icone_novidades.png" align="absmiddle" alt="Novidades" /> Novidades</h1>

<!-- item de repeticao -->
<div class="item clearfix">
<div style="width:600px;" class="float_right"><!-- largura para quando não existir thumbnail -->
<h3><a href="">Silenciosa Algazarra sera tema de conversa com professores na PUC/RJ</a></h3>
<p>28.08.2012 | <a href="" title=""><strong>Agenda</strong></a> | <a href="" title=""><img src="/img/icone_comentario.png" align="absmiddle" /> <strong>2 coment&aacute;rios</strong></a></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna.</p>
<p><a href="" title="mais novidades" class="mais">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->

<!-- item de repeticao -->
<div class="item clearfix">
<img src="/img/marcacao_thumbnail.png" class="float_left" />
<div style="width:400px;" class="float_right"><!-- largura para quando existir thumbnail + class na div -->
<h3><a href="" title="">Ana Maria Machado e Ruth Rocha no Salao do Livro Infantil em Belo Horizonte</a></h3>
<p>28.08.2012 | <a href="" title=""><strong>Leitura</strong></a> | <a href="" title=""><img src="/img/icone_comentario.png" align="absmiddle" /> <strong>Comente</strong></a></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna.</p>
<p><a href="" title="mais novidades" class="mais">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->

<!-- item de repeticao -->
<div class="item clearfix">
<div style="width:600px;" class="float_right">
<h3><a href="">Silenciosa Algazarra sera tema de conversa com professores na PUC/RJ</a></h3>
<p>28.08.2012 | <a href="" title=""><strong>Agenda</strong></a> | <a href="" title=""><img src="/img/icone_comentario.png" align="absmiddle" /> <strong>2 coment&aacute;rios</strong></a></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna.</p>
<p><a href="" title="mais novidades" class="mais">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->

<!-- item de repeticao -->
<div class="item clearfix">
<img src="/img/marcacao_thumbnail.png" class="float_left" />
<div style="width:400px;" class="float_right">
<h3><a href="" title="">Ana Maria Machado e Ruth Rocha no Salao do Livro Infantil em Belo Horizonte</a></h3>
<p>28.08.2012 | <a href="" title=""><strong>Leitura</strong></a> | <a href="" title=""><img src="/img/icone_comentario.png" align="absmiddle" /> <strong>Comente</strong></a></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna.</p>
<p><a href="" title="mais novidades" class="mais">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->


<!-- paginacao -->
<div id="paginacao" class="clearfix">
<span class="float_left">Posts <strong>1 de 10</strong> de 33</span>
<span class="float_right">in&iacute;cio | <img src="/img/icone_anterior.png" align="absmiddle" /> anterior | <a href="" title=""><strong>pr&oacute;ximo</strong> <img src="/img/icone_mais.png" align="absmiddle" /></a> | <a href="" title=""><strong>fim</strong></a></span>
</div>
<!-- /paginacao -->

</div>
<!-- /conteudo -->

<!-- lateral -->
<div id="lateral">
<?php include ("../includes/box_novidades_categorias.php") ?>
<?php include ("../includes/box_novidades_mes.php") ?>
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