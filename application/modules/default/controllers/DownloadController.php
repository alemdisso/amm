<?php
class DownloadController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }


    public function indexAction()
    {
        $file = $this->getRequest()->getParam('qualArquivo');
        $path = $this->getRequest()->getParam('caminho') . $file;

        $mimetype = array(
            'doc'=>'application/msword',
            'torrent'=>'application/x-bittorrent',
            'jpg'=>'image/pjpeg',
            'pdf'=>'application/pdf',
            'txt'=>'text/plain',
            'xls'=>'application/vnd.ms-excel',
            'mp3'=>'audio/mpeg',
            'rtf'=>'text/plain',
            'mpeg'=>'text/plain',
            'zip'=>'application/zip',
            'ogg'=>'text/plain',
            'ods'=>'text/plain',
            'sxw'=>'text/plain',
            'ppt'=>'text/plain',
            'pps'=>'text/plain',
        );

        $p = explode('.', $file);
        $pc = count($p);

        //send headers
        header("Content-type: application/octet-stream\n");
        header("Content-disposition: attachment; filename=\"$file\"\n");
        header("Content-transfer-encoding: binary\n");
        header("Content-length: " . filesize($path) . "\n");

        //send file contents
        $fp=fopen($path, "r");
        fpassthru($fp);

        // disable layout and view
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
    }
    

}

