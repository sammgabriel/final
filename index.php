<?php

/**
 *
 * Author Name: Sam Gabriel, Nic Alexander
 * Date: March 20, 2019
 * File Name: index.php
 *
 * Setting up Fat-Free and URL Routing
 *
 */

//turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload
require_once('vendor/autoload.php');
require_once ('model/validation-functions.php');
require_once ('model/database.php');

// session start
session_start();

//create and instance of the Base class
$f3 = Base::instance();
//turn on fat free error reporting
$f3->set('DEBUG',3);

//Connect to the database
$dbh = connect();

// variables
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

$heroes2 = array(
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
$f3->set('heroes2', $heroes2);

$platform = array("Xbox", "Playstation", "PC");

$f3->set('platform', $platform);

//define a default route
$f3->route('GET|POST /', function($f3)
{

    // when the user clicks submit
    if(isset($_POST['submit'])) {

        if(!isset($_POST['type'])) {

            // Displays an error if a choice was not made
            $f3->set("errors['type']", "Please select a game type.");

        } else {

            // Reroutes user depending on his or her choice
            $f3->set("type",$_POST['type']);

            if ($_POST['type'] == "Casual") {

                $f3->reroute("/casual");

            } else {

                $f3->reroute("/competitive");
            }
        }
    }

    $template = new Template();
    echo $template->render('views/home.html');
});

//define a casual form route
$f3->route('GET|POST /casual', function($f3)
{

    // variables
    $isValid = true;
    $_SESSION['heroes'] = array();

    // modes array
    $modes = array("Quick Play", "Arcade", "No Preference");

    $f3->set('modes', $modes);

    //when the user clicks submit
    if (isset($_POST['submit'])) {

        if (empty($_POST['platform'])) {

            // Displays an error if a choice was not made
            $f3->set("errors['platform']", "Please pick a platform");
            $isValid = false;
        }

        else {

            // Saves choice
            $f3->set('choice', $_POST['platform']);
        }

        if (isset($_POST['tag'])) {

            // validates tag
            if (validTag($_POST['tag'])) {

                // Saves choice
                $_SESSION['tag'] = $_POST['tag'];

            } else {

                // otherwise, displays an error
                $f3->set("errors['tag']", "Please enter a valid tag");
                $isValid = false;
            }
        }

        if (empty($_POST['mode'])) {

            // Displays an error if a choice was not made
            $f3->set("errors['mode']", "Please choose a mode");
            $isValid = false;

        } else {

            // Saves choice
            $f3->set('choice', $_POST['mode']);
        }

        // if the user picks heroes
        if (isset($_POST['heroes'])) {

            // validates the user's choices
            foreach ($_POST['heroes'] as $hero) {

                if (!validHeroes($hero)) {

                    // Displays an error is choices are invalid
                    $f3->set("errors['hero']", "Please choose valid heroes.");
                    $isValid = false;
                }
            }

            // Otherwise saves choices
            $_SESSION['heroes'] = $_POST['heroes'];
            $f3->set('choices', $_SESSION['heroes']);
            $choices = implode(", ", $_POST['heroes']);

        } else {

            // Displays an error if no heroes were chosen
            $f3->set("errors['hero']", "Please choose valid heroes.");
            $isValid = false;
        }

        if ($isValid) {

            // Creates a new casual player object
            $casual = new Casual($_POST['platform'], $_POST['tag'], $choices, $_POST['mode']);

            // Adds it to the database
            $success = insertPlayer($casual->getPlatform(), $casual->getTag(),
                $casual->getGameMode(), $casual->getHeroes() , "", "", "casual");

            if ($success) {

                // Reroutes to casual summary page
                $f3->reroute('/summary');
            }
        }
    }

    $template = new Template();
    echo $template->render('views/casual.html');
});

//define a competitive form route
$f3->route('GET|POST /competitive', function($f3)
{

    // rank array
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

    // variables
    $isValid = true;
    $_SESSION['heroes'] = array();
    $_SESSION['heroes2'] = array();

    //when the user clicks submit
    if (isset($_POST['submit'])) {

        if (empty($_POST['platform'])) {

            // Displays an error if platform was not chosen
            $f3->set("errors['platform']", "Please pick a platform");
            $isValid = false;
        }

        else {

            // Saves choice
            $f3->set('choice', $_POST['platform']);
        }

        if (isset($_POST['tag'])) {

            // validates tag
            if (validTag($_POST['tag'])) {

                // saves entry
                $_SESSION['tag'] = $_POST['tag'];

            } else {

                // Otherwise displays an error
                $f3->set("errors['tag']", "Please enter a valid tag");
                $isValid = false;
            }
        }

        if (empty($_POST['rank'])) {

            // Displays an error if no choice was made
            $f3->set("errors['rank']", "Please choose your rank (don't lie we will find out)");
            $isValid = false;

        } else {

            // Saves choice
            $f3->set('rankChoice', $_POST['rank']);
        }

        // if the user picks heroes
        if (isset($_POST['heroes'])) {

            // validates the user's choices
            foreach ($_POST['heroes'] as $hero) {

                if (!validHeroes($hero)) {

                    $f3->set("errors['hero']", "Please choose valid heroes.");
                    $isValid = false;
                }
            }

            // Otherwise saves choices
            $_SESSION['heroes'] = $_POST['heroes'];
            $f3->set('choices', $_SESSION['heroes']);
            $choices2 = implode(", ", $_POST['heroes']);

        } else {

            // Displays an error if the user made no choices
            $f3->set("errors['hero']", "Please choose valid heroes.");
            $isValid = false;
        }

        if (isset($_POST['heroes2'])) {

            // validates the user's choices
            foreach ($_POST['heroes2'] as $hero2) {

                if (!validHeroes($hero2)) {

                    // Otherwise, displays an error
                    $f3->set("errors['hero2']", "Please choose valid heroes.");
                    $isValid = false;
                }
            }

            // Saves the array of choices
            $_SESSION['heroes2'] = $_POST['heroes2'];
            $f3->set('choices2', $_SESSION['heroes2']);
            $choices = implode(", ", $_POST['heroes2']);

        } else {

            // Otherwise, displays an error if the user made no choices
            $f3->set("errors['hero2']", "Please choose valid heroes.");
            $isValid = false;
        }

        if ($isValid) {

            // Creates a new ranked player object
            $ranked = new Ranked($_POST['platform'], $_POST['tag'],
                $_POST['rank'],"", $choices, $choices2);

            // Adds it to the database
            $success = insertPlayer($ranked->getPlatform(), $ranked->getTag(), "",
                $ranked->getRank() , $ranked->getIdealPairs(), $ranked->getHeroes(),
                "competitive");

            if ($success) {

                // Reroutes to competitive summary page
                $f3->reroute('/summary2');
            }
        }
    }

    $template = new Template();
    echo $template->render('views/competitive.html');
});

//define an all gamers route
$f3->route('GET|POST /gamers', function($f3)
{

    // Displays all players in the database
    $players = getAll();
    $f3->set('players', $players);

    $template = new Template();
    echo $template->render('views/all-gamers.html');
});

//define a casual summary route
$f3->route('GET|POST /summary', function($f3)
{

    // Displays all casual gamers
    $players = getCasual();
    $f3->set('players', $players);

    $template = new Template();
    echo $template->render('views/summary.html');
});

//define a competitive summary route
$f3->route('GET|POST /summary2', function($f3)
{

    // Displays all competitive players
    $players = getComp();
    $f3->set('players', $players);

    $template = new Template();
    echo $template->render('views/summary2.html');
});

//run fat free
$f3->run();