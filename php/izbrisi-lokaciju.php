<?php

   if( isset($_POST['izbrisi-lok'] )  ){ //provera da li smo na dobar nacin dosli do ovog fajla

    session_start();
    require 'vezaSaBazom.php';
    //svakako uzimamo kao obe prom, pa cemo videti koja ce nam koristiti
   

    //provera ko je ulogovan, jer u zavisnosti od toga, druge su nam mogucnosti
    if( $_SESSION['zvanje']=='admin' ){//ulogovan admin(moze da brise bilo sta)
        $admBrise=$_POST['admUkucao'];

        $sqlAdmin="SELECT * FROM lokacije;";
       $rezultat=mysqli_query($conn,$sqlAdmin);
       
      
       while($red=mysqli_fetch_assoc($rezultat) ){                 

                 if($red['IDlok'] == $admBrise ){//nasli smo sta treba da brisemo

                    $sqlBrisanjeLok="DELETE FROM lokacije WHERE IDlok='$admBrise';";
                    mysqli_query($conn,$sqlBrisanjeLok);//obrisana lokacija

                    $sqlBrisanjePotp="DELETE FROM potpisnici WHERE IDlokacije='$admBrise';";
                    mysqli_query($conn,$sqlBrisanjePotp);//obrisani potpisi sa te lokacije valjda



                    header("Location: ../lokacije.php?brisanje=Uspelo");//uspelo brisanje od strane admina
                    exit();

                     
                            }

            }

            //DO OVOG DELA CEMO DOCI SAMO AKO ADMIN BRISE NESTO, ALI JE UNEO NEPOSTOJECI ID LOKACIJE

            header("Location: ../lokacije.php?brisanje=NemaId");
            exit();

        
    }else{ //ulogovan organizator, org moze da brise samo svoje
    
        $orgBrise=$_POST['orgUkucao'];

        $sqlAdmin="SELECT * FROM lokacije;";
       $rezultat=mysqli_query($conn,$sqlAdmin);
       
      
       while($red=mysqli_fetch_assoc($rezultat) ){

             if($red['IDlok'] == $orgBrise ) { //nasli smo lokaciju koju organizator zeli da izbrise

                //provera da li sme da brise tu lokaciju
                if( $red['IDorgadm'] == $_SESSION['idUlogovanog']   ){
                    //isti id organizatora cija je lokacija i onog koji je trenutno ulogovan

                    $sqlBrisanjeLok="DELETE FROM lokacije WHERE IDlok='$orgBrise';";
                    mysqli_query($conn,$sqlBrisanjeLok);//obrisana lokacija

                    $sqlBrisanjePotp="DELETE FROM potpisnici WHERE IDlokacije='$admBrise';";
                    mysqli_query($conn,$sqlBrisanjePotp);//obrisani potpisi sa te lokacije valjda

                    header("Location: ../lokacije.php?brisanje=Uspelo");//uspelo brisanje od strane admina
                    exit();

                }
                else{
                    //trenutni org ne sme da brise ovu lokaciju
                    header("Location: ../lokacije.php?brisanje=orgNeSme");
                    exit();

                }

                 
             }


       }

       //ako smo ovde, org je uneo nepostojeci id lokacije
    
       header("Location: ../lokacije.php?brisanje=NemaId");
            exit();
        

    }

               



}
