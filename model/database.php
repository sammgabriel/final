<?php

require '/home/nalexand/config.php';

//require("/home/sgabriel/config.php");

//connect to database
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

function insertPlayer($platform, $tag, $modes, $heros, $pair, $rank, $type)
{
    global $dbh;

    //define the query
    $sql = "INSERT INTO final (platform, tag, modes, heros, pair, rank, type) 
      VALUES (:platform, :tag, :modes, :heros, :pair, :rank, :type)";

    //prepare the statement
    $statement = $dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':platform', $platform, PDO::PARAM_STR);
    $statement->bindParam(':tag', $tag, PDO::PARAM_STR);
    $statement->bindParam(':modes', $modes,PDO::PARAM_STR);
    $statement->bindParam(':heros', $heros, PDO::PARAM_STR);
    $statement->bindParam(':pair', $pair, PDO::PARAM_STR);
    $statement->bindParam(':rank', $rank, PDO::PARAM_STR);
    $statement->bindParam(':type', $type, PDO::PARAM_STR);

    //execute the statement
    $success = $statement->execute();

    //return the result
    return $success;
}




function getPlayers($type)
{
    //grab the database object
    global $dbh;

    //Define the query
    $sql = "SELECT * FROM final WHERE type = :type";

    //prepare the statement
    $statement = $dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':type', $type, PDO::PARAM_STR);

    //execute
    $statement->execute();

    //process the result
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row;
}