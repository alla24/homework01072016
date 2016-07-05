<?php
/**
 * Created by PhpStorm.
 * User: AIR
 * Date: 30.06.2016
 * Time: 19:35
 */

function GetImages ($dir = 'img/'){

    $text='';
    $not_include=array('.','..');
    $img_extensions=['jpg','jpeg','png'];

    $arrFiles=glob($dir.'*');

    foreach ($arrFiles as $key=>$value){
        if (is_dir($value)){
            $text.='Message #'.pathinfo($value)['filename'].' images: </br>'.GetImages($value.'/')."</br>";
        }

        elseif (in_array($value,$not_include))
            continue;//continue to the next iteration

        else{

            if (in_array(strtolower(pathinfo($value)['extension']),$img_extensions)){

                $text.="<img src='$value'style='max-width:120'/>".($_SESSION['login-user']=='admin'?"<button
 onclick='alert(\"Deleting!\");'>Delete!</button>
 
 <form action=\"updateImage.php\" method=\"post\" enctype=\"multipart/form-data\">
    <input type=\"file\" name=\"photo\">
    <input type=\"submit\" value=\"Оновити зображення\">
    <input name=\"hidden\" type=\"hidden\" id=\"hidden\" value=\"$value\">
  </form>
 ":"Зверніться до адміністратора");
            }
        }
    }
    return $text;
}

function Secret(){
    $arrLogin=file('pswd');//
    $result=false;

    foreach($arrLogin as $stroka){

        $arrStroka=explode(';',$stroka);
        $result=($_GET['login']==trim($arrStroka[0]))&&($_GET['unlogin']==trim($arrStroka[1]));
        if ($result)
            break;
    }
    return $result;
}

if (!Secret()){
    echo 'Wrong login or password';
    exit(-1);
    
}

$_SESSION['login-user']=$_GET['login'];

//var_dump($_SESSION);

echo GetImages();

                
