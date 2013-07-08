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
<a href="/home" title="Home">Home</a> &rsaquo; <a href="/home" title="Novidades">Novidades</a> &rsaquo; Ana Maria Machado e Ruth Rocha no Salao do Livro Infantil em Belo Horizonte
</div>
<!-- /breadcrumb -->

<!-- conteudo -->
<div id="conteudo">

<h1><img src="/img/icone_novidades.png" align="absmiddle" alt="Novidades" /> Novidades</h1>

<a href=""><img src="/img/marcacao_thumbnail.png" class="float_left" /></a>
<h3>Ana Maria Machado e Ruth Rocha no Salao do Livro Infantil em Belo Horizonte</h3>
<p>28.08.2012 | <a href="" title=""><strong>Leitura</strong></a> | <a href="" title=""><img src="/img/icone_comentario.png" align="absmiddle" /> <strong>Comente</strong></a></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla pellentesque quam ac eros gravida auctor. Nam a tristique enim. Ut tristique diam quis magna vehicula vitae consequat dui pretium. Pellentesque ligula nisl, tristique at pellentesque et, condimentum vel urna.</p>

<!-- tags -->
<p>Tags: <a href="" class="tag_2">encontro-literario</a>, <a href="" class="tag_2">palestra</a>, <a href="" class="tag_2">livros</a>, <a href="" class="tag_2">escola</a>, <a href="" class="tag_2">luva</a>, <a href="" class="tag_2">infamia</a></p>
<!-- /tags -->

<!-- compartilhamento -->
<div class="box_conteudo"><strong>Compartilhe:</strong></div>
<!-- /compartilhamento -->

<!-- comentarios -->
<div class="box_conteudo clearfix">
<h4 class="comentario">Coment&aacute;rios</h4>

<!-- item de repeticao -->
<div class="item_comentario">
<p><strong>Fabiana Lizak</strong> disse:</p>
<p><small>28.08.2011 &agrave;s 10:51</small></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi viverra, nunc sed bibendum consequat, lacus erat volutpat sem, et pellentesque urna lacus id metus. Integer fermentum urna eu lectus fringilla rhoncus. Morbi eget mauris augue integer nec.</p>
</div>
<!-- /item de repeticao -->

<!-- item de repeticao -->
<div class="item_comentario">
<p><strong>Fabiana Lizak</strong> disse:</p>
<p><small>28.08.2011 &agrave;s 10:51</small></p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi viverra, nunc sed bibendum consequat, lacus erat volutpat sem, et pellentesque urna lacus id metus. Integer fermentum urna eu lectus fringilla rhoncus. Morbi eget mauris augue integer nec.</p>
</div>
<!-- /item de repeticao -->

</div>
<!-- /comentarios -->

<!-- comente -->
<div class="box_conteudo clearfix" style="padding-bottom:20px;">
<h4 class="comentario">Comente</h4>
<form>
<textarea rows="8" class="comentario">Escreva o seu coment&aacute;rio aqui.</textarea>
<p>Preencha os seus dados abaixo ou clique em um &iacute;cone para login: <a href=""><img align="absmiddle" src="/img/icone_comentario_wp.png" /></a> <a href=""><img align="absmiddle" src="/img/icone_comentario_twitter.png" /></a> <a href=""><img align="absmiddle" src="/img/icone_comentario_facebook.png" /></a></p>
<input type="text" class="comentario" value="E-mail (obrigat&oacute;rio)" />
<input type="text" class="comentario" value="Nome (obrigat&oacute;rio)" />
<input type="text" class="comentario" value="Website" />
<input type="checkbox" /> Quero ser notificado de coment&aacute;rios adicionais por email.<br /><br />
<input type="checkbox" /> Quero ser notificado de novos posts por email.<br /><br />
<input type="submit" value="Enviar coment&aacute;rio" />
</form>
</div>
<!-- /comente -->

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