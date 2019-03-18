<?php
/**
 * Created by PhpStorm.
 * User: sammgabriel
 * Date: 2019-03-18
 * Time: 11:16
 */

/**
 *
 * Validates name
 * Checks if the entry is alphabetic
 *
 * Referred to the PHP documentation to determine how to validate
 * if an entry is alphabetic
 *
 * @param $tag
 * @return bool
 *
 */
function validTag($tag) {

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
function validHeroes($heroes) {

    global $f3;
    return in_array($heroes, $f3->get('heroes'));
}