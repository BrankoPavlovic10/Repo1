<?php

// znamo da je ulogovan admin
if( isset($_POST['azu-lok'] )  ){
    session_start();
    require 'vezaSaBazom.php';

    $azurLok=$_POST['idZaAzuriranje'];

    $sql="SELECT * FROM lokacije;";
    $rezultat=mysqli_query($conn,$sql);

    $imaID=0;
    while($red=mysqli_fetch_assoc($rezultat) ){


        if($red['IDlok'] == $azurLok ){
            //postoji ID koji zelimo da azuriramo

            $_SESSION['ID-azur']=$red['IDlok'];//trenutno se pravi ova promenljiva, ali ce ubrzo biti unistena

            $naziv=$red['nazivLok'];
            $grad=$red['grad'];
            $opstina=$red['opstina'];
            $ulica=$red['ulica'];

            header("Location: ../unos-lokacije.php?&nzv=$naziv&grd=$grad&opstn=$opstina&ulc=$ulica" );
            exit();
        }
    }
    header("Location: ../lokacije.php?azur=NemaId");
    exit();

    









}