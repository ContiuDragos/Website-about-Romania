<?php
	$cnn=mysqli_connect("localhost","root","");
	if (!$cnn)
	{
		echo "Eroare la conectare: ".mysqli_connect_error($cnn);
	}
	$sql="CREATE DATABASE IF NOT EXISTS persoana";
	$ok=mysqli_query($cnn,$sql);
	if(!$ok)
	{
		echo "Eroare la creearea bazei de date"."---->".mysqli_errno($cnn).": ".mysqli_error($cnn)."<br>";
	}
	mysqli_query($cnn, "USE	persoana");
	
	$sql = "CREATE TABLE IF NOT EXISTS `persoane` (
										`id` int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
										`cnp` varchar(30) NOT NULL,
										`nume` varchar(30) NOT NULL,
										`prenume` varchar(30) NOT NULL,
										`adresa` varchar(30) NOT NULL,
										`telefon` varchar(30) NOT NULL,
										`email` varchar(30) NOT NULL,
										`datepers` boolean NOT NULL,
										`hotel` varchar(30) NOT NULL,
										`camera` varchar(30) NOT NULL,
										`micdejun` boolean NOT NULL,
										`pranz` boolean NOT NULL,
										`cina` boolean NOT NULL,
										`observatii` varchar(250)
									);";
	$ok = mysqli_query($cnn, $sql);
	if (!$ok)
	{
		echo "Eroare la crearea tabelului"."---->".mysqli_errno($cnn).": ".mysqli_error($cnn)."<br>";
	}
	
	if(isset($_POST['trimite']))
	{
		$nume=$_POST['nume'];
		$prenume=$_POST['prenume'];
		$adresa=$_POST['adresa'];
		$cnp=$_POST['cnp'];
		$email=$_POST['email'];
		$telefon=$_POST['telefon'];
		if (array_key_exists("alegere", $_POST))
		{
			if (isset($_POST['alegere']) && $_POST['alegere']=="DA")
				$datepers = true;
			else
				$datepers = false;
		}
		
		$hotel = $_POST['hotel'];
		$camera = $_POST['camera'];
		$micdejun = $pranz = $cina = false;
		if (isset($_POST['mese']))
		{
			if(in_array('1', $_POST['mese']))
				$micdejun = true;
			if(in_array('2', $_POST['mese']))
				$pranz = true;
			if(in_array('3', $_POST['mese']))
				$cina = true;
		}
		if(isset($_POST['observatii']))
			$observatii=$_POST['observatii'];
		
		$trimis = $_POST['trimite'];
		if ($trimis)
		{
				$sql = "INSERT INTO `persoane` (`cnp`, `nume`, `prenume`, `adresa`, `telefon`, `email`, `datepers`, `hotel`, `camera`, `micdejun`, `pranz`, `cina`, `observatii`) VALUES ('$cnp', '$nume','$prenume','$adresa','$telefon','$email','$datepers','$hotel','$camera','$micdejun','$pranz','$cina','$observatii')";
				$interogare = mysqli_query($cnn, $sql);
				if (!$interogare)
					echo "Eroare la inserare"."<br>".mysqli_errno($cnn).": ".mysqli_error($cnn);
				else
					echo "Rezervarea a fost realizata.";
		}
	
	}
	
	mysqli_close($cnn);
?>