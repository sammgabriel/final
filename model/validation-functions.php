<?php
/**
 *
 * Author Name: Sam Gabriel, Nic Alexander
 * Date: March 20, 2019
 * File Name: validation-functions.php
 *
 * PHP validation functions
 *
 */

/**
 *
 * Validates name
 * Checks if the entry is alphanumeric
 *
 * Referred to the PHP documentation to determine how to validate
 * if an entry is alphanumeric
 *
 * @param $tag
 * @return bool
 *
 */
function validTag($tag)
{

    return ctype_alnum($tag);
}

/**
 *
 * Validates hero choices
 * Checks for spoofing
 *
 * @param $heroes
 * @return bool
 *
 */
function validHeroes($heroes)
{

    global $f3;
    return in_array($heroes, $f3->get('heroes'));
}