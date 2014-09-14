<?php
class Works_IndexController extends Zend_Controller_Action
{
    private $db;
    private $editorMapper;
    private $editionMapper;
    private $serieMapper;
    private $workMapper;
    private $taxonomyMapper;

    public function postDispatch()
    {
        if (isset($this->view->pageTitle)) {
            $this->_helper->layout()->getView()->headTitle($this->view->pageTitle . " :: Ana Maria Machado");
        }
    }

    public function init()
    {
        $this->initDbAndMappers();

        $this->view->activateNavigation($this->_request, $this->view);

        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_works');
    }

    public function fictionAction()
    {
        $editionsIds = $this->editionMapper->getAllEditionsOfTypeAlphabeticallyOrdered(Author_Collection_WorkTypeConstants::TYPE_FICTION);
        $this->buildEditionsListPage($editionsIds, "#Fiction");
    }

    public function childrenAction()
    {
        $editionsIds = $this->editionMapper->getAllEditionsOfTypeAlphabeticallyOrdered(Author_Collection_WorkTypeConstants::TYPE_CHILDREN);
        $this->buildEditionsListPage($editionsIds, "#Children");
    }

    public function essaysAction()
    {
        $editionsIds = $this->editionMapper->getAllEditionsOfTypeAlphabeticallyOrdered(Author_Collection_WorkTypeConstants::TYPE_ESSAY);
        $this->buildEditionsListPage($editionsIds, "#Essays");
    }

    public function serieAction()
    {
        $data = $this->_request->getParams();
        try {
            $uri = $this->view->checkUriFromGet($data);
        } catch (Exception $e) {
            throw $e;
        }

        $editionsIds = $this->editionMapper->getAllEditionsOfSerieByUri($uri);

        $serieMapper = new Author_Collection_SerieMapper($this->db);
        $serieObj = $serieMapper->findByUri($uri);
        if (count($editionsIds) > 0) {
            $serieLabel = sprintf($this->view->translate("#Serie: %s"), $serieObj->getName());
        } else {
            $serieLabel = "";
        }
        $this->buildEditionsListPage($editionsIds, $serieLabel);

        $this->view->pageTitle = $serieLabel;

    }

    public function seriesAction()
    {
        $serieMapper = new Author_Collection_SerieMapper($this->db);


        $serieIds = $serieMapper->getAllIds();
        $seriesData = array();
        foreach ($serieIds as $serieId) {
            $loopSerieObj = $serieMapper->findById($serieId);

            $data = $this->editionMapper->getSomeEditionFrom($serieId);

            $editionId = null;
            if ($data) {
                $editionId = $data[0];
            }

            if ($editionId) {
                $loopEditionObj = $this->editionMapper->findById($editionId);
                $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
                $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

                $coverFilePath = $this->view->coverFilePath($loopEditionObj);
//                print_r($loopEditionObj->getCover());
//                print("<BR>$coverFilePath<BR>");exit;
                $serieLabel = $loopSerieObj->getName();

                $seriesData[$serieId] = array(
                        'title' => $serieLabel,
                        'coverSrc' => $coverFilePath,
                        'exploreUri' => $this->view->translate('/serie/') . $loopSerieObj->getUri(),
                        'editorName' => $loopEditorObj->getName(),
                );
            }
        }

        $pageData = array(
            'seriesData' => $seriesData,
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $this->view->translate("#Series");

    }

//

    public function keywordAction()
    {
        $data = $this->_request->getParams();
        try {
            $uri = $this->view->checkUriFromGet($data);
            $x = $this->taxonomyMapper->getTermByUri($uri);
            $term = $x['term'];
        } catch (Exception $e) {
            throw $e;
        }

        $editionsIds = $this->taxonomyMapper->editionsWithKeyword($uri);
        $this->buildEditionsListPage($editionsIds, sprintf($this->view->translate("#With keyword '%s'"), $term));
    }

    public function youngAction()
    {
        $editionsIds = $this->editionMapper->getAllEditionsOfTypeAlphabeticallyOrdered(Author_Collection_WorkTypeConstants::TYPE_YOUNG);
        $this->buildEditionsListPage($editionsIds, "#Young");
    }

    public function indexAction()
    {
        $pageData = array(
            'leftSpecialUri' => '/livro/menina-bonita-do-laco-de-fita',
            'leftSpecialTitle' => 'Menina bonita do laço de fita',
            'leftSpecialSummary' => 'História de uma menina que, de tão bonita, deixa até um coelho apaixonado.',
            'leftSpecialImageUri' => '/img/marcacao_destaque_livro1.png',
            'rightSpecialUri' => '/livro/a-audacia-dessa-mulher',
            'rightSpecialTitle' => 'A audácia dessa mulher',
            'rightSpecialSummary' => 'Um romance que engloba varias vertentes e vem do século XIX aos nossos dias.',
            'rightSpecialImageUri' => '/img/special/audacia_crop.png',
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = "Ana Maria Machado - Histórias";
    }

    private function buildEditionsListPage($editionsIds, $title)
    {
        $editionsData = array();
        foreach ($editionsIds as $editionId) {
            $loopEditionObj = $this->editionMapper->findById($editionId);
            $loopWorkObj = $this->workMapper->findById($loopEditionObj->getWork());
            $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());

            if($loopEditionObj->getSerie()) {
                $loopSerieObj = $this->serieMapper->findById($loopEditionObj->getSerie());
                $serieName = $loopSerieObj->getName();
                $serieUri = $loopSerieObj->getUri();
            } else {
                $serieName = null;
                $serieUri = null;
            }

            $coverFilePath = $this->view->coverFilePath($loopEditionObj);

            $prizeMapper = new Author_Collection_PrizeMapper($this->db);
            $prizesLabels = $this->view->workPrizesLabels($loopWorkObj->getId(), $prizeMapper);

            $editionsData[$editionId] = array(
                    'title' => $loopWorkObj->getTitle(),
                    'coverSrc' => $coverFilePath,
                    'exploreUri' => $this->view->translate('/explore') . '/' . $loopWorkObj->getUri(),
                    'summary' => $loopWorkObj->getSummary(),
                    'editorName' => $loopEditorObj->getName(),
                    'serieName' => $serieName,
                    'serieUri' => $serieUri,
                    'prizes' => $prizesLabels,
                    'moreAbout' => false,
                    'otherLanguages' => false,
            );
        }

        $pageData = array(
            'editionsData' => $editionsData,
            'pageTitle' => $this->view->translate($title),
        );

        $this->view->pageData = $pageData;
        $this->view->pageTitle = $pageData['pageTitle'];
    }

    public function autocompleteAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);

        // prevent direct access
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        if(!$isAjax) {
          $user_error = 'Access denied - not an AJAX request...';
          trigger_error($user_error, E_USER_ERROR);
        }




        $data = $this->_request->getParams();
        $term = $data['term'];

        $parts = explode(' ', $term);


        $a_json = array();
        $a_json_row = array();

        $a_json_invalid = array(array("id" => "#", "value" => $term, "label" => "Only letters and digits are permitted..."));
        $json_invalid = json_encode($a_json_invalid);

        // replace multiple spaces with one
        $term = preg_replace('/\s+/', ' ', $term);

        // SECURITY HOLE ***************************************************************
        // allow space, any unicode letter and digit, underscore and dash
        if(preg_match("/[^\040\pL\pN_-]/u", $term)) {
          print $json_invalid;
          exit;
        }
        // *****************************************************************************


        $parts = explode(' ', $term);

        $result = $this->editionMapper->getAutoCompleteWorks($parts);

        $i = 0;

        foreach($result as $rowResult) {
          $a_json_row["id"] = $rowResult['uri'];
          $a_json_row["value"] = $rowResult['title'];
          $a_json_row["label"] = $rowResult['title'];
          array_push($a_json, $a_json_row);
        }

        // highlight search results
        $a_json = $this->apply_highlight($a_json, $parts);


        echo json_encode($a_json);

//        $json = json_encode($a_json);
//        print $json;

    }



    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);
        $this->serieMapper = new Author_Collection_SerieMapper($this->db);
        $this->taxonomyMapper = new Author_Collection_TaxonomyMapper($this->db);

    }

/**
 * mb_stripos all occurences
 * based on http://www.php.net/manual/en/function.strpos.php#87061
 *
 * Find all occurrences of a needle in a haystack
 *
 * @param string $haystack
 * @param string $needle
 * @return array or false
 */
private function mb_stripos_all($haystack, $needle) {

  $s = 0;
  $i = 0;

  while(is_integer($i)) {

    $i = mb_stripos($haystack, $needle, $s);

    if(is_integer($i)) {
      $aStrPos[] = $i;
      $s = $i + mb_strlen($needle);
    }
  }

  if(isset($aStrPos)) {
    return $aStrPos;
  } else {
    return false;
  }
}

/**
 * Apply highlight to row label
 *
 * @param string $a_json json data
 * @param array $parts strings to search
 * @return array
 */
private function apply_highlight($a_json, $parts) {

  $p = count($parts);
  $rows = count($a_json);

  for($row = 0; $row < $rows; $row++) {

    $label = $a_json[$row]["label"];
    $a_label_match = array();

    $converter = new Moxca_Util_StringToAscii();

    for($i = 0; $i < $p; $i++) {

      $part_len = mb_strlen($parts[$i]);
      $a_match_start = $this->mb_stripos_all($converter->toAscii($label), $converter->toAscii($parts[$i]));
      foreach($a_match_start as $part_pos) {

        $overlap = false;
        foreach($a_label_match as $pos => $len) {
          if($part_pos - $pos >= 0 && $part_pos - $pos < $len) {
            $overlap = true;
            break;
          }
        }
        if(!$overlap) {
          $a_label_match[$part_pos] = $part_len;
        }

      }

    }

    if(count($a_label_match) > 0) {
      ksort($a_label_match);

      $label_highlight = '';
      $start = 0;
      $label_len = mb_strlen($label);

      foreach($a_label_match as $pos => $len) {
        if($pos - $start > 0) {
          $no_highlight = mb_substr($label, $start, $pos - $start);
          $label_highlight .= $no_highlight;
        }
        $highlight = '<span class="hl_results">' . mb_substr($label, $pos, $len) . '</span>';
        $label_highlight .= $highlight;
        $start = $pos + $len;
      }

      if($label_len - $start > 0) {
        $no_highlight = mb_substr($label, $start);
        $label_highlight .= $no_highlight;
      }

      $a_json[$row]["label"] = $label_highlight;
    }

  }

  return $a_json;

}

}

