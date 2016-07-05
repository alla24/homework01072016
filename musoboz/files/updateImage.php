<?php

print_r($_POST);
print_r($_FILES);

//check for errors
if ($_FILES['photo']['error'] != 0) {
    echo 'Error from uploaded file!';
    exit(-1);
}

//check if the file is an image of type 'jpg','jpeg','png'
$img_extensions=['jpg','jpeg','png'];
if (in_array(strtolower(pathinfo($_FILES['photo']['tmp_name'])['extension']),$img_extensions)) {
    echo 'Not suppported file type!';
    exit(-1);
}

//check for file size
if ( ($_FILES['photo']['size'] < 0)  || ($_FILES['photo']['size'] > 5000000) ) {
    echo 'File size not valid!';
    exit(-1);
}

//Place it into the folder
$tempName=$_FILES['photo']['tmp_name'];
$filename=$_FILES['photo']['name'];
move_uploaded_file($tempName, (pathinfo($_REQUEST['hidden'])['dirname']) . '/' .$filename);

//deleting if file exsists
if(file_exists($_REQUEST['hidden'])) {
    unlink("{$_REQUEST['hidden']}");}

?>

<P> Нове зображення завантажено! </P>
