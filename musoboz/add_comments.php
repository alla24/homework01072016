<?php
/**
 * Created by PhpStorm.
 * User: rus
 * Date: 23.06.16
 * Time: 20:36
 */
const FILE_COUNT = 'gb/count.txt';

function saveComment($filename) {

    $handle = fopen( 'gb/'.$filename, 'a');

    $string = time() . ';'. $_REQUEST['username'] . ':' . $_REQUEST['comment'] . PHP_EOL;

    fwrite($handle, $string);
    fclose($handle);

}

function getCount() {
    $handle = fopen( FILE_COUNT, 'r');

    if ($handle)
        $count = fread($handle, 250 );
    else
        $count = 0;

    return ++$count;
}

function putCount($count) {
    $handle = fopen( FILE_COUNT, 'w');
    fwrite($handle, $count);
    fclose($handle);

}

function getCommentFromFile($filename)
{

    return file_get_contents( $filename);

}


if (!isset($_REQUEST['username'])) {
    echo 'Обязательно должно быть имя пользователя!';
    exit(-1);
}

if (!$_REQUEST['comment']) {
    echo 'Обязательно должен быть непустой комментарий!';
    exit(-1);
}

 $count = getCount();

 saveComment($count . '.txt');

 putCount($count);

 $arrFiles = glob( 'gb/*.txt');

 foreach($arrFiles as $key => $value) {
     if($value == FILE_COUNT)
         continue;

     include_once $value;
//     echo getCommentFromFile($value). '<br>';
 }
 include_once 'add_comment.html';