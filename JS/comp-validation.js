/*

    Author Name: Sam Gabriel, Nic Alexander
    Date: March 20, 2019
    File Name: comp-validation.js

    This is the JavaScript validation for the Competitive player form.

 */

// Validates all the entries in the competitive form
document.getElementById("compForm").onsubmit = validateComp;

function validateComp()
{

    // Boolean used to track errors
    var isValid = true;

    // Clear all error messages
    var errors = document.getElementsByClassName("err");
    for (var i = 0; i < errors.length; i++)
    {
        errors[i].style.visibility = "hidden";
    }

    // Shows error message if a platform has not been chosen
    var platform = document.getElementById("platform").value;
    if(platform == "none")
    {

        var errPlat = document.getElementById("err-plat");
        errPlat.style.visibility = "visible";
        isValid = false;
    }

    // Shows error message if tag has been left blank
    var tag = document.getElementById("tag").value;
    if(tag == "")
    {

        var errTag = document.getElementById("err-tag");
        errTag.style.visibility = "visible";
        isValid = false;
    }

    // Shows error message if a rank has not been chosen
    var rank = document.getElementsByName("rank");
    var rankVal = "";
    for (var j = 0; j < rank.length; j++) {
        if (rank[j].checked) {
            rankVal = rank[j].value;
        }
    }

    if (rankVal == "")
    {
        var errRank = document.getElementById("err-rank");
        errRank.style.visibility = "visible";
        isValid = false;
    }

    // Shows error message if heroes have not been chosen
    var heroes = document.getElementsByName("heroes[]");
    var heroVals = [];

    for (var k = 0; k < heroes.length; k++) {

        if (heroes[k].checked) {

            heroVals.push(heroes[k]);
        }
    }

    if (heroVals.length == 0) {

        var errHeroes = document.getElementById("err-heroes");
        errHeroes.style.visibility = "visible";
        isValid = false;
    }

    // Shows error message if ideal teammates have not been chosen
    var idealPairs = document.getElementsByName("heroes2[]");
    var pairVals = [];

    for (var k = 0; k < idealPairs.length; k++) {

        if (idealPairs[k].checked) {

            pairVals.push(idealPairs[k]);
        }
    }

    if (pairVals.length == 0) {

        var errPairs = document.getElementById("err-pairs");
        errPairs.style.visibility = "visible";
        isValid = false;
    }

    // Returns the validation value
    return isValid;
}