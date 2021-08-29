<?php

if( isset($_POST['unesi-org']  ) ){
    require 'vezaSaBazom.php';


    $organizatorIme=$_POST['org-ime'];
    $organizatorPrezime=$_POST['org-prezime'];
    $organizatorTelefon=$_POST['org-telefon'];

    $organizatorPredlagac=$_POST['org-predlagac'];
    $organizatorLicna=$_POST['org-licnaKarta'];
    $organizatorMejl=$_POST['org-email'];

    $organizatorSifra=$_POST['org-sifra'];
    $sifra2=$_POST['org-OpetSifra'];


    $odobrenje=0;

    $nevazPotpisi=0;
    $nevazPrep=0;

     //uzimanje podatka da li je admin ili organizator

    $answer = $_POST['admini'];  
    if ($answer == "organizator") {          
        $izbor="organizator";      
    }
    else {
      $izbor="admin";
     } 


    if( !filter_var($organizatorMejl,FILTER_VALIDATE_EMAIL)  ){ //u slucaju da nije dobar mejl
        header("Location: ../unos-organizatora.php?error=mail");
        exit();

    }else if($organizatorSifra != $sifra2){//da li su lozinke iste
        header("Location: ../unos-organizatora.php?error=razliciteLozinke");
        exit();
    } else{                 //provera da li vec postoji isti username
        $sql="SELECT * FROM orgadmin;";//upit za bazu

        $rezultat=mysqli_query($conn,$sql);//poslat upit bazi
        if(mysqli_num_rows($rezultat)>0 ){
            
            while( $red=mysqli_fetch_assoc($rezultat) ){
                if($red['orgMejl'] == $organizatorMejl){
                
                header("Location: ../unos-organizatora.php?error=dupliMejl");
                exit();
                }
            }

        }//yatvaranje if
        //NASTAVLJANJE DALJE AKO JE SVE SUPER
        
        $sql="INSERT INTO `orgadmin`( `orgIme`, `orgPrezime`, `orgSifra`,`orgTelefon`, `orgMejl`, `orgLicnaKarta`,`orgOdobren`, `IDpreporuke`, `nevPotpisi`,`nevPreporuke`
        ,`orgIzbor`) VALUES ('$organizatorIme','$organizatorPrezime','$organizatorSifra','$organizatorTelefon','$organizatorMejl','$organizatorLicna','$odobrenje',
        '$organizatorPredlagac', '$nevazPotpisi','$nevazPrep','$izbor');"; 


        mysqli_query($conn,$sql);
        header("Location: ../unos-organizatora.php?error=uspesnoLogovanje");


        }//zatvaranje cele provere za username



}