<script type="text/javascript" language="javascript">
<!--ABRIR E FECHAR BOXES-->
var aberto = false;
function abreBox() {

	if(!aberto) {
		document.getElementById("box1").style.display = "block";
		document.getElementById("box2").style.display = "none";
		aberto = true;
	}
	else {
		aberto = false;
	}
}

function fechaBox() {
	if(aberto) {
		document.getElementById("box1").style.display = "none";
		document.getElementById("box2").style.display = "block";
		aberto = false;
	}
document.onclick = fechaBox1;
}
<!--/ABRIR E FECHAR BOXES-->
</script>

<!-- box busca -->
<div class="box">

<h2>Busca de livros</h2>

<form>
<input type="text" class="busca display_block float_left" /><input type="submit" value="Ok" class="display_block float_right" />
</form>

<div id="box2">
<p class="clear_both"><a href="Javascript:abreBox()" alt="busca avan&ccedil;ada">busca avan&ccedil;ada <img src="/img/icone_abrir.png" align="absmiddle" alt="busca avan&ccedil;ada" /></a></p>
</div>

<!-- busca avancada -->
<div id="box1" style="display:none">

<p class="clear_both"><a href="Javascript:fechaBox()" alt="busca avan&ccedil;ada">busca avan&ccedil;ada <img src="/img/icone_fechar.png" align="absmiddle" alt="busca avan&ccedil;ada" /></a></p>

<form>
<select class="busca">
<option selected="selected">Selecione</option>
</select>

<select class="busca">
<option selected="selected">Selecione</option>
</select>

<select class="busca">
<option selected="selected">Selecione</option>
</select>

<select class="busca">
<option selected="selected">Selecione</option>
</select>
</form>
</div>
<!-- /busca avancada -->

</div>
<!-- /box busca -->
