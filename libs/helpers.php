<?php 

function getConfig()
{

}

function getCurrentUrl()
{

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