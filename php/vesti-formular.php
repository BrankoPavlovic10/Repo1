<?php

if( isset( $_POST['salji-vesti'])  ){
    session_start();

    require 'vezaSaBazom.php';

    $naslov=$_POST['naslov-vesti'];
    $datum=$_POST['datum-vesti'];
    $sadrzaj=$_POST['sadrzaj-vesti'];
     //ovo treba nekako da se procita u zavisnosti od toga ko je ulogovan

    $mejl=$_SESSION['mejl'];

    $sql1="SELECT * FROM orgadmin;";
    $rezultat1=mysqli_query($conn,$sql1);
    $provera=mysqli_num_rows($rezultat1);
 
    $id=99;
    if($provera > 0 ){
        while($red=mysqli_fetch_assoc($rezultat1) ){
        if($red['orgMejl'] == $mejl){
                $id=$red['IDorg'];
                         }
                   }
          }


    $sql="INSERT INTO vesti (IDorganizatora,naslov, datum,sadrzaj) VALUES ('$id','$naslov','$datum','$sadrzaj');";

    mysqli_query($conn,$sql);


    header("Location: ../unos-vesti.php?vest=uspesna");



}