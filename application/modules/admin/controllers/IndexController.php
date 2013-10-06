<?php

class Admin_IndexController extends Zend_Controller_Action
{

    private $db;
    private $editorMapper;
    private $editionMapper;
    private $workMapper;
    private $postMapper;

    public function preDispatch()
    {
        try {
            $checker = new Moxca_Access_PrivilegeChecker();
        } catch (Exception $e) {
            throw $e;
        }
        $this->view->pageTitle = "";
    }

    public function init()
    {
        $this->initDbAndMappers();

        $this->view->activateNavigation($this->_request, $this->view);

        $layoutHelper = $this->_helper->getHelper('Layout');
        $this->view->setNestedLayout($layoutHelper, 'inner_admin');
    }

    public function listPostsAction()
    {
        $this->postMapper = new Moxca_Blog_PostMapper($this->db);
        $posts = $this->postMapper->getAllIds();

        $postsData = array();
        foreach ($posts as $postId) {
            $loopPostObj = $this->postMapper->findById($postId);

            $creationDate = $this->view->splitDateFromDateTime($loopPostObj->getCreationDate());
            $statusLabel = $this->view->postStatusLabel($loopPostObj, new Moxca_Blog_PostStatus, $this->view);

            $postsData[$postId] = array(
                    'title' => $loopPostObj->getTitle(),
                    'creationDate' => $this->view->formatDateToShow($creationDate, "."),
                    'statusLabel' => $statusLabel,
            );
        }


        $data = array(
            'postsList' => $postsData,
        );


        $this->view->pageData = $data;

    }

    public function listWorksAction()
    {
        $works = $this->workMapper->getAllIds();

        $worksData = array();
        foreach ($works as $workId) {
            $loopWorkObj = $this->workMapper->findById($workId);

            $loopEditionObj = $this->editionMapper->findByWork($workId);
            if (!is_null($loopEditionObj)) {
                $loopEditorObj = $this->editorMapper->findById($loopEditionObj->getEditor());
                $editorName = $loopEditorObj->getName();
            } else {
                $loopEditorObj = null;
                $editorName = $this->view->translate("#no editions");
                $editorName = "(<em>$editorName</em>)";
            }

            $typeLabel = $this->view->typeLabel($loopWorkObj, new Author_Collection_WorkTypes, $this->view);

            $worksData[$workId] = array('title' => $this->view->workTitleAndPrefix($loopWorkObj),
                    'typeLabel' => $typeLabel,
                    'editorName' => $editorName,
            );
        }


        $data = array(
            'worksList' => $worksData,
        );


        $this->view->pageData = $data;

    }


    public function populateSeriesAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);

        $data = $this->_request->getParams();
        try {
            $editor = $this->view->checkIdFromGet($data, 'editor');
        } catch (Exception $e) {
            throw $e;
        }

        $serieMapper = new Author_Collection_SerieMapper($this->db);
        $list = $serieMapper->getAllSeriesAlphabeticallyOrdered($editor);

        $data = array();
        foreach ($list as $serieId => $serieName) {
            $data[] = array('id' => $serieId, 'name' => $serieName);
        }
        echo json_encode($data);

    }

    public function populateEditorsAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);

        $editorMapper = new Author_Collection_EditorMapper($this->db);
        $list = $editorMapper->getAllEditorsAlphabeticallyOrdered();

        $data = array();
        foreach ($list as $editorId => $editorName) {
            $data[] = array('id' => $editorId, 'name' => $editorName);
        }
        echo json_encode($data);

    }


    private function initDbAndMappers()
    {
        $this->db = Zend_Registry::get('db');
        $this->workMapper = new Author_Collection_WorkMapper($this->db);
        $this->editorMapper = new Author_Collection_EditorMapper($this->db);
        $this->editionMapper = new Author_Collection_EditionMapper($this->db);

    }

}