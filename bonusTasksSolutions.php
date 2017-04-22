<?php

/**
 * Bonus task #1
 * (foobardoo) Consider the following code
 */

//$str1 = 'foobardoo';
//$str2 = 'foo';
//if (strpos($str1,$str2)) {
//  echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
//} else {
//  echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
//}

//ANSWER
//=========================================================================================
//strpos function will return the position of string. In this case, it will return "0"
//So we can rewrite as follow,
//
//$str1 = 'foobardoo';
//$str2 = 'foo';
//if (strpos($str1, $str2)!== false) {
//    echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
//} else {
//    echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
//}
//=========================================================================================


/**
 * Bonus task #2
 * How many elements contain the $_POST data after executing this request and why?
 */


//// js
//$.ajax({
//    url: 'http://my.site/some/path',
//    method: 'post',
//    data: JSON.stringify({a: 'a', b: 'b'}),
//    contentType: 'application/json'
//});


//ANSWER
//=========================================================================================
//Here content type is application/json. So $_POST will not receive any values.
//But, we can receive json values as below,
//$data = json_decode(file_get_contents('php://input'), true);
//=========================================================================================



/**
 * Bonus task #3
 * (Bread with butte) Solve the statement. Write down your solution.
 */

// A bread with butter cost 1.10 €. The bread is 1€ more expensive then the butter.
//
// How much does the butter cost?

// 0.05€   (0.05 + (0.05 + 1 more))
