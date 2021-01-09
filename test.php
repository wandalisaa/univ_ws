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

$sparql = new EasyRdf_Sparql_Client('https://query.wikidata.org/');

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Universitas</title>

  <style media="screen">
  #mapid { height: 600px; }
  </style>

</head>

<body>

	<h1>Universitas</h1>

<?php
  $result3 = $sparql->query('
  SELECT DISTINCT ?item ?kotaLabel ?foto ?itemLabel
  WHERE{
       ?item wdt:P31 wd:Q3918.
       ?item wdt:P17 wd:Q252.
                 ?item wdt:P131 ?kota.
       OPTIONAL {
       ?item wdt:P154 ?foto .
 }
       SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],id". } 
     }
  ');
?>

<br>
<?php foreach ($result3 as $data): ?>
  <b><?=$data->itemLabel;?></b>
  <b><?=$data->namaKota;?></b>
<?php endforeach ?>

<div id="mapid" class="map map-home"></div>


</body>
</html>
