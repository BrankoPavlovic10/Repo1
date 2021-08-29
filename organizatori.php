<!doctype html>
<html>
<head>
	 <meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>Peticija</title>
	 <link rel="stylesheet" href="projekat1.css">
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
				
				<div class="content" id="organizatori">
					<div class="petition">
                        <h1>Spisak organizatora</h1>

						<?php 
                           //ODOBRAVANJE ORGANIZATORA
                          if( $_SESSION['zvanje']=='admin' ){
								   echo '<p style="margin-bottom:10px;">Unesite ID organizatora kog zelite da odobrite ili izbrisete: </p> 
								   <form style="margin: auto; width: fit-content;" method="post" action="php/odobri-organizatore.php">
								          <input type="text" name="IDid" placeholder="Id..." >
								          <input type="submit" name="odobri-org" value="Odobri" style="width: 165px; margin-top: 10px;margin-bottom:10px">
								   </form>
									
								 
								   <form style="margin: auto; width: fit-content;" method="post" action="php/izbrisi-organizatore.php">
									      <input type="text" name="IDizbrisanog" placeholder="Id..." >
									      <input class="izbrisi" type="submit" name="izbrisi-org" value="Izbrisi" style="width: 165px; margin-top: 10px;margin-bottom:10px;">
								</form>
								 ';
						 }


				
							
                             //PORUKA NAKON ODOBRAVANJA
							if(isset($_GET['organizator'])  ){
								if($_GET['organizator']=='VecOdobren'  ){
									echo '<p style="margin-top:15px;margin-bottom:15px;">Organizator je vec odobren, mozete odobriti nekoga drugog!</p>';
								}elseif($_GET['organizator']=='odobrenJe' ){
									echo '<p style="margin-top:15px;margin-bottom:15px;">Organizator je odobren!</p>';
								}elseif($_GET['organizator']=='nePostoji') {
									echo '<p style="margin-top:15px;margin-bottom:15px;">Ne postoji organizator za uneti ID!  </p>';
								}
                               

							}

							//PORUKA NAKON BRISANJA ORGANIZATORA
							if(isset($_GET['brisanje'])  ){
								if($_GET['brisanje']=='neuspelo'  ){
									echo '<p style="margin-top:15px;margin-bottom:15px;">Uneti organizator ne postoji!</p>';
								}elseif($_GET['brisanje']=='neSme' ){
									echo '<p style="margin-top:15px;margin-bottom:15px;">Organizator ne sme biti izbrisan!</p>';
								}elseif($_GET['brisanje']=='uspelo') {
									echo '<p style="margin-top:15px;margin-bottom:15px;">Organizator je uspesno izbrisan!  </p>';
								}
                               

							}
						
						?>

						<div class="provera">

						<table class="tabela">
								<tr>
								    <th>Id organizatora</th>
									<th>Ime i prezime</th>
									<th> E-mail adresa</th>
									<th>Telefon</th>
									<th>Broj lične karte </th>
									
						<?php
						if( isset($_SESSION['zvanje'])   ){
							echo " <th>Odobrenost </th>";//dodavanje kolone ako smo ulogovani kao admin
						}
						?>
									
									
								</tr>
								
								<?php

                                if( isset($_SESSION['zvanje'])   ){
						           require 'php/vezaSaBazom.php';
						           $sql="SELECT * FROM orgadmin;";

						           $rezultat=mysqli_query($conn,$sql);
						           $provera=mysqli_num_rows($rezultat);

						           if($provera > 0){
							          while($red=mysqli_fetch_assoc($rezultat)  ){
										echo "<tr>";
										echo "<td>".$red['IDorg']."</td>";
										echo "<td>".$red['orgIme']." ".$red['orgPrezime']."</td>";
										echo "<td>".$red['orgMejl']."</td>";
										echo "<td>".$red['orgTelefon']."</td>";										
										
										echo "<td>".$red['orgLicnaKarta']."</td>";

										// u sustini gledas da li je odobren org, ako jeste, napisace odobren organizator, 
										//a ako ne, pisace da nije odobren
										
										if(!$red['orgOdobren'] ){
											echo "<td>Neodobren </td>";
										}else{
											echo "<td>Odobren </td>";

										}

										echo "</tr>";

							             }

						       	   }
							
						    }
						?>

							</table>

						
						</div>
                        
					</div>
				</div>
			</div>
		</div>
		<script>
		
		var dugme = document.querySelector('.izbrisi');
		dugme.addEventListener('click', upit);
		function upit() {
			window.confirm('Da li zaista zelite da izbisete ?');
		}
		
		</script>
	</body>
</html>