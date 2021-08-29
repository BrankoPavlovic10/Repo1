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

			<div class="content" id="potpishi">
				<div class="petition">
					<h1>Ovde možete podržati našu akciju potpisivanjem peticije</h1>
                     <?php
				        	if( isset($_GET['potpis'])  ){
					        	echo "<p style='text-align:center;font-size:30px;'>Uspesno ste se potpisali za peticiju! </p>";
					           }
					?>
					<div class="pozicija">
						<div class="position">
							<form method="post" action="php/potpisnici-formular.php">
								<label for="input-ime">Ime</label><br>
								<input type="text" placeholder="Unesite ime" name="potp-ime" required><br>

							    <label for="input-ime">Prezime:</label><br>
								<input type="text" placeholder="Unesite prezime" name="potp-prezime" required><br>

								<label for="i-tel">Broj telefona:</label><br>
								<input type="phone" placeholder="Broj telefona" name="potp-telefon"  required><br>

								<label for="input-email">E-mail adresa:</label><br>
								<input type="email" placeholder="E-mail adresa" name="potp-email" required><br>

								<label for="input-lk">Broj lične karte:</label><br>
							    <input type="text" placeholder="Broj lične karte" name="potp-lk" id="input-lk" required><br>

								<label for="input-lk">Datum potpisivanja:</label><br>
								<input type="text" placeholder="Unesite datum" name="potp-datum" id="input-lk" required><br>
								
								<label for="input-ime">Unesite ID organizatora</label>
								  <input type="text" placeholder="Unesite ID organizatora" name="potp-idOrg" required><br>
								  
								  <div style="height:60px;width:250px;margin-top:10px;background-color:whitesmoke; text-align:left; padding-left:30px;margin-left:85px;overflow:auto; ">
									<?php                  
									   echo "ID  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   Organizator <br>";
                                       include_once 'php/vezaSaBazom.php';
						               $sql="SELECT * FROM orgadmin ;";

						               $rezultat=mysqli_query($conn,$sql);
						               $provera=mysqli_num_rows($rezultat);

						               if($provera > 0){
										
							            while($row=mysqli_fetch_assoc($rezultat) ){								
											echo  $row['IDorg']."&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp  "; echo $row['orgIme'].", ". $row['orgPrezime']."<br>"; 																	
						             	}
					            	 } 
									?>
							</div>
								

									<label for="cars">Izaberite broj termina:</label>

									<select id="termin" name="potp-br-termina">
										<option value="1" selected>1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										
									</select>

								<div class="boxevi">

								</div>

						</div>
						<div class="message">
						     <label for="input-ime">Unesite ID lokacije</label><br>
							<input type="text" placeholder="Unesite ID lokacije" name="potp-idLok" required><br><br>


							<div style="height:60px;width:250px;background-color:whitesmoke; text-align:left; padding-left:30px;margin-left:85px;overflow:auto; ">
									<?php                  
									   echo "ID  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp   Lokacija <br>";
                                       include_once 'php/vezaSaBazom.php';
						               $sql="SELECT * FROM lokacije ;";

						               $rezultat=mysqli_query($conn,$sql);
						               $provera=mysqli_num_rows($rezultat);

						               if($provera > 0){
										
							            while($row=mysqli_fetch_assoc($rezultat) ){								
											echo  $row['IDlok']."&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp  "; echo $row['nazivLok'].", ". $row['opstina']."<br>"; 																	
						             	}
					            	 } 
									?>
							</div>	


						    <label for="input-komentar">Komentar:</label><br>
							<textarea rows="4" placeholder="Napisite komentar..." name="potp-komentar" required></textarea><br>

							<label for="i-objava">Da li potpis može biti objavljen?</label>
							<input type="checkbox" name="potp-objavljen" id="i-objava" value="1"><br>

							<label for="i-objava">Da li zelite informacije putem mejla?</label>
							<input type="checkbox" name="potp-infoMejl" value="1"><br><br>

							<label>Unesite broj:</label>
							<input type="text" placeholder="Unesite broj" name="potp-broj" style="width: 75px;text-align:center;" required><br>

							<label>Unesite koordinate:</label>
							<input type="text" placeholder="X koordinata" style="width: 75px;" name="x-kord" required>
							
							<input type="text" placeholder="Y koordinata" style="width: 75px;" name="y-kord" required><br><br>


							<button type="submit" name="potp-salji">Pošalji</button>
							<button type="reset">Poništi</button>

						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="javas.js"></script>
	<script>
				// timer 5 sekundi
		var timeoutInMiliseconds = 5000;
		var timeoutId; 

		function startTimer() { 
			timeoutId = window.setTimeout(doInactive, timeoutInMiliseconds);
		}

		function resetTimer() { 
			window.clearTimeout(timeoutId);
			startTimer();
		}

		function doInactive() {
			alert("Proslo je " + timeoutInMiliseconds/1000 + " sekundi !");
		}

		function setupTimers () {
			document.addEventListener("mousemove", resetTimer, false);
			document.addEventListener("mousedown", resetTimer, false);
			document.addEventListener("keypress", resetTimer, false);
			document.addEventListener("keydown", resetTimer, false);
			document.addEventListener("scroll", resetTimer, false);
			document.addEventListener("touchmove", resetTimer, false);
				
			startTimer();
		}

		setupTimers();
	</script>
</body>

</html>