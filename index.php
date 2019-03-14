<?php

//turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload
require_once('vendor/autoload.php');

//create and instance of the Base class
$f3 = Base::instance();
//turn on fat free error reporting
$f3->set('DEBUG',3);

$f3->set('heroes', array(
    "Ana",
    "Ashe",
    "Baptiste",
    "Bastion",
    "Brigitte",
    "D.Va",
    "Doomfist",
    "Genji",
    "Hanzo",
    "Junkrat",
    "Lucio",
    "McCree",
    "Mei",
    "Mercy",
    "Moira",
    "Orisa",
    "Pharah",
    "Reaper",
    "Reinhardt",
    "Roadhog",
    "Soldier: 76",
    "Sombra",
    "Symmetra",
    "Torbjorn",
    "Tracer",
    "Widowmaker",
    "Winston",
    "Wrecking Ball",
    "Zarya",
    "Zenyatta"
));

$f3->set('platform', array("Xbox", "Playstation", "PC"));

//define a default route
$f3->route('GET /', function(){

    $template = new Template();
    echo $template->render('views/home.html');
});

//define a default route
$f3->route('GET|POST /casual', function($f3){

    $f3->set('modes', array("Quick Play"=>"Quick Play" ,
        "Arcade"=>"Arcade", "No Preference"=>"Casual"));

    $template = new Template();
    echo $template->render('views/casual.html');
});

//define a default route
$f3->route('GET|POST /competitive', function($f3){

    $f3->set('ranks', array(
        "Not Ranked",
        "Bronze",
        "Silver",
        "Gold",
        "Platinum",
        "Diamond",
        "Master",
        "Grandmaster"
    ));

    $template = new Template();
    echo $template->render('views/competitive.html');
});


//run fat free
$f3->run();