<?php

    if( isset( $_POST['izbrisi-org'])  ){

            session_start();
            require 'vezaSaBazom.php';

            $idZaBrisanje=$_POST['IDizbrisanog'];

            $sql="SELECT * FROM orgadmin;";
            $rezultat=mysqli_query($conn,$sql);
            $provera=mysqli_num_rows($rezultat);


            if($provera > 0 ){
            while($red=mysqli_fetch_assoc($rezultat) ){

                     if($red['IDorg'] == $idZaBrisanje ){//IMAMO ORGANIZATORA SA ZADATIM ID-JEM I ZELIMO DA GA BRISEMO

                     
                     //ALI PRVO PROVERA DA LI ON SME BITI OBRISAN

                     $sqlProvere="SELECT * FROM orgadmin;";
                     $rezultatProvere=mysqli_query($conn,$sqlProvere);
                     $smeSeBrisati=1;


                     while($rowForCheck=mysqli_fetch_assoc($rezultatProvere) ){

                           if($rowForCheck['IDpreporuke'] == $idZaBrisanje ){//ipak je nekoga preporucio, pa ga ne smemo brisati
                           $smeSeBrisati=0;
                                    }
                           }

                     if( $smeSeBrisati){//sme da se brise

                                       $sqlNovi="DELETE FROM orgadmin WHERE IDorg='$idZaBrisanje';";
                                       mysqli_query($conn,$sqlNovi); //obrisan korisnik

                                       //SAD BRISEMO NJEGOVE POTPISE 
                                       $sqlPotpisnici="DELETE FROM potpisnici WHERE IDorganizatora='$idZaBrisanje';";
                                       mysqli_query($conn,$sqlPotpisnici); //obrisani potpisnici koji imaju ovog organizatora

                                       //BRISANJE LOKACIJA
                                       $sqlLokacije="DELETE FROM lokacije WHERE IDorgadm='$idZaBrisanje';";
                                       mysqli_query($conn,$sqlLokacije);  //obrisane lokacije
                                                      
                                       header("Location: ../organizatori.php?brisanje=uspelo");
                                       exit();
                                    }
                          else{
                                     header("Location: ../organizatori.php?brisanje=neSme");
                                      exit();
                                }
                                
                     }
                     
              }
              header("Location: ../organizatori.php?brisanje=neuspelo");
              exit();

      }


   


      
    
}

    





   



