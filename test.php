<!DOCTYPE html>
<html lang="zxx" class="no-js">
<?php
 //error_reporting(0);

require_once realpath(__DIR__.'')."/vendor/autoload.php";
require_once __DIR__."/html_tag_helpers.php";

\EasyRdf\RdfNamespace::set('wd', 'http://www.wikidata.org/entity/');
\EasyRdf\RdfNamespace::set('wdt', 'http://www.wikidata.org/prop/direct/');
\EasyRdf\RdfNamespace::set('wikibase', 'http://wikiba.se/ontology#');
\EasyRdf\RdfNamespace::set('p', 'http://www.wikidata.org/prop/');
\EasyRdf\RdfNamespace::set('ps', 'http://www.wikidata.org/prop/statement/');
\EasyRdf\RdfNamespace::set('pq', 'http://www.wikidata.org/prop/qualifier/');
\EasyRdf\RdfNamespace::set('bd', 'http://www.bigdata.com/rdf#');
\EasyRdf\RdfNamespace::set('owl', 'http://www.w3.org/2002/07/owl#');
\EasyRdf\RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
\EasyRdf\RdfNamespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
\EasyRdf\RdfNamespace::set('dct', 'http://purl.org/dc/terms/');
\EasyRdf\RdfNamespace::set('dbpedia-owl', 'http://dbpedia.org/ontology/');

\EasyRdf\RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('geo', 'http://www.w3.org/2003/01/geo/wgs84_pos#');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');

$sparql = new \EasyRdf\Sparql\Client('http://linkeddata.uriburner.com/sparql/');
$result = $sparql->query('
SELECT ?itemLabel ?lokasi  ?link ?tipe ?kotaLabel ?foto ?fb ?berdiri ?rektor ?desk ?comen
{ 
SERVICE <http://query.wikidata.org/sparql> 
{ SELECT ?item ?itemLabel ?lokasi ?link ?foto ?kotaLabel ?fb ?berdiri WHERE{
	  ?item wdt:P31 wd:Q3918.
	  ?item wdt:P17 wd:Q252.
	  ?item wdt:P131 ?kota.
      OPTIONAL{
      ?item wdt:P154 ?foto.
	  }
      OPTIONAL{
      ?item wdt:P571 ?berdiri.
	  }
	  OPTIONAL{
		?item wdt:P2013 ?fb.
		}
		OPTIONAL{
			?item wdt:P856 ?link.
			}
	  ?item wdt:P625 ?lokasi.
      FILTER(?item = wd:Q8045825)
	  SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". bd:serviceParam wikibase:language "[AUTO_LANGUAGE],id". } 
	}
}
SERVICE <http://dbpedia.org/sparql>
{ SELECT  *
  WHERE
  { 
      OPTIONAL{
     ?name dbpedia-owl:wikiPageExternalLink ?link .
        OPTIONAL{?name dbo:type ?type .
          ?type rdfs:label ?tipe.}
        OPTIONAL{?name dbo:abstract ?desk.}
        OPTIONAL{?name rdfs:comment ?comen.}
        OPTIONAL{?name dbp:rector ?rektor.}
      }
      filter langMatches(lang(?tipe),"en")
      filter langMatches(lang(?desk),"en")
      filter langMatches(lang(?comen),"en")
} } } LIMIT 1

');
foreach ($result as $key2):
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

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>University Check</title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>

  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   <style media="screen">
  #mapid { height: 400px;     z-index: 1;}
  </style>
</head>

<body>
<?php foreach($result as $data): 

	 if (isset($data->berdiri)) {
		$array = array('berdiri'=>str_replace('T00:00:00Z', '', ucwords($data->berdiri)));
	 }
	?>

	<!--================Product Description Area =================-->
	<section class="product_description_area" data-aos="fade-down" data-aos-duration="2000">
		<div class="container">
			<!-- <div  id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
			data-mlat="40.701083" data-mlon="-74.1522848">
		   </div> -->
		   <div id="mapid" class="map map-home"></div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
	<?php endforeach ?>
	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Tugas Besar Web Semantik 2020/2021</h6>
						<p>
							Menampilkan data universitas dari wikidata dan dbpedia dan mengintegrasi kan data tersebut dengan dataset sendiri
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

	<script>
		AOS.init();
	  </script>
<script type="text/javascript">

var map = L.map('mapid').setView([<?php echo $array6["lat"]; ?>, <?php echo $array6["long"]; ?>], 5);



L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

<?php 
foreach ($result as $key2):
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

var marker = L.marker([<?php echo $array6["lat"]; ?>, <?php echo $array6["long"]; ?>]).addTo(map);
<?php if (isset($key2->namaUniv)) { ?>
	marker.bindPopup('<b><?php echo $key2->namaUniv; ?></b><br>').openPopup();
<?php } else { ?>
	marker.bindPopup('<b><?php echo $key2->itemLabel; ?></b><br>').openPopup();
<?php } ?>
<?php endforeach; ?>

</script>
</body>

</html>