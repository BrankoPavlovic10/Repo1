<?php

if ( isset( $_POST['odobri-org']  ) ){

    session_start();
    require 'vezaSaBazom.php';

    $idZaOdobravanje=$_POST['IDid'];

    //prom koje sluze da proverim da li korisnik sa tim ID-jem postoji u bazi i ako postoji da li je vec odobren
    $postojanjeKorisnika=0;
    $odobrenostKorisnika=0;

    $sql="SELECT * FROM orgadmin;";
    $rezultat=mysqli_query($conn,$sql);
    $provera=mysqli_num_rows($rezultat);
 
  
    if($provera > 0 ){
        while($red=mysqli_fetch_assoc($rezultat) ){

            if($red['IDorg'] == $idZaOdobravanje ){
                 //utvrdili smo da postoji

                if($red['orgOdobren'] == 1 ){//organizator postoji i vec je odobren
                    header("Location: ../organizatori.php?organizator=VecOdobren");
                    exit();
                }else{//postoji, ali nije odobre i treba da ga odobrimo
                    $sqlNovi="UPDATE orgadmin SET orgOdobren = '1' WHERE IDorg = $idZaOdobravanje;";
                    mysqli_query($conn,$sqlNovi);

                    header("Location: ../organizatori.php?organizator=odobrenJe");
                    exit();

                }



            }

            
    }

 }


    header("Location: ../organizatori.php?organizator=nePostoji");




}