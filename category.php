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

$semuaUniv = $sparql->query('
SELECT DISTINCT ?id ?namaKota ?foto ?namaUniv
{ 
SERVICE <http://query.wikidata.org/sparql> 
{ SELECT * WHERE{
  		?item wdt:P31 wd:Q3918.
  		?item wdt:P17 wd:Q252.
  		?item wdt:P856 ?link.
  		SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". } 
  	}
}
SERVICE <http://dbpedia.org/sparql>
{ SELECT  *
  WHERE
  { ?name dbpedia-owl:wikiPageExternalLink ?link .

    ?name dbo:wikiPageID ?id .
    ?name rdfs:label ?namaUniv .
OPTIONAL {
    ?name dbo:thumbnail ?foto .
    ?name dbo:city  ?kota .
    ?kota foaf:name ?namaKota
} filter langMatches(lang(?namaUniv),"en")
} } }
');
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
							<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
							<li class="nav-item active"><a class="nav-link" href="category.php">Universities</a></li>
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

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first" data-aos="fade-up-left"
				data-aos-duration="2000">
					<h1>
						List of Universities <br> in Indonesia</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">University<span class=""></span></a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container my-3">
		<div class="row">
			<div class="btn-toolbar">
			  <div class="btn-group btn-group-sm">
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="100">A</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="200">B</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="300">C</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="400">D</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="500">E</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="600">F</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="700">G</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="800">H</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="900">I</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1000">J</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1100">K</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1200">L</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1300">M</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1400">N</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1500">O</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1600">P</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1700">Q</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1800">R</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="1900">S</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="2000">T</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="2100">U</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="2200">V</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="2300">W</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="2400">X</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="2500">Y</button>
				<button class="btn btn-default btn-alpha" data-aos="fade-up" data-aos-duration="2600">Z</button>
			  </div>
			</div>
		  </div>
		<div class="row">
			<div class="col-12">
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						<?php foreach($semuaUniv as $data): ?>
					<!-- single product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product" data-aos="fade-up"
						data-aos-duration="1000">
				      <?php if(isset($data->foto)): ?>
							<img class="img-fluid m-auto" src="<?=$data->foto?>" alt="">
					<?php else: ?>
						<img class="img-fluid m-auto" src="img/product/default.png" alt="" >
					<?php endif ?>
							<div class="product-details px-3">
								<h6><?=$data->namaUniv?></h6>
								<div class="price">
								<?php if(isset($data->namaKota)): ?>
									<h6><?=$data->namaKota?></h6>
								<?php endif ?>
									<!-- <h6 class="l-through">$210.00</h6> -->
								</div>
								<div class="prd-bottom">
									<a href="" class="social-info">
										<span class="lnr lnr-eye"></span>
										<p class="hover-text">view more</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>																
				</div>
				</section>
				<!-- End Best Seller -->
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
				<div class="col-lg-3  col-md-6 col-sm-6">
					
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
	<script>
		AOS.init();
	  </script>
</body>

</html>