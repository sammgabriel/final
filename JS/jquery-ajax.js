/*

    Author Name: Sam Gabriel, Nic Alexander
    Date: March 20, 2019
    File Name: jquery-ajax.js

    This is the JavaScript file for any jQuery functions.

 */

// Reveals options when user clicks "Join" in the home page
$(document).ready(function(){

    $("a#create").on("click", function(){

        $("#gameType").fadeIn("slow");
    });
});
