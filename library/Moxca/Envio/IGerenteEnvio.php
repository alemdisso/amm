<?php
interface Moxca_Envio_IGerenteEnvio {

    function retornaEnvioVazio();

    function enviaAtivacaoConta(Moxca_Envio_Envio $obj);

    function enviaRenovacaoSenha(Moxca_Envio_Envio $obj);

}