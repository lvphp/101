<?php
require_once 'meetup.php';
/**
 * Config Data - Could be in a config file.
 */
$group = '1773780'; //got this from meetup
$key = getenv('API_KEY'); //this is set in .htaccess 

//get some data from meetup
$meetup = new Meetup($key);
$groupData = $meetup->getGroup($group);

//simple render of template
ob_start();
include 'index.phtml';
$output = ob_get_clean();

echo $output;
