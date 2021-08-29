<?php

session_start();

session_unset();//brise promenljive sesije
session_destroy();

header("Location: ../uloguj-se.php?uspsnoSteIzlogovani");
