<!DOCTYPE html>
<html lang="zxx" class="no-js">
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

$sparql = new EasyRdf_Sparql_Client('https://query.wikidata.org/sparql');

$result = $sparql->query('
SELECT DISTINCT ?itemLabel ?lokasi  ?link ?tipe ?kotaLabel ?foto ?fb ?desk ?comen
{ 
SERVICE <http://query.wikidata.org/sparql> 
{ SELECT ?item ?itemLabel ?lokasi ?link ?foto ?kotaLabel WHERE{
	  ?item wdt:P31 wd:Q3918.
	  ?item wdt:P17 wd:Q252.
	  ?item wdt:P131 ?kota.
      OPTIONAL{
      ?item wdt:P154 ?foto.
	  }
	  OPTIONAL{
		?item wdt:P2013 ?fb.
		}
	  ?item wdt:P625 ?lokasi.
	  ?item wdt:P856 ?link.
      FILTER(?link = <http://www.usu.ac.id>)
	  SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". bd:serviceParam wikibase:language "[AUTO_LANGUAGE],id". } 
	}
}
SERVICE <http://dbpedia.org/sparql>
{ SELECT  *
  WHERE
  { 
      OPTIONAL{
     ?name dbpedia-owl:wikiPageExternalLink ?link .
     ?name dbo:type ?type .
     ?type rdfs:label ?tipe.
     ?name dbo:abstract ?desk.
     ?name rdfs:comment ?comen.
     }
      filter langMatches(lang(?tipe),"en")
      filter langMatches(lang(?desk),"en")
      filter langMatches(lang(?comen),"en")
} } }
');

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
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end" data-aos="fade-up-left" data-aos-duration="2000">
				<div class="col-first">
					<h1>University Detail</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.php">Universities<span class="lnr lnr-arrow-right"></span></a>
						<a href="#detail">product-details</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
<?php foreach($result as $data): ?>
	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
						<?php if (isset($data->foto)) { ?>
							<img class="img-fluid" src="<?=$data->foto?>" alt="">
						<?php } else { ?>
							<img class="img-fluid" src="img/product/default.png" alt="">
						<?php } ?>
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="img/product/default.png" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1" id="detail" data-aos="fade-down" data-aos-duration="2000">
					<div class="s_product_text">
						<h3><?=$data->itemLabel?></h3>
						<?php if (isset($data->tipe)) { ?>
							<h2><?=$data->tipe?></h2>
						<?php } ?>
						
						<ul class="list">
							<li><a class="active" href="#">
							<?php if (isset($data->kotaLabel)) { ?>
								<span>City</span> : <?=$data->kotaLabel?>
							<?php } ?>
							<span>City</span> : -
							</a></li>
							<li><a href="#"><span>Country</span> : Indonesia</a></li>
						</ul>
						<?php if (isset($data->comen)) { ?>
							<p><?=$data->comen?></p>
						<?php } else {?>
						<p>Not Found</p>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area" data-aos="fade-down" data-aos-duration="2000">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
					 aria-selected="false">More Info</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<?php if (isset($data->desk)) { ?>
							<p><?=$data->desk?></p>
						<?php } else {?>
						<p>Not Found</p>
						<?php } ?>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Founding Date</h5>
									</td>
									<td>
										<h5>4 Juni 1952</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Rector </h5>
									</td>
									<td>
										<h5>Prof. Dr. dr. Syahril Pasaribu, DTM&H, M.Sc. , Sp.A</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Number of majors </h5>
									</td>
									<td>
										<h5>23</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Akreditasi</h5>
									</td>
									<td>
										<h5>B</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Official Website</h5>
									</td>
									<td>
										<h5><a href="<?=$data->link?>"><?=$data->link?></a></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Facebook Id</h5>
									</td>
									<td>
									<?php if (isset($data->fb)) { ?>
										<?=$data->fb?>
									<?php } else {?>
									<p>Not Found</p>
									<?php } ?>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Motto</h5>
									</td>
									<td>
										<h5>Toward Excellence as University for Industry</h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div  id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
			data-mlat="40.701083" data-mlon="-74.1522848">
		   </div>
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
	<script>
		AOS.init();
	  </script>

</body>

</html>