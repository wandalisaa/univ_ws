<?php
require_once "lib/EasyRdf.php";

EasyRdf_Namespace::set('wd', 'http://www.wikidata.org/entity/');
EasyRdf_Namespace::set('wdt', 'http://www.wikidata.org/prop/direct/');
EasyRdf_Namespace::set('wikibase', 'http://wikiba.se/ontology#');
EasyRdf_Namespace::set('p', 'http://www.wikidata.org/prop/');
EasyRdf_Namespace::set('ps', 'http://www.wikidata.org/prop/statement/');
EasyRdf_Namespace::set('pq', 'http://www.wikidata.org/prop/qualifier/');
EasyRdf_Namespace::set('bd', 'http://www.bigdata.com/rdf#');
EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
EasyRdf_Namespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
EasyRdf_Namespace::set('dct', 'http://purl.org/dc/terms/');
EasyRdf_Namespace::set('dbpedia-owl', 'http://dbpedia.org/ontology/');

EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
EasyRdf_Namespace::set('geo', 'http://www.w3.org/2003/01/geo/wgs84_pos#');

$sparql = new EasyRdf_Sparql_Client('http://linkeddata.uriburner.com/sparql/');

$result1 = $sparql->query('
SELECT DISTINCT * WHERE {
  ?negara rdf:type yago:WikicatMemberStatesOfTheUnitedNations.
} ORDER BY ASC(?negara)
');
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Universitas</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style media="screen">
  #mapid { height: 600px; }
  </style>

</head>

<body>

	<h1>Universitas</h1>

<?php
  $result3 = $sparql->query('
  SELECT DISTINCT ?item ?lokasi ?link ?namaUniv
  { 
  SERVICE <http://query.wikidata.org/sparql> 
  { SELECT * WHERE{
        ?item wdt:P31 wd:Q3918.
        ?item wdt:P17 wd:Q252.
        ?item wdt:P625 ?lokasi.
        ?item wdt:P856 ?link.
        SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". } 
      }
  }
  SERVICE <http://dbpedia.org/sparql>
  { SELECT *
    WHERE
    { ?name dbpedia-owl:wikiPageExternalLink ?link . 
      ?name foaf:name ?namaUniv . 
  } } }
  ');
  foreach ($result3 as $key2):
  $array2 = array('lokasi'=>str_replace('POINT', '', ucwords($key2->lokasi)));
  $array3 = array('lokasi' =>str_replace(')', '', ucwords($array2["lokasi"])));
  $array4 = array('lokasi' =>str_replace('(', '', ucwords($array3["lokasi"])));
  $array5 = array('lokasi' =>str_replace(' -', ' ', ucwords($array4["lokasi"])));
  $pattern = '/(\d+) (\d+).(\d+)/i'; 
  $replacement = '$1 '; 
  $pattern1 = '/(\d+).(\d+) /i';
  $replacement1 = '';
    
  // print output of function 
  $array6 = array(
    'long' => preg_replace($pattern, $replacement, $array5["lokasi"]),
    'lat' => preg_replace($pattern1, $replacement1, $array4["lokasi"])
  );
  // echo preg_replace($pattern, $replacement, $array5["lokasi"]).'<br>'; 
  // echo preg_replace($pattern1, $replacement1, $array4["lokasi"]).'<br>'; 
  // $array6 = $array5["lokasi"];
  // list($a, $b) = $array6;
  // $array6 = array('lokasi' =>str_replace('(', '', ucwords($array4["lokasi"])));
  // echo "Lat: $b Long: $a <br>";
  // echo $array5["lokasi"].'<br>';
  endforeach;

?>

<br>


<div id="mapid" class="map map-home"></div>

<script type="text/javascript">

var map = L.map('mapid').setView([<?php echo $array6["lat"]; ?>, <?php echo $array6["long"]; ?>], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

<?php 
 foreach ($result3 as $key2):
  $array2 = array('lokasi'=>str_replace('POINT', '', ucwords($key2->lokasi)));
  $array3 = array('lokasi' =>str_replace(')', '', ucwords($array2["lokasi"])));
  $array4 = array('lokasi' =>str_replace('(', '', ucwords($array3["lokasi"])));
  $array5 = array('lokasi' =>str_replace(' -', ' ', ucwords($array4["lokasi"])));
  $pattern = '/(\d+) (\d+).(\d+)/i'; 
  $replacement = '$1 '; 
  $pattern1 = '/(\d+).(\d+) /i';
  $replacement1 = '';
    
  // print output of function 
  $array6 = array(
    'long' => preg_replace($pattern, $replacement, $array5["lokasi"]),
    'lat' => preg_replace($pattern1, $replacement1, $array4["lokasi"])
  );
  
 ?>

L.marker([<?php echo $array6["lat"]; ?>, <?php echo $array6["long"]; ?>]).addTo(map);

<?php endforeach; ?>

</script>

</body>
</html>
