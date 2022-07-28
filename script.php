{source}

<?php

$dbhost = "host";
$dbuser = "user";
$dbpass = "passwoord";
$db = "db";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully</br>";



$xml = simplexml_load_file("http://www.volleyadmin2.be/services/wedstrijden_xml.php?stamnummer=AH-0664") or die("Failed to load");

foreach($xml->children() as $wedstrijd) { 
  $nr = $wedstrijd->nr; 
  $datum = $wedstrijd->datum; 
  $aanvangsuur = $wedstrijd->aanvangsuur;
  $reeks = $wedstrijd->reeks; 
  $reeksid = $wedstrijd->reeksid;
  $thuisploeg = $wedstrijd->thuisploeg;
  $bezoekersploeg = $wedstrijd->bezoekersploeg;
  $sporthal = $wedstrijd->sporthal;
  $thuisploeg_id = $wedstrijd->thuisploeg_id;
  $bezoekersploeg_id = $wedstrijd->bezoekersploeg_id;
  $stamnummer_thuisclub = $wedstrijd->stamnummer_thuisclub;
  $stamnummer_bezoekersclub = $wedstrijd->stamnummer_bezoekersclub;
  $ForfaitHoofd = $wedstrijd->ForfaitHoofd;
  $uitslag_set_1 = $wedstrijd->uitslag_set_1;
  $uitslag_set_2 = $wedstrijd->uitslag_set_2;
  $uitslag_set_3 = $wedstrijd->uitslag_set_3;
  $uitslag_set_4 = $wedstrijd->uitslag_set_4;
  $uitslag_set_5 = $wedstrijd->uitslag_set_5;
  $uitslagReserven = $wedstrijd->uitslagReserven;
  $UitslagRes_set_1 = $wedstrijd->UitslagRes_set_1;
  $UitslagRes_set_2 = $wedstrijd->UitslagRes_set_2;
  $UitslagRes_set_3 = $wedstrijd->UitslagRes_set_3;
  $postponed = $wedstrijd->postponed;

  if ($sporthal == "Nijlen Sporthal 't Zand") {
  $sporthal = substr_replace($sporthal,"'", 16, 0);
  } elseif ($sporthal == "Berchem Sporthal 't Rooi 2") {
    $sporthal = substr_replace($sporthal,"'", 17, 0);
  } elseif ($sporthal == "Beerse Sporthal 't Beerke") {
    $sporthal = substr_replace($sporthal,"'", 16, 0);
  } elseif ($sporthal == "Berlaar Sporthal 't Stapveld"){
    $sporthal = substr_replace($sporthal,"'", 17, 0);
  } elseif ($sporthal == "Herenthout 't Kapelleke"){
      $sporthal = substr_replace($sporthal,"'", 12, 0);
  }

$datum = str_replace("/", "-", $datum);

$timestamp = strtotime($datum . $aanvangsuur);
$date = date('Y-m-d H:i', $timestamp);
if (strpos($bezoekersploeg_id, 'winnaar') !== false) {
    echo 'true';
}
  $sql = "INSERT INTO JORIKTEST (nr, datum, aanvangsuur, reeks, reeksid, thuisploeg, bezoekersploeg, sporthal, thuisploeg_id, bezoekersploeg_id, stamnummer_thuisclub, stamnummer_bezoekersclub, ForfaitHoofd, uitslag_set_1, uitslag_set_2, uitslag_set_3, uitslag_set_4, uitslag_set_5, uitslagReserven, UitslagRes_set_1, UitslagRes_set_2, UitslagRes_set_3, postponed) VALUES ('$nr', '$date', '$aanvangsuur', '$reeks', '$reeksid', '$thuisploeg', '$bezoekersploeg', '$sporthal', '$thuisploeg_id', '$bezoekersploeg_id', '$stamnummer_thuisclub', '$stamnummer_bezoekersclub', '$ForfaitHoofd', '$uitslag_set_1', '$uitslag_set_2', '$uitslag_set_3', '$uitslag_set_4', '$uitslag_set_5', '$uitslagReserven', '$UitslagRes_set_1', '$UitslagRes_set_2', '$UitslagRes_set_3', '$postponed')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error . "</br>";
}
}


$conn->close();

?>

{/source}
