<?php
namespace App\Service;

class Rebriqueimage
{
    public function setObject($voyage)
    {
   $stack = array();
$stackF = array();
$i=1;
$count=0;
foreach ($voyage as $key => $variable) {
    $count++;
if($i<=3){

array_push($stack,$variable );

$i++;

}else{
    $i=1;
    array_push($stackF, $stack);
    $stack = array();

    array_push($stack,$variable );

}
}

array_push($stackF, $stack);
return $stackF;

    }
}