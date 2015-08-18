<?php
date_default_timezone_set('Europe/Kiev');
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_STRICT);
$link = mysqli_connect("localhost", "root", "admin", "yiiapp3");
if ($link === false) {die('ERROR: Could not connect. ' . mysqli_connect_error());}
mysqli_set_charset($link, 'utf8');
//---------------
echo "Started  at: " . date('H:i:s', time()) . "<br>";

    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');
    $content[] = file_get_contents('http://loripsum.net/api/1/verylong');

    for($i = 145594; $i <= 219707; $i++) {
        $randInd = mt_rand(0,10);
        $text = $content[$randInd];
        $randNum = mt_rand(1,4528);
        //-----
        $sql = "UPDATE `yiiapp3`.`tbl_books` SET `description` = '$text' , "
            ." `rating` = $randNum WHERE `book_id` = $i ;";
        if (mysqli_query($link, $sql)) {

        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link) . '<br>';
        }
    }
echo "Finished  at: " . date('H:i:s', time()) . "<br>";
//----------



//    $newCityId = 210; //
//    $citiesToChange = array(686);
//echo 'count='.count($citiesToChange).'<br>';
//
//foreach($citiesToChange as $city) {
//    $sql1 = "UPDATE `yiiapp3`.`tbl_publishing_houses` SET `city` = $newCityId WHERE `city` = $city ";
//    if (mysqli_query($link, $sql1)) {
//        $sql2 = "DELETE FROM `yiiapp3`.`tbl_cities` WHERE `tbl_cities`.`city_id` = $city ";
//        if (mysqli_query($link, $sql2)) {
//
//        } else {
//            echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link) . '<br>';
//        }
//    } else {
//        echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link) . '<br>';
//    }
//
//    //-----------------
//
//}


//------------------
echo '---DONE---'.'<br>';
mysqli_close($link);
?>
