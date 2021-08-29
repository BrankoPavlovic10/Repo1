<?php
 if(isset($_POST['potp-salji'])  ){
    require 'vezaSaBazom.php';

    //prvo da izvucem ove promenljive koje su fiksne, pa cu posle one sto su doradjivanje sa js

    $potpIme=$_POST['potp-ime'];
    $potpPrezime=$_POST['potp-prezime'];

    $potpTelefon=$_POST['potp-telefon'];
    $potpMejl=$_POST['potp-email'];

    $potpLicna=$_POST['potp-lk'];
    $potpDatum=$_POST['potp-datum'];

    //ove sa druge polovine formulara
   $potpIdLok=$_POST['potp-idLok'];

   $potpKomentar=$_POST['potp-komentar'];


   if ($_POST['potp-infoMejl'] ){//provera za informacije putem mejla
      $potpInfoMejl="da";
    }else{
     $potpInfoMejl="ne";
    }

    if ($_POST['potp-objavljen'] ){//provera za objavu potpisa
      $potpObjava="da";
    }else{
     $potpObjava="ne";
    }

    $potpXkord=$_POST['x-kord'];
    $potpYkord=$_POST['y-kord'];

    $potpBroj=$_POST['potp-broj'];

    $potpisPreuzet="ne";

    //za broj termina
    if($_POST['potp-br-termina']==1){
               $potpBrTermina=1;
    }elseif($_POST['potp-br-termina']==2){
        $potpBrTermina=2;
    }
    elseif($_POST['potp-br-termina'] ==3 ){
        $potpBrTermina=3;
    }
    elseif($_POST['potp-br-termina']==4 ){
        $potpBrTermina=4;
    }
    elseif($_POST['potp-br-termina']==5 ){
        $potpBrTermina=5;
    }
    elseif($_POST['potp-br-termina']==6 ){
        $potpBrTermina=6;
    }
    else{
        $potpBrTermina=7;
    }


    //za satnice
    if($_POST['7h-9h'] ){
        $Od7do9="da";
     }else{
        $Od7do9="ne";
     }
   
     if($_POST['9h-11h'] ){
      $Od9do11="da";
   }else{
      $Od9do11="ne";
   }
   
   if($_POST['11h-13h'] ){
      $Od11do13="da";
   }else{
      $Od11do13="ne";
   }
   
   if($_POST['13h-15h'] ){
      $Od13do15="da";
   }else{
      $Od13do15="ne";
   }
   
   if($_POST['15h-17h'] ){
      $Od15do17="da";
   }else{
      $Od15do17="ne";
   }
   
   if($_POST['17h-19h'] ){
      $Od17do19="da";
   }else{
      $Od17do19="ne";
   }
   
   if($_POST['19h-21h'] ){
      $Od19do21="da";
   }else{
      $Od19do21="ne";
   }


   $potpIDorg=$_POST['potp-idOrg'];


$sql="INSERT INTO `potpisnici`(`ime`, `prezime`,`telefon`,`email`,`lk`,`komentar`,`IDlokacije`,`datum`,`brTermina`,`od7do9`,`od9do11`,`od11do13`,`od13do15`,`od15do17`,
`od17do19`,`od19do21`,`infoMejl`,`objava`,`preuzet`,`broj`,`Xkord`,`Ykord`,`IDorganizatora`) VALUES ('$potpIme','$potpPrezime','$potpTelefon','$potpMejl',' $potpLicna','$potpKomentar',
'$potpIdLok','$potpDatum','$potpBrTermina','$Od7do9','$Od9do11','$Od11do13','$Od13do15','$Od15do17','$Od17do19','$Od19do21','$potpInfoMejl','$potpObjava',
'$potpisPreuzet','$potpBroj','$potpXkord','$potpYkord','$potpIDorg');";


mysqli_query($conn,$sql);

header("Location: ../potpishi.php?potpis=uspesno");



}
