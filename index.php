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
EasyRdf_Namespace::set('dbr', 'http://dbpedia.org/resource/');
$sparql = new EasyRdf_Sparql_Client('http://linkeddata.uriburner.com/sparql/');
$wiki = new EasyRdf_Sparql_Client('https://query.wikidata.org/sparql');
$result1 = $sparql->query('
SELECT DISTINCT * WHERE {
  ?negara rdf:type yago:WikicatMemberStatesOfTheUnitedNations.
} ORDER BY ASC(?negara)
');
$public = $sparql->query('
SELECT DISTINCT ?item ?id ?namaKota ?foto ?namaUniv ?link
{ 
SERVICE <http://query.wikidata.org/sparql> 
{ SELECT * WHERE{
  		?item wdt:P31 wd:Q3918.
		  ?item wdt:P17 wd:Q252.
		  OPTIONAL {
			?item wdt:P154 ?foto .
}
  		?item wdt:P856 ?link.
  		SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". } 
  	}
}
SERVICE <http://dbpedia.org/sparql>
{ SELECT  *
  WHERE
  { ?name dbpedia-owl:wikiPageExternalLink ?link .
    ?name dbo:type dbr:Public_university .
    ?name dbo:wikiPageID ?id .
    ?name rdfs:label ?namaUniv .
OPTIONAL {
    ?name dbo:thumbnail ?foto .
    ?name dbo:city  ?kota .
    ?kota foaf:name ?namaKota
} filter langMatches(lang(?namaUniv),"en")
} } } LIMIT 8
');
$private = $sparql->query('
SELECT DISTINCT ?item ?id ?namaKota ?foto ?namaUniv ?link
{ 
SERVICE <http://query.wikidata.org/sparql> 
{ SELECT * WHERE{
  		?item wdt:P31 wd:Q3918.
		  ?item wdt:P17 wd:Q252.
		  OPTIONAL {
			?item wdt:P154 ?foto .
}
  		?item wdt:P856 ?link.
  		SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". } 
  	}
}
SERVICE <http://dbpedia.org/sparql>
{ SELECT  *
  WHERE
  { ?name dbpedia-owl:wikiPageExternalLink ?link .
    ?name dbo:type dbr:Private_university .
    ?name dbo:wikiPageID ?id .
    ?name rdfs:label ?namaUniv .
OPTIONAL {
    ?name dbo:thumbnail ?foto .
    ?name dbo:city  ?kota .
    ?kota foaf:name ?namaKota
} filter langMatches(lang(?namaUniv),"en")
} } } LIMIT 8
');
$result3 = $sparql->query('
SELECT DISTINCT ?item ?itemLabel ?lokasi ?link
{ 
SERVICE <http://query.wikidata.org/sparql> 
{ SELECT ?item ?itemLabel ?lokasi ?link WHERE{
	  ?item wdt:P31 wd:Q3918.
	  ?item wdt:P17 wd:Q252.
	  ?item wdt:P625 ?lokasi.
	  ?item wdt:P856 ?link.
	  SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". bd:serviceParam wikibase:language "[AUTO_LANGUAGE],id". } 
	}
}
SERVICE <http://dbpedia.org/sparql>
{ SELECT  *
  WHERE
  { 
      OPTIONAL{
     ?name dbpedia-owl:wikiPageExternalLink ?link .
     }
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
<!DOCTYPE html>
<html lang="zxx" class="no-js">

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
  #mapid { height: 600px;     z-index: 1;}
  </style>
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.php"><img 	src="img/logo.png" alt="" width="150"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
							<li class="nav-item"><a class="nav-link" href="category.php">Universities</a></li>
							<li class="nav-item"><a class="nav-link" href="contact.php">Compare</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content pt-4">
									<h1 data-aos="fade-up" data-aos-duration="2000">Find Out About Universities</h1>
									<p>Displays university in Indonesia including public and private universities.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href="category.php"><span class="lnr lnr-magnifier"></span></a>
										<span class="add-text text-uppercase">See all universities</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img" data-aos="fade-up"
								data-aos-easing="linear"
								data-aos-duration="1500">
									<img class="img-fluid" src="img/banner/illustration.svg" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide">
							<div class="col-lg-5 pt-5">
								<div class="banner-content pt-5">
									<h1>Compare Universities</h1>
									<p>Select the Compare menu and look for the university you want to compare.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href="category.php"><span class="lnr lnr-magnifier"></span></a>
										<span class="add-text text-uppercase">See all universities</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/banner//illustration1.svg" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->
	<div class="container mt-5">
		<div class="row justify-content-center" data-aos="fade-up"
		data-aos-duration="2000">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h1>Universities in Indonesia</h1>
					<!-- <p>A public university or public college is a university or college that is in state ownership or receives significant public funds through a national or subnational government, as opposed to a private university.</p> -->
				</div>
			</div>
		</div>
		<!-- <div data-aos="fade-up"
		data-aos-duration="3000" id="mapBox" class="mapBox mt-1" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
		data-mlat="40.701083" data-mlon="-74.1522848">
	   </div> -->
	   <div id="mapid" class="map map-home"></div>
	</div>
	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center" data-aos="fade-up"
				data-aos-duration="2000">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Public University</h1>
							<p>A public university or public college is a university or college that is in state ownership or receives significant public funds through a national or subnational government, as opposed to a private university.</p>
						</div>
					</div>
				</div>
				<div class="row">
				<?php foreach($public as $data): ?>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product" data-aos="fade-up"
						data-aos-duration="1000">
				      <?php if(!empty($data->foto)): ?>
							<img class="img-fluid m-auto" src="<?=$data->foto?>" alt="">
					<?php else: ?>
						<img class="img-fluid m-auto" src="img/product/default.png" alt="" >
					<?php endif ?>
							<div class="product-details px-3">
								<h6><?=$data->namaUniv?></h6>
								<div class="price">
								<?php if(!empty($data->namaKota)): ?>
									<h6><?=$data->namaKota?></h6>
								<?php endif ?>
									<!-- <h6 class="l-through">$210.00</h6> -->
								</div>
								<div class="prd-bottom">
									<a href="single-product.php?id=<?php echo $data->item; ?>" class="social-info">
										<span class="lnr lnr-eye"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>

				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Private University</h1>
							<p>Private universities (and private colleges) are usually not operated by governments, although many receive tax breaks, public student loans, and grants. Depending on their location, private universities may be subject to government regulation.</p>
						</div>
					</div>
				</div>
				<div class="row">
				<?php foreach($private as $data): ?>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product" data-aos="fade-up"
						data-aos-duration="1000">
				      <?php if(!empty($data->foto)): ?>
							<img class="img-fluid m-auto" src="<?=$data->foto?>" alt="">
					<?php else: ?>
						<img class="img-fluid m-auto" src="img/product/default.png" alt="" >
					<?php endif ?>
							<div class="product-details px-3">
								<h6><?=$data->namaUniv?></h6>
								<div class="price">
								<?php if(!empty($data->namaKota)): ?>
									<h6><?=$data->namaKota?></h6>
								<?php endif ?>
									<!-- <h6 class="l-through">$210.00</h6> -->
								</div>
								<div class="prd-bottom">
									<a href="single-product.php?id=<?php echo $data->item; ?>" class="social-info">
										<span class="lnr lnr-eye"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->
	<!-- Author -->
	<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h1>Group Member</h1>
					<p>Mata Kuliah Web Semantik KOM A 2020/2021</p>
				</div>
			</div>
		</div>
			<div class="row">
			<div class="col-lg-3 col-6">
				<aside class="single_sidebar_widget author_widget text-center ">
					<div data-aos="fade-up"
					data-aos-duration="1000" class="author_img m-auto mb-3" style="background-image: url(img/blog/wanda.png);" alt="" width="100" height="100"></div>
					<h4 class="mt-3">Wanda Khalishah</h4>
					<p>191402076</p>
					<div class="br"></div>
				</aside>
			</div>
			<div class="col-lg-3 col-6">
				<aside class="single_sidebar_widget author_widget text-center ">
					<div data-aos="fade-up"
					data-aos-duration="2000" class="author_img m-auto mb-3"  style="background-image: url(img/blog/nurul.png);" alt=""  width="100" height="100"></div>
					<h4 class="mt-3">Nurul Atiqah</h4>
					<p>191402010</p>
					<div class="br"></div>
				</aside>
			</div>
			<div class="col-lg-3 col-6">
				<aside class="single_sidebar_widget author_widget text-center ">
					<div data-aos="fade-up"
					data-aos-duration="2500" class="author_img m-auto mb-3"  style="background-image: url(img/blog/zami.jpeg);"alt=""  width="100" height="100"></div>
					<h4 class="mt-3">Firdaus Zamzami</h4>
					<p>191402034</p>
					<div class="br"></div>
				</aside>
			</div>
			<div class="col-lg-3 col-6">
				<aside class="single_sidebar_widget author_widget text-center ">
					<div data-aos="fade-up"
					data-aos-duration="3000" class="author_img m-auto mb-3"  style="background-image: url(img/blog/rian.png);"alt=""  width="100" height="100"></div>
					<h4 class="mt-3">Tazrian Husna</h4>
					<p>191402028</p>
					<div class="br"></div>
				</aside>
			</div>
		</div>
	</div>
	
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
	<script src="js/countdown.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
		AOS.init();
	  </script>
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