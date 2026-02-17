<?php

use Models\Lang;
use Models\User;

function send($response)
{
    exit(json_encode($response));
}

function sendResult($result)
{
    $response = array();
    $response['type'] = 'OK';
    $response['cf_token'] = cf_token();
    $response['data'] = $result;
    send($response);
}

function sendError($msg, $code = null)
{
    $response = array();
    $response['type'] = 'ERR';
    $response['msg'] = $msg;
    $response['code'] = $code;
    send($response);
}

if (Request::isPost()) {
    if (!isset($_POST['op']))
        sendError('', 13);

    switch ($_POST['op']) {
        
        case 'save-ordre-global':
            $class = '\\Models\\' . $_POST['class'];
            // $ordres = json_decode($_POST['ordres']);
            $ordres = $_POST['ordres'];
            foreach ($ordres as $id => $ordre) {
                if (!$id)
                    continue;
                $id = explode(',', $id);
                $obj = new $class($id);
                $obj->set('Ordre', $ordre)->save();
            }
            sendResult(array('OK'));
        break;
        case '':
            
        break;
        default:
            sendError('Opération demandé invalide', 14);
    }
} else {
    if (!isset($_GET['op']))
        sendError('Aucune opération demandée', 11);
    
    switch ($_GET['op']) {
        case 'change-lang':
            $lang = $_GET['lang'];
            Models\Lang::current($lang);
        sendResult(array('changed'));
        break;
        case 'change-lang':
            $collaborateur = new Models\Collaborateur($_GET['collaborateur']);
            sendResult(array('changed'));
        break;
        case 'generate-alias':
            $result = array();
            $label = $_GET['label'];
            $result['alias'] = Tools::getAlias($label);
        sendResult($result);
        default: 
            sendError('Opération demandé invalide', 11);
        break;
        
    }
}
sendError('Aucune opération demandé', 10);
