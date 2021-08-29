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
				
				<div class="content" id="unos-lokacije">
					<div class="petition">
						<h1>Na ovoj strani možete izvršiti unos novih lokacija:</h1>
                        <form class="kontakt-forma" method="post" action="php/formular-lokacije.php" >
							<?php
							if(isset( $_GET['nzv'])  ){
								$prva=$_GET['nzv'];
								echo '<label for="input-lokacija">Naziv lokacije:</label><br>
								<input type="text" placeholder="Unesite lokaciju" name="nazivLokacije" id="input-lokacija" required value="'.$prva.'"><br> ';
							}else{
								echo '<label for="input-lokacija">Naziv lokacije:</label><br>
								<input type="text" placeholder="Unesite lokaciju" name="nazivLokacije" id="input-lokacija" required ><br> ';
							}


							if(isset( $_GET['grd'])  ){
								$druga=$_GET['grd'];
								echo '<label for="input-grad">Grad:</label><br>
								<input type="text" placeholder="Unesite grad" name="grad" required value="'.$druga.'"  ><br>  ';
							}else{
								echo '<label for="input-grad">Grad:</label><br>
								<input type="text" placeholder="Unesite grad" name="grad" required  ><br>';
							}

							if(isset( $_GET['opstn'])  ){
								$treca=$_GET['opstn'];
								echo '<label for="input-opstina">Opština:</label><br>
								<input type="text" placeholder="Unesite opštinu" name="opstina" id="input-opstina" required  value="'.$treca.'"  ><br>  ';
							}else{
								echo '<label for="input-opstina">Opština:</label><br>
								<input type="text" placeholder="Unesite opštinu" name="opstina" id="input-opstina" required><br>';
							}

							if(isset( $_GET['ulc'])  ){
								$cetvrta=$_GET['ulc'];
								echo '<label for="input-ulica">Ulica:</label><br>
								<input type="text" placeholder="Unesite ulicu" name="ulica" id="input-ulica" required value="'.$cetvrta.'" ><br>  

								<button type="submit" name="azuriraj">Azuriraj</button>
							    <button type="reset" value="Reset">Reset</button>
								';
							}else{
								echo '<label for="input-ulica">Ulica:</label><br>
								<input type="text" placeholder="Unesite ulicu" name="ulica" id="input-ulica" required><br>

								<button type="submit" name="unesi-lok">Unesi</button>
								<button type="reset">Poništi</button>
								
								';
							}



							





							?>
                            
    
                            
							
						</form>
					</div>
				</div>
			</div>
		</div>
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