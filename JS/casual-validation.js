// Validates all the entries in the form
document.getElementById("casualForm").onsubmit = validateCasual;

function validateCasual()
{

    // Boolean used to track errors
    var isValid = true;

    // Clear all error messages
    var errors = document.getElementsByClassName("err");
    for (var i = 0; i < errors.length; i++)
    {
        errors[i].style.visibility = "hidden";
    }

    // Shows error message if first name field is left blank
    var platform = document.getElementById("platform").value;
    if(platform == "none")
    {

        var errPlat = document.getElementById("err-plat");
        errPlat.style.visibility = "visible";
        isValid = false;
    }

    // Shows error message if first name field is left blank
    var tag = document.getElementById("tag").value;
    if(tag == "")
    {

        var errTag = document.getElementById("err-tag");
        errTag.style.visibility = "visible";
        isValid = false;
    }

    var mode = document.getElementsByName("mode");
    var modeVal = "";
    for (var j = 0; j < mode.length; j++) {
        if (mode[j].checked) {
            modeVal = mode[j].value;
        }
    }

    if (modeVal == "")
    {
        var errMode = document.getElementById("err-mode");
        errMode.style.visibility = "visible";
        isValid = false;
    }

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

    // Returns the validation value
    return isValid;
}