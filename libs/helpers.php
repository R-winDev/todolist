<?php defined("BASE_PATH") OR die("Access Denied!");

function getConfig()
{

}

function isAjaxRequest()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) 
    {
        return true;
    }
    
    return false;
}


function siteUrl($uri = null)
{
    return BASE_URL . $uri;
}
function diePage($msg)
{
    echo "<div style='
    border: 1px solid;
    margin: 10px 0px;
    padding: 15px 10px 15px 50px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #D8000C;
    background-color: #FFBABA;
    '>".$msg."</div>";
    die();
}

function dd ($var)
{
    echo "<pre style = '
    font-size: 16px;
    font-weight: 400;
    color: #fff;
    background: #555 !important;
    padding: 16px !important;
    border-left: 8px solid #8d8d8d;
    border-radius: 10px !important;
    position: relative;
    display: inline-block !important;
    box-shadow: 1px 1px 1px #aaaaaa;
    margin-top: 10px;'>";
    var_dump($var);
    echo "</pre>";
    die();
}