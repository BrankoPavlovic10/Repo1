<!doctype html>
<html>
<head>
	 <meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>Peticija</title>
	 <link rel="stylesheet" href="projekat1.css">
	 <link rel="stylesheet" href="novi.css">
</head>
	<body>
		<div class="header">
			<div class="column">
				<div id="logo-i-social">
					<div id="logo-holder">
						<img alt="Loading logo" src="social/img/tree.svg">
					</div>
					
					<div id="social-holder">
					<?php
						session_start();
						if( isset($_SESSION['mejl'] ) ){
							echo'<span style="color:green;font-size:30px; ">Uspesno ste ulogovani kao '.$_SESSION['zvanje'].' !</span>';
						}
								 ?>
						<a href="#">
							<img alt="Facebook"	src="social/img/facebook.svg">
						</a>
						<a href="#">
							<img alt="Twitter" src="social/img/twitter.svg">
						</a>
						<a href="#">
							<img alt="Instagram" src="social/img/instagram.svg">
						</a>


					</div>
				</div>
				
				<nav id="main-menu">
					<ul>
						<li><a href="naslovna.php">Naslovna</a></li>
						<li><a href="naslovna.php">Peticija</a></li>
						<li><a href="vesti.php">Vesti</a></li>
						<li><a href="potpisi.php">Potpisi</a></li>
						<li><a href="potpishi.php">Potpiši</a></li>
					
						<li>
							<a href="#organizacija">Organizacija</a>
							<ul>
								<li><a href="uloguj-se.php">Uloguj se</a></li>
								<li><a href="registracija.php">Registracija</a></li>
								<?php
								if( isset($_SESSION['mejl'])  ){
									echo '
								<li><a href="lokacije.php">Lokacije</a></li>
								<li><a href="organizatori.php" class="active">Organizatori</a></li>
								<li><a href="kompletni-potpisi.php">Kompletni potpisi</a></li>
								<li><a href="php/logout.php">Izloguj se</a></li>';
								}
								?>
							</ul> 
						</li>

						<?php
						if(isset($_SESSION['mejl'])  ){
						echo '<li>
							<a href="#unos">Unos</a>
							<ul>
								<li><a href="unos-vesti.php">Unos vesti</a></li>
								<li><a href="unos-organizatora.php">Unos organizatora</a></li>
								<li><a href="unos-lokacije.php">Unos lokacije</a></li>
							</ul> 
						</li>';
						}
						?>
						<li><a href="kontakt.php">Kontakt</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="page">
			<div class="column">
				<div class="comment">
				<?php

                    require 'php/vezaSaBazom.php';
                    $sql="SELECT * FROM potpisnici;";

                    $rezultat=mysqli_query($conn,$sql);
                    $provera=mysqli_num_rows($rezultat);

                    if($provera > 0){
	                     echo "<p style='color:black;'>Imena potpisnika koji su dali dozvolu za objavu potpisa i njihovi komentari:   </p>";
	                         while($red=mysqli_fetch_assoc($rezultat)  ){
				           	       echo "<p style=';color:black;text-align:center;'>".$red['komentar'];
			           	}
	                 }
                   ?>

				</div>
				
				<div class="content" id="naslovna">
					<div class="petition">
                        <h1>Spisak lokacija: <br> </h1>	
						<?php
						if(isset($_GET['brisanje']) ){
                            if( $_GET['brisanje']=="Uspelo"  ){
								echo "<p style='color:green;font-size:25px;margin-bottom:0px;'>Uspesno je obrisana lokacija od strane admina! </p>";
							}elseif ($_GET['brisanje']=="NemaId"  ){
								echo "<p style='color:red;font-size:25px;margin-bottom:0px;'>Uneti Id lokacije ne postoji, molimo Vas pokusajte da unesete drugi ID. </p>";
							}
								elseif ($_GET['brisanje']=="orgNeSme"  ){
									echo "<p style='color:red;font-size:25px;margin-bottom:0px;'>Niste u mogucnosti da izbrisete trenutnu lokaciju. </p>";
								}
						 }

						 if(isset($_GET['azur']) ){
								if ($_GET['azur']=="NemaId"  ){
								echo "<p style='color:red;font-size:25px;margin-bottom:0px;'>Uneti ID lokacije ne postoji. </p>";
								}
					    }

													
                
						if( $_SESSION['zvanje']=='admin' ){
								   echo '<p style="margin-bottom:20px;margin-top:10px;">Unesite ID lokacije koju zelite da izbrisete ili azurirate: </p> 
											<form style="margin: auto; width: fit-content;" method="post" action="php/izbrisi-lokaciju.php">
													<input type="text" name="admUkucao" placeholder="Unesite ID za brisanje..." >
													<input class="brisi" type="submit" name="izbrisi-lok" value="Izbrisi" style="margin-top: 20px;margin-bottom:10px">
											</form>

											<form style="margin: auto; width: fit-content;" method="post" action="php/azuriraj-lokaciju.php">
												<input type="text" name="idZaAzuriranje" placeholder="Unesite ID za azuriranje..." required >
												<input type="submit" name="azu-lok" value="Azuriraj" style="margin-top:20px;margin-bottom:20px">
											</form>     ';




							}elseif($_SESSION['zvanje']=='organizator'){
								echo '<p style="margin-bottom:20px;">Unesite ID SVOJE lokacije koju zelite da izbrisete: </p> 
								   <form style="margin: auto; width: fit-content;" method="post" action="php/izbrisi-lokaciju.php">
								          <input type="text" name="orgUkucao" placeholder="Id..." ><br>
								          <input type="submit" name="izbrisi-lok" value="Izbrisi" style="width: 165px; margin-top: 20px;margin-bottom:20px">
								   </form>
								    ';
							}

                        ?>


						 

						 <table class="tabela" style="margin-left:120px;">
						 <tr>
								    <th>Id lokacije</th>
									<th>Naziv lokacije</th>
									<th>Grad</th>
									<th>Opstina</th>
				    	</tr>

						<?php
                           include_once 'php/vezaSaBazom.php';
                           $sql="SELECT * FROM lokacije ;";

                           $rezultat=mysqli_query($conn,$sql);
                           $provera=mysqli_num_rows($rezultat);

                           if($provera > 0){

                               while($red=mysqli_fetch_assoc($rezultat) ){
							    echo "<tr>";
							    echo "<td>".$red['IDlok']."</td>";
							    echo "<td>".$red['nazivLok']."</td>";
							    echo "<td>".$red['grad']."</td>";
							    echo "<td>".$red['opstina']."</td>";										
							    echo "</tr>";
   
                                   }

                              }
					     	?>
						 
                      </table>


					
						
						
					</div>
				</div>
			</div>
		</div>
		<script>
		
		var dugme = document.querySelector('.brisi');
		dugme.addEventListener('click', upit);
		function upit() {
			window.confirm('Da li zaista zelite da izbisete ?');
		}
		
		</script>




	</body>
</html>