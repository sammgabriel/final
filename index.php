<?php

//turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload
require_once('vendor/autoload.php');
require_once ('model/validation.php');
session_start();

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
$f3->route('GET|POST /', function($f3){

    if(isset($_POST['submit'])) {

        if(!isset($_POST['type'])) {

            $f3->set("errors['type']", "Please select a game type.");
        }

        else {

            if ($_POST['type'] == "Casual") {

                $f3->reroute("/casual");
            }

            else {

                $f3->reroute("/competitive");
            }
        }
    }

    $template = new Template();
    echo $template->render('views/home.html');
});

//define a default route
$f3->route('GET|POST /casual', function($f3){

    $f3->set('modes', array("Quick Play"=>"Quick Play" ,
        "Arcade"=>"Arcade", "No Preference"=>"Casual"));

    //when the user clicks submit
    if (isset($_POST['submit']))
    {


        $hero = $_POST['hero'];

        if (isset($_POST['platform']))
        {
            print_r($_POST);
            print_r($_SESSION);

            if ($_POST['platform'])
            {
                $platform = $_POST['platform'];
                $_SESSION = $platform;
            }
            else
            {
                $f3->set("errors['platform']", "Please choose a platform");
            }

        }
        if (isset($_POST['tag'])) {
            if ($_POST['tag'])
            {
                $tag = $_POST['tag'];
                $_SESSION = $tag;
            }
            else
            {
                $f3->set("errors['tag']", "Please put in your tag");
            }
        }

        if (empty($_POST['mode']))
        {

            if ($_POST['mode'])
            {
                $mode = $_POST['mode'];

            }
            else
            {
                $f3->set("errors['mode']", "Please choose a mode");
            }
        }

        if (empty($_POST['heroes']))
        {
            echo "<p>here</p>";
            if ($_POST['heroes'] == "Ana")
            {
                echo "<p>fuck</p>";
                $heroes = $_POST['heroes'];

            }
            else
            {
                $f3->set("errors['hero']", "Please choose at least one hero");
            }

        }

    }
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

    if(isset($_POST['submit'])) {

        $f3->reroute("/summary");
    }

    $template = new Template();
    echo $template->render('views/competitive.html');
});

//define a default route
$f3->route('GET|POST /gamers', function(){

    $template = new Template();
    echo $template->render('views/all-gamers.html');
});

//define a default route
$f3->route('GET|POST /summary', function(){

    $template = new Template();
    echo $template->render('views/summary.html');
});

//run fat free
$f3->run();