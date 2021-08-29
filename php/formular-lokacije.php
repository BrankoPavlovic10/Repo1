<?php
if( isset($_POST['unesi-lok']  ) ){
    
    session_start();
    require 'vezaSaBazom.php';

    $lokacijaNaziv=$_POST['nazivLokacije'];
    $lokacijaGrad=$_POST['grad'];
    $lokacijaOpstina=$_POST['opstina'];
    $lokacijaUlica=$_POST['ulica'];

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

   $nula=0;

    $sql2="INSERT INTO lokacije (IDorgadm, IDbiraca, nazivLok, grad, opstina, ulica) VALUES ('$id','$nula','$lokacijaNaziv','$lokacijaGrad','$lokacijaOpstina','$lokacijaUlica');";

    mysqli_query($conn,$sql2);


    header("Location: ../unos-lokacije.php?prijavljivanje=uspesno");
    exit();

}elseif( isset($_POST['azuriraj']  ) ){
    session_start();
    require 'vezaSaBazom.php';

    

    $lokNaziv=$_POST['nazivLokacije'];
    $lokGrad=$_POST['grad'];
    $lokOpstina=$_POST['opstina'];
    $lokUlica=$_POST['ulica'];

    $id=$_SESSION['ID-azur'];

    unset($_SESSION['ID-azur']);

    $sqlAzuriranje="UPDATE lokacije SET nazivLok='$lokNaziv', grad='$lokGrad', opstina='$lokOpstina', ulica='$lokUlica'
     WHERE IDlok= '$id'; ";

    $radi=mysqli_query($conn,$sqlAzuriranje);

    header("Location: ../unos-lokacije.php?prijavljivanje=kao radi");
    exit();

   /* if($radi){
      echo '<script type="text/javascript"> alert("RADI")   </script>';

    }else{
        echo '<script type="text/javascript"> alert("NEEE")   </script>';

    }
*/



}
