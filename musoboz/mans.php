<?php
/**
 * Created by PhpStorm.
 * User: rus
 * Date: 21.06.16
 * Time: 20:45
 */
function printCorrectName( &$name)
{
    $manNames =['Ruslan', 'Ivan'];
    if ( in_array( $name, $manNames) )
        $name =  'Mr.' . $name;
    else
        $name =  'Ms.' . $name;
}
 $names = array(
     ['name' => 'Ruslan', 'age' => 43 ],
     ['name'  => 'Anna', 'age' => 18 ],
     [],
     []
 );

 foreach($names as $i => $value )
 {
   if ($i == 0)
       foreach($value as $key => $val)
           echo "$key ";

   foreach($value as $key => $val)
   {
       if ($key == 'name') {
           printCorrectName($val);
           echo $val . ': ';
       }
       else
           echo "$key => $val<br>";
   }
 }
