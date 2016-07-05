<?php

function getImagePath($textFile) {

    /*
      $posGb = strpos($textFile, 'gb/') + 3;

      $id = substr($textFile, $posGb, strpos($textFile, '.')-1-$posGb );
    */
    $id = pathinfo($textFile)['filename'];

    $arrFiles = glob( "img/$id/*.*");

    return count($arrFiles) > 0 ? "<img src='{$arrFiles[0]}' width='120'>;" : $id . ';' ;
}

include_once 'func_print.php';

$arrFiles = glob( 'gb/*.txt');

$text ='';

foreach($arrFiles as $key => $value) {
    if($value == FILE_COUNT)
        continue;

    $text .= getImagePath($value) . getCommentFromFile($value) ;
}

?>

<table border="1">
    <thead>
    <tr>
        <td>Image</td><td>Date</td><td>Name</td> <td>Comment</td>
    </tr>
    </thead>
    <tbody>
    <?=PrintTable($text)?>

    </tbody>
</table>
