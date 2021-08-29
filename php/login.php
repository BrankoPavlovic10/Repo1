<?php

   if( isset($_POST['dugme-logovanje']) ){

   require 'vezaSaBazom.php';

   $mejl=$_POST['login-mejl'];
   $sifra=$_POST['login-sifra'];

   $sql="SELECT * FROM orgadmin;";//upit za tabelu u bazi

   $rezultat=mysqli_query($conn,$sql);
   if(mysqli_num_rows($rezultat)>0 ){
        $mejlProv=0;   //provere za mejl i lozinku
        $sifraProv=0;

        while($red=mysqli_fetch_assoc($rezultat)  ){
                   if( $red['orgMejl']==$mejl ){
                       $mejlProv=1;
                   }
                   if( $red['orgSifra']==$sifra ){
                   $sifraProv=1;
                }
            }

        if(!$mejlProv){
            header("Location: ../uloguj-se.php?error=losMejl");
                    exit();
        }elseif(!$sifraProv){
            header("Location: ../uloguj-se.php?error=losaSifra");
                    exit();
        }else{
            session_start();//okej su mejl i sifra, pa startujemo sesiju
            $_SESSION['mejl']=$mejl;
            $_SESSION['sifra']=$sifra;
            //da bi znali da li je organizator ili admin

            $sql2="SELECT * FROM orgadmin where orgMejl='$mejl';";
            $rezultat2=mysqli_query($conn,$sql2);

            if(mysqli_num_rows($rezultat2)>0 ){

                 while($red=mysqli_fetch_assoc($rezultat2)  ){
                     $_SESSION['zvanje']=$red['orgIzbor'];
                     $_SESSION['idUlogovanog']=$red['IDorg'];
                      }
                }  

            header("Location: ../uloguj-se.php?error=uspeh");//vraca nas na stranu i uspesno smo logovani
        }



   }





   }


