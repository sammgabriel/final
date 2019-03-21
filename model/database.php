<?php

/**
 *
 * Author Name: Sam Gabriel, Nic Alexander
 * Date: March 20, 2019
 * File Name: Casual.php
 *
 * Casual player class
 *
 */

// Database configuration file
require '/home/nalexand/config.php';

//connect to database
/**
 *
 * Connect to the database
 *
 * @return PDO|void
 */
function connect()
{

    try
    {
        //instantiate a database object
        $dbh = new PDO(DB_DSN, DB_USERNAME,
            DB_PASSWORD);
        return $dbh;

    } catch (PDOException $e)
    {
        echo $e->getMessage();
        return;
    }
}

/**
 *
 * Inserts a player into the database
 *
 * @param $platform
 * @param $tag
 * @param $modes
 * @param $heros
 * @param $pair
 * @param $rank
 * @param $type
 * @return bool
 */
function insertPlayer($platform, $tag, $modes, $heros, $pair, $rank, $type)
{
    global $dbh;

    //define the query
    $sql = "INSERT INTO final (platform, tag, modes, heros, pair, rank, type) 
      VALUES (:platform, :tag, :modes, :heros, :pair, :rank, :type)";

    //prepare the statement
    $statement = $dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':platform', $platform,
        PDO::PARAM_STR);
    $statement->bindParam(':tag', $tag,
        PDO::PARAM_STR);
    $statement->bindParam(':modes', $modes,
        PDO::PARAM_STR);
    $statement->bindParam(':heros', $heros,
        PDO::PARAM_STR);
    $statement->bindParam(':pair', $pair,
        PDO::PARAM_STR);
    $statement->bindParam(':rank', $rank,
        PDO::PARAM_STR);
    $statement->bindParam(':type', $type,
        PDO::PARAM_STR);

    //execute the statement
    $success = $statement->execute();

    //return the result
    return $success;
}

/**
 *
 * Displays all competitive players
 *
 * @return array
 */
function getComp()
{
    //grab the database object
    global $dbh;

    //Define the query
    $sql = "SELECT * FROM final WHERE type = 'competitive'";

    //prepare the statement
    $statement = $dbh->prepare($sql);

    //execute
    $statement->execute();

    //process the result
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Return rows from the database
    return $row;
}

/**
 *
 * Displays everyone in the database
 *
 * @return array
 */
function getAll()
{
    //grab the database object
    global $dbh;

    //Define the query
    $sql = "SELECT * FROM final";

    //prepare the statement
    $statement = $dbh->prepare($sql);

    //execute
    $statement->execute();

    //process the result
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Return rows from the database
    return $row;
}

/**
 *
 * Displays all casual players
 *
 * @return array
 */
function getCasual()
{
    //grab the database object
    global $dbh;

    //Define the query
    $sql = "SELECT * FROM final  WHERE type = 'casual'";

    //prepare the statement
    $statement = $dbh->prepare($sql);

    //execute
    $statement->execute();

    //process the result
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Return rows from the database
    return $row;
}