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
<div id="contato" class="clearfix">

<!-- topo -->
<?php include ("../includes/topo.php") ?>
<!-- /topo -->

<!-- breadcrumb -->
<div id="breadcrumb">
<a href="/home" title="Home">Home</a> &rsaquo; Contato
</div>
<!-- /breadcrumb -->

<!-- conteudo -->
<div id="conteudo">

<h1><img src="/img/icone_contato.png" align="absmiddle" alt="Contato" /> Contato</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium sodales cursus. 
Donec at metus risus. Sed congue commodo laoreet. Curabitur vitae nisl porta lacus egestas.</p>

<form>
<label>A resposta para a sua duvida pode estar aqui:</label>
<select>
<option selected="selected">Selecione</option>
</select>

<p>Caso n&atilde;o encontre a resposta do que procura na sele&ccedil;&atilde;o acima mande sua mensagem.</p>

<p><small>* campos obrigat&oacute;rios</small></p>

<label>Nome Completo*</label>
<input type="text" />

<label>E-mail*</label>
<input type="text" />

<label>Estado</label>
<select>
<option selected="selected">Selecione</option>
</select>

<label>Cidade</label>
<select>
<option selected="selected">Selecione</option>
</select>

<label>Assunto</label>
<select>
<option selected="selected">Selecione</option>
</select>

<label>Mensagem*</label>
<textarea rows="8"></textarea>

<label>Verfica&ccedil;&atilde;*</label>
<p>Digite os caracteres que aparecem na imagem abaixo:</p>
<div class="clearfix" style="width:180px;margin-bottom:20px;">
<img src="/img/marcacao_captcha.png" class="float_left" alt="captcha" width="100" height="40" />
<input type="text" class="float_right captcha" maxlength="6" />
</div>

<input type="submit" value="Enviar" />

</form>
</div>
<!-- /conteudo -->

<!-- lateral -->
<div id="lateral">
<?php include ("../includes/box_novidades.php") ?>
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