<?php


function danisman_code($uzunluk=6){
    $kaynak='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charuzunluk=strlen($kaynak);

    $kod='';

    for ($i=0; $i <$uzunluk ; $i++) { 
        
        $kod.=$kaynak[rand(0,$charuzunluk-1)];
    }

    return $kod;

}




  
        function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//echo danisman_code();



    $sifre=generateRandomString();
    echo $sifre.'<br>';

    echo sha1(md5(md5($sifre)));

    ?>