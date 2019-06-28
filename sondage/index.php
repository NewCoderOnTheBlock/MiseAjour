<?php

if(!isset($_GET['lang']))
    include('fr.sondage.php');
else
{
    if($_GET['lang'] == 'fr')
        include('fr.sondage.php');
    else
        include('en.sondage.php');
}