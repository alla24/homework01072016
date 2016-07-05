<?php
/**
 * Created by PhpStorm.
 * User: rus
 * Date: 23.06.16
 * Time: 20:36
 */

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

function SavePhoto($tempName, $filename, $id) {

    $pathTo = 'img/' . $id;

    if ( !file_exists('img') ) {
        mkdir('img');
    }

    if ( !file_exists( $pathTo) ) {
        mkdir($pathTo);
    }

    move_uploaded_file($tempName, $pathTo . '/' .$filename);
}

include_once 'func_print.php';

if (!isset($_REQUEST['username'])) {
    echo 'Обязательно должно быть имя пользователя!';
    exit(-1);
}

if (!$_REQUEST['comment']) {
    echo 'Обязательно должен быть непустой комментарий!';
    exit(-1);
}

$count = getCount();

if ( !file_exists('gb') ) {
    mkdir('gb');
}

saveComment($count . '.txt');

putCount($count);



// Count # of uploaded files in array
$total = count($_FILES['photo']['name']);

// Loop through each file
for($i=0; $i<$total; $i++) {

    //check for errors
    if ($_FILES['photo']['error'][$i] != 0) {
        echo 'Error from uploadede file!';
        exit(-1);
    }

    //check if the file is an image
    if ( !strstr($_FILES['photo']['type'][$i], 'image') ) {

        echo 'Not suppported file type!';
        exit(-1);

    }

    //check for file size
    if ( ($_FILES['photo']['size'][$i] < 0)  || ($_FILES['photo']['size'][$i] > 5000000) ) {
        echo 'File size not valid!';
        exit(-1);

    }

    SavePhoto($_FILES['photo']['tmp_name'][$i], $_FILES['photo']['name'][$i], $count);

}


$arrFiles = glob( 'gb/*.txt');

$text ='';

foreach($arrFiles as $key => $value) {
    if($value == FILE_COUNT)
        continue;

    $text .= getCommentFromFile($value) . PHP_EOL;
}


?>

<table border="1">
    <thead>
    <tr>
        <td>Date</td><td>Name</td> <td>Comment</td>
    </tr>
    </thead>
    <tbody>
    <?=PrintTable($text)?>

    </tbody>
</table>
 