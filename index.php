<?php

//turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload
require_once('vendor/autoload.php');
require_once ('model/validation-functions.php');
require_once ('model/database.php');
session_start();

//create and instance of the Base class
$f3 = Base::instance();
//turn on fat free error reporting
$f3->set('DEBUG',3);

//Connect to the database
$dbh = connect();

$heroes = array(
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
);

$f3->set('heroes', $heroes);

$platform = array("Xbox", "Playstation", "PC");

$f3->set('platform', $platform);

//define a default route
$f3->route('GET|POST /', function($f3){

    if(isset($_POST['submit'])) {

        if(!isset($_POST['type'])) {

            $f3->set("errors['type']", "Please select a game type.");
        }

        else {
            $f3->set("type",$_POST['type']);

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
$f3->route('GET|POST /casual', function($f3) {

    $isValid = true;

    $_SESSION['heroes'] = array();

    $modes = array("Quick Play", "Arcade", "No Preference");

    $f3->set('modes', $modes);

    //when the user clicks submit
    if (isset($_POST['submit']))
    {

        if (empty($_POST['platform']))
        {

            $f3->set("errors['platform']", "Please pick a platform");
            $isValid = false;

        }

        else {

            $f3->set('choice', $_POST['platform']);
        }

        if (isset($_POST['tag']))
        {

            // validates tag
            if (validTag($_POST['tag']))
            {
                // creates a session variable if entry is valid
                $_SESSION['tag'] = $_POST['tag'];
            } else
            {
                // otherwise, displays an error
                $f3->set("errors['tag']", "Please enter a valid tag");
                $isValid = false;
            }
        }

        if (empty($_POST['mode']))
        {

            $f3->set("errors['mode']", "Please choose a mode");
            $isValid = false;

        } else
        {

            $f3->set('choice', $_POST['mode']);
        }

        // if the user picks heroes
        if (isset($_POST['heroes']))
        {
            // validates the user's choices
            foreach ($_POST['heroes'] as $hero)
            {
                if (!validHeroes($hero))
                {
                    // Otherwise, displays an error
                    $f3->set("errors['hero']", "Please choose valid heroes.");
                    $isValid = false;
                }
            }

            $_SESSION['heroes'] = $_POST['heroes'];
            $f3->set('choices', $_SESSION['heroes']);
            $choices = implode(", ", $_POST['heroes']);

        } else {

            // Otherwise, displays an error
            $f3->set("errors['hero']", "Please choose valid heroes.");
            $isValid = false;
        }

        if ($isValid) {

            $casual = new Casual($_POST['platform'], $_POST['tag'], $choices, $_POST['mode']);

            $success = insertPlayer($casual->getPlatform(), $casual->getTag(),
                $casual->getHeroes() ,$casual->getGameMode(), "", "", "casual");

            if ($success)
            {
                $f3->reroute('/summary');
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