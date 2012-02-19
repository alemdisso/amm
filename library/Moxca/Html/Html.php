<?php
class Moxca_Html_Html {

    public $chaveLembra;
    public $nomesSeries;
    public $nomesDiasSemana;
    public $nomesDiasSemanaCompleto;

    function __construct() {   
        $this->chaveLembra = "4SH4N1NK4"; //chave a ser acrescentada ao codUsuario para cookie de login

        $this->nomesSeries = array
            ( "6º Ano Ensino Fundamental" => "6º Ano Ensino Fundamental"
            , "7º Ano Ensino Fundamental" => "7º Ano Ensino Fundamental"
            , "8º Ano Ensino Fundamental" => "8º Ano Ensino Fundamental"
            , "9º Ano Ensino Fundamental" => "9º Ano Ensino Fundamental"
            , "1ª Série Ensino Médio" => "1ª Série Ensino Médio"
            , "2ª Série Ensino Médio" => "2ª Série Ensino Médio"
            , "3ª Série Ensino Médio" => "3ª Série Ensino Médio"
            , "EJA Educação de Jovens e Adultos" => "EJA Educação de Jovens e Adultos"
            );

        //ISO-8601 numeric representation of the day of the week
        $this->nomesDiasSemana = array
            ( "1" => "Segunda"
            , "2" => "Terça"
            , "3" => "Quarta"
            , "4" => "Quinta"
            , "5" => "Sexta"
            , "6" => "Sabado"
            , "7" => "Domingo"
            );

        $this->nomesDiasSemanaCompleto = array
            ( "1" => "Segunda-feira"
            , "2" => "Terça-feira"
            , "3" => "Quarta-feira"
            , "4" => "Quinta-feira"
            , "5" => "Sexta-feira"
            , "6" => "Sábado"
            , "7" => "Domingo"
            );

        $this->mesesCaixaBaixa = array (
            1 => "janeiro",
            2 => "fevereiro",
            3 => "março",
            4 => "abril",
            5 => "maio",
            6 => "junho",
            7 => "julho",
            8 => "agosto",
            9 => "setembro",
            10 => "outubro",
            11 => "novembro",
            12 => "dezembro",
            );

    }
    
    
    function breadcrumb($arrayLinks, $classLink, $classRegular="", $separator) {
        $thisSep = "";
        foreach ($arrayLinks as $item => $pagina) {
            if ($pagina) {
                $linhaBreadcrumb .= "$thisSep <a href='$pagina' class='$classLink'>$item</a>";
                $thisSep=$separator;
                
            } else {
                if ($classRegular) {
                    $linhaBreadcrumb .= "$thisSep<span class='$classRegular'>$item</span>";
                } else {
                    $linhaBreadcrumb .= "$thisSep $item";
                }
                $thisSep=$separator;
                
            }

        } // fecha foreach

        return($linhaBreadcrumb);

    } //breadcrumb


    function insertOption($value, $option, $encode, $selec) {
        if ($encode) {
            $option = htmlspecialchars($option);
        }

        if ($selec == $value) {
            $selec = " selected";
        } else {
            $selec = "";
        }

        if ($value != "")
            $value = " value = \"$value\" $selec";

        print ("<option$value>$option</option>\n");

    } //insertOption


    function limpaCampo($texto){
        //echo "LIMPA $texto<br/>";

        $limpo = str_replace(";","&#059;",$texto);
        //echo $limpo . "<BR>";

        //$limpo = str_replace("<","&lt;",$texto);
        //$limpo = str_replace(">","&gt;",$limpo);
        $limpo = str_replace("~","-",$limpo);
        //$limpo = str_replace("\"","&quot;",$limpo);
        //echo $limpo . "<BR>";

        //$limpo = str_replace("'","&#039;",$limpo);
        $limpo = stripslashes($limpo);
        //$limpo = str_replace("\r\n","<BR>",$limpo);
        $limpo = strip_tags($limpo, "<a><strong><i><em><b><ul><li><ol><p>");
        //echo $limpo . "<BR>";

        return ($limpo);
        
    } //limpaCampo


    function validaEntradaSimples($valor){
        //echo "LIMPA $texto<br/>";

	if (preg_match("/(%0A|%0D|\n+|\r+)/i", $valor)) {
            //echo "ABUSO $valor<br>";
            return (false);
	}

        $limpo = str_replace(";","&059;",$valor);
        //echo $limpo . "<BR>";

        $limpo = str_replace("~","-",$limpo);
        $limpo = str_replace("[","",$limpo);
        $limpo = str_replace("]","",$limpo);
        $limpo = str_replace("\"","&quot;",$limpo);
        $limpo = str_replace("'","&#039;",$limpo);
        $limpo = stripslashes($limpo);
        $limpo = strip_tags($limpo);
        $limpo = substr($limpo, 0, 250);
        //echo $limpo . "<BR>";

        return ($limpo);

    }

    
    function validaEntradaMultiline($valor){
        //echo "LIMPA $valor<br/>";

        if (preg_match("/(%0A|%0D|\n+|\r+)(content-type:|to:|cc:|bcc:)/i", $valor)) {
            //echo "ABUSO";

            return (false);

        }

        //$limpo = str_replace(";","&#059;",$valor);

        //$limpo = str_replace("~","-",$limpo);
        //$limpo = str_replace("\"","&quot;",$limpo);
        //$limpo = str_replace("'","&#039;",$limpo);
        
        $limpo = stripslashes($valor);
        //$limpo = stripslashes($limpo);

        $limpo = strip_tags($limpo, "<a><strong><i><em><b><ul><li><ol><p><blockquote>");
        $limpo = substr($limpo, 0, 250000);

        //echo $limpo . "<BR>";
        
        return ($limpo);
        
    }

    
    function validaFormacaoEmail($valor){
        return (preg_match('/^.+@.+\..{2,3}$/',$valor));
    }


    function sanitiza($titulo) {

        $a = "ÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝàáâãäçèéêëìíîïñòóôõöùúûüý";
        $b = "AAAAACEEEEIIIINOOOOOUUUUYaaaaaceeeeiiiinooooouuuuy";
        $titulo = utf8_decode($titulo);
        $titulo = strtr(trim($titulo), utf8_decode($a), $b);
        $titulo = strtolower($titulo);

        $tituloSugerido = ereg_replace("--", "-", ereg_replace("[^a-z0-9-]", "", ereg_replace(" ", "-", ereg_replace("_", "-", ereg_replace("%20", "-", strtolower($titulo))))));

        while (strpos($tituloSugerido, "--") !== false) {
            $tituloSugerido = ereg_replace("--", "-", $tituloSugerido);
        }

        //echo "LIMPOU ($tituloSugerido)<BR>";

        while (substr($tituloSugerido, 0, 1) == "-") {
            $tituloSugerido = substr($tituloSugerido, 1);
            //echo "TIRA - inicial ($tituloSugerido)<BR>";
        }

        while (substr($tituloSugerido, strlen($tituloSugerido) - 1, 1) == "-") {
            $tituloSugerido = substr($tituloSugerido, 0, strlen($tituloSugerido) - 1);
            //echo "TIRA - final ($tituloSugerido)<BR>";
        }

        //echo "SUG ($tituloSugerido)<BR>";

        return ($tituloSugerido);

    } //sanitiza


    function make_clickable($text) {
        // pad it with a space so we can match things at the start of the 1st line.
        $ret = " " . $text;

        // matches an "xxxx://yyyy" URL at the start of a line, or after a space.
        // xxxx can only be alpha characters.
        // yyyy is anything up to the first space, newline, or comma.
        $ret = preg_replace("#([\n ])([a-z]+?)://([^, \n\r]+)#i", "\\1<!-- BBCode auto-link start --><a href=\"\\2://\\3\" target=\"_blank\">\\2://\\3</a><!-- BBCode auto-link end -->", $ret);

        // matches a "www.xxxx.yyyy[/zzzz]" kinda lazy URL thing
        // Must contain at least 2 dots. xxxx contains either alphanum, or "-"
        // yyyy contains either alphanum, "-", or "."
        // zzzz is optional.. will contain everything up to the first space, newline, or comma.
        // This is slightly restrictive - it's not going to match stuff like "forums.foo.com"
        // This is to keep it from getting annoying and matching stuff that's not meant to be a link.
        $ret = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^, \n\r]*)?)#i", "\\1<!-- BBCode auto-link start --><a href=\"http://www.\\2.\\3\\4\" target=\"_blank\">www.\\2.\\3\\4</a><!-- BBCode auto-link end -->", $ret);

        // matches an email@domain type address at the start of a line, or after a space.
        // Note: before the @ sign, the only valid characters are the alphanums and "-", "_", or ".".
        // After the @ sign, we accept anything up to the first space, linebreak, or comma.
        $ret = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([^, \n\r]+)#i", "\\1<!-- BBcode auto-mailto start --><a href=\"mailto:\\2@\\3\">\\2@\\3</a><!-- BBCode auto-mailto end -->", $ret);

        // Remove our padding..
        $ret = substr($ret, 1);

        return($ret);

    }


    function recuperaDatasTrimestre($diaSemana, $dataInicio) {

        $arrDatas = Array();

        switch (date("n")) {
            case 1:
            case 2:
            case 3:
                $from = date("Y-m-d", strtotime(date("Y") . "-01-01"));
                $to = date("Y-m-d", strtotime(date("Y") . "-03-31"));
            break;

            case 4:
            case 5:
            case 6:
                $from = date("Y-m-d", strtotime(date("Y") . "-04-01"));
                $to = date("Y-m-d", strtotime(date("Y") . "-06-30"));
            break;

            case 7:
            case 8:
            case 9:
                $from = date("Y-m-d", strtotime(date("Y") . "-07-01"));
                $to = date("Y-m-d", strtotime(date("Y") . "-09-30"));
            break;

            case 10:
            case 11:
            case 12:
                $from = date("Y-m-d", strtotime(date("Y") . "-10-01"));
                $to = date("Y-m-d", strtotime(date("Y") . "-12-31"));
            break;
			
        }

        // getting number of days between two date range.
        $numDias = $this->contaDias(strtotime($from),strtotime($to));
        
        for ($i = 0; $i<=$numDias; $i++) {
            $novoDia = date("N", strtotime("+" . $i . " day", strtotime($from)));

            if ($novoDia == $diaSemana) {
                $dataCompleta = date("Y-m-d", strtotime("+" . $i . " day", strtotime($from)));

                $dataValida = true;

                if ($dataInicio) {
                    if (strtotime($dataCompleta) < strtotime(substr($dataInicio, 0, 10))) {
                        $dataValida = false;
                    }
                }

                if ($dataValida) {
                    $arrDatas[$dataCompleta] = $dataCompleta;
                }
                
            }

        }

        return ($arrDatas);

    } //recuperaDatasTrimestre


    function recuperaDatasAnteriores($diaSemana, $dataInicio, $dias=21) {
        $arrDatas = Array();

        $from = date("Y-m-d", strtotime("-" . $dias. " day", strtotime(date("Y-m-d"))));
        $to = date("Y-m-d 23:59:59");

        // getting number of days between two date range.
        $numDias = $this->contaDias(strtotime($from),strtotime($to));

        for ($i = 0; $i<$numDias; $i++) {
            $novoDia = date("N", strtotime("+" . $i . " day", strtotime($from)));

            if ($novoDia == $diaSemana) {
                $dataCompleta = date("Y-m-d", strtotime("+" . $i . " day", strtotime($from)));

                $dataValida = true;

                if ($dataInicio) {
                    if (strtotime($dataCompleta) < strtotime(substr($dataInicio, 0, 10))) {
                        $dataValida = false;
                    }
                }

                if ($dataValida) {
                    $arrDatas[$dataCompleta] = $dataCompleta;
                }

            }

        }

        return ($arrDatas);

    } //recuperaDatasAnteriores


    function recuperaProximasDatas($diaSemana, $dataInicio, $dias=21) {
        $arrDatas = Array();

        $from = date("Y-m-d");
        $to = date("Y-m-d 23:59:59", strtotime("+" . $dias . " day", strtotime(date("Y-m-d"))));

        // getting number of days between two date range.
        $numDias = $this->contaDias(strtotime($from),strtotime($to));

        for ($i = 0; $i<=$numDias; $i++) {
            $novoDia = date("N", strtotime("+" . $i . " day", strtotime($from)));

            if ($novoDia == $diaSemana) {
                $dataCompleta = date("Y-m-d", strtotime("+" . $i . " day", strtotime($from)));

                $dataValida = true;

                if ($dataInicio) {
                    if (strtotime($dataCompleta) < strtotime(substr($dataInicio, 0, 10))) {
                        $dataValida = false;
                    }
                }

                if ($dataValida) {
                    $arrDatas[$dataCompleta] = $dataCompleta;
                }

            }

        }

        return ($arrDatas);

    } //recuperaProximasDatas


    function recuperaProximasDatasComHora($diaSemana, $dataInicio, $dias=21) {
        $arrDatas = Array();

        $from = date("Y-m-d H:i:s");
        $to = date("Y-m-d 23:59:59", strtotime("+" . $dias . " day", strtotime(date("Y-m-d"))));

        // getting number of days between two date range.
        $numDias = $this->contaDias(strtotime($from),strtotime($to));

        for ($i = 0; $i<=$numDias; $i++) {
            $novoDia = date("N", strtotime("+" . $i . " day", strtotime($from)));

            if ($novoDia == $diaSemana) {
                $dataCompleta = date("Y-m-d H:i:s", strtotime("+" . $i . " day", strtotime($from)));

                $dataValida = true;

                if ($dataInicio) {
                    if (strtotime($dataCompleta) < strtotime($dataInicio)) {
                        $dataValida = false;
                    }
                }

                if ($dataValida) {
                    $arrDatas[$dataCompleta] = $dataCompleta;
                }

            }

        }

        return ($arrDatas);

    } //recuperaProximasDatasComHora


    function recuperaDatasEspecificas($diaSemana, $dataInicio, $inicio, $termino) {
        $arrDatas = Array();

        $from = $inicio;
        $to = $termino;

        // getting number of days between two date range.
        $numDias = $this->contaDias(strtotime($from),strtotime($to));

        for ($i = 0; $i<=$numDias; $i++) {
            $novoDia = date("N", strtotime("+" . $i . " day", strtotime($from)));

            if ($novoDia == $diaSemana) {
                $dataCompleta = date("Y-m-d", strtotime("+" . $i . " day", strtotime($from)));

                $dataValida = true;

                if ($dataInicio) {
                    if (strtotime($dataCompleta) < strtotime(substr($dataInicio, 0, 10))) {
                        $dataValida = false;
                    }
                }

                if ($dataValida) {
                    $arrDatas[$dataCompleta] = $dataCompleta;
                }

            }

        }

        return ($arrDatas);

    } //recuperaDatasEspecificas


    function recuperaProximaDataDiaSemana($diaSemana) {
        $hoje = date("Y-m-d");

        for ($i = 1; $i<=7; $i++) {
            $proximoDia = date("N", strtotime("+" . $i . " day", strtotime($hoje)));

            if ($proximoDia == $diaSemana) {
                $proximaData = date("Y-m-d", strtotime("+" . $i . " day", strtotime($hoje)));
                break;
            }

        }

        return ($proximaData);

    } //recuperaProximaDataDiaSemana


    function contaDias($a, $b) {
        //break dates into their constituent parts
        $gd_a = getdate($a);
        $gd_b = getdate($b);

        //recreate timestamps, based upon noon on each day
        //the specific time doesn't matter but it must be the same each day
        $a_new = mktime(12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year']);
        $b_new = mktime(12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year']);

        //subtract these two numbers and divide by the number of seconds in a
        //day. Round the result since crossing over a daylight savings time
        //barrier will cause this time to be off by an hour or two.
        return round(abs($a_new - $b_new) / 86400);

    }


    function retornaDatas($diaSemana, $horario, $dataInferior, $dataSuperior) {
        $arrDatas = Array();

        // getting number of days between two date range.
        $numDias = $this->contaDias(strtotime($dataInferior),strtotime($dataSuperior));

        for ($i = 0; $i<=$numDias; $i++) {
            $novoDia = date("N", strtotime("+" . $i . " day", strtotime($dataInferior)));

            if ($novoDia == $diaSemana) {
                $dataCompleta = date("Y-m-d H:i:s", strtotime("+" . $i . " day", strtotime(substr($dataInferior, 0, 10) . " " . $horario)));

                $dataValida = true;

                if (strtotime($dataCompleta) < strtotime($dataInferior)) {
                    $dataValida = false;
                }

                if (strtotime($dataCompleta) > strtotime($dataSuperior)) {
                    $dataValida = false;
                }

                if ($dataValida) {
                    $arrDatas[$dataCompleta] = $dataCompleta;
                }

            }

        }

        return ($arrDatas);

    } //retornaDatas


    function retornaDatasAnteriores($dias=5) {
        $arrDatas = Array();

        for ($i = 0; $i<$dias; $i++) {
            $dataCompleta = date("Y-m-d", strtotime("-" . $i . " day", strtotime(date("Y-m-d"))));

            $arrDatas[] = $dataCompleta;
        }

        return ($arrDatas);

    } //retornaDatasAnteriores


    function rotuloTamanho($tamanho) {
        if ($tamanho < 1024) {
            $unidade = " bytes";

	} elseif ($tamanho < 1048576) {
            $unidade = " Kb";
            $tamanho = round($tamanho / 1024, 0);

	} else {
            $unidade = " Mb";
            $tamanho = round($tamanho / 1048576, 1);

	}

	$texto = $tamanho . $unidade;

	return($texto);

    }


}