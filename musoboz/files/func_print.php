<?php
/**
 * Created by PhpStorm.
 * User: rus
 * Date: 23.06.16
 * Time: 19:10
 */

const FILE_COUNT = 'gb/count.txt';

function getCommentFromFile($filename)
{
    return file_get_contents($filename);
}

function PrintTable($text) {

    $search = array( PHP_EOL, ':', ';' );
    $replaces = array( '</td></tr><tr><td>', '</td><td>', '</td><td>');

    return '<tr><td>' . str_replace( $search, $replaces,  $text ) ;
}

/*
 if (!isset($_REQUEST['username'])) {
     echo 'Обязательно должно быть имя пользователя!';
     exit(-1);
 }

 if (!$_REQUEST['comment']) {
     echo 'Обязательно должен быть непустой комментарий!';
     exit(-1);
 }
*/


/*
 $filename = 'comments.db';

 $handle = fopen( $filename, 'a');

 $string = time() . ';'. $_REQUEST['username'] . ':' . $_REQUEST['comment'] . PHP_EOL;

 fwrite($handle, $string);

 fclose($handle);

 $text = getCommentFromFile($filename);
*/

?>




