<?php

class Works_View_Helper_IterateWorks extends Zend_View_Helper_Abstract
{
    public function iterateWorks($a)
    {

        foreach ($a as $workId => $workData) {
            $exploreUri = $workData['exploreUri'];
            $title = $workData['title'];
            $editorName = $workData['editorName'];
            $summary = $workData['summary'];
            echo "<!-- item de repeticao -->
<div class=\"item_livro clearfix\">
<a href=\"$exploreUri\" class=\"thumbnail_livro\"><img src=\"/img/marcacao_livro.png\" /></a>
<div style=\"width:450px;\" class=\"float_right\"><!-- largura para quando existir thumbnail + class na div -->
<h3><a href=\"$exploreUri\">$title</a> <a href=\"\"><img src=\"/img/detalhe_premio.png\" align=\"absmiddle\" /></a><a href=\"\"><img src=\"/img/detalhe_premio.png\" align=\"absmiddle\" /></a><a href=\"\"><img src=\"/img/detalhe_premio.png\" align=\"absmiddle\" /></a></h3>
<p><strong>$editorName</strong></p>
<p>$summary</p>
<p><a href=\"$exploreUri\" title=\"\" class=\"mais\">leia mais</a></p>
</div>
</div>
<!-- /item de repeticao -->";
        }
    }
}

