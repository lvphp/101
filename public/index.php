<?php
require_once '../vendor/autoload.php';

require_once 'meetup.php';
/**
 * Config Data - Could be in a config file.
 */
$group = '1773780'; //got this from meetup
$key = getenv('API_KEY'); //this is set in .htaccess 

//get some data from meetup
$meetup = new Meetup($key);
$groupData = $meetup->getGroup($group);

//render with mustache
$mustache = new Mustache_Engine;

$template = file_get_contents('index.phtml');
echo $mustache->render($template, array('group' => $groupData));
