<?php

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
	<link rel="stylesheet" href="css/selectize.css" type="text/css">
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
							<li class="nav-item"><a class="nav-link" href="all.php">Universities</a></li>
							<li class="nav-item active"><a class="nav-link" href="compare.php">Compare</a></li>
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
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end"  data-aos="fade-up-left" data-aos-duration="2000">
				<div class="col-first">
					<h1>Compare</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="compare.php">Compare</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
<div class="container">
	<div class="box p-3 justify-content-center shadow-lg" style="
	margin-top: -50px;
    background-color: #ffffff;
    position: relative;">
		<div class="main-search-form" style="">
			<form method="post">
			<div class="form-row">
					<div class="col-md-5">
						<div class="form-group">
							<input name="jenis1" autocomplete="off" list="jenis1-1" type="text" class="my-auto form-control" id="jenis1" placeholder="Example : Universitas Sumatera Utara" value="<?php if(isset($_POST['jenis1'])){ echo $_POST['jenis1'];} ?>" required>
							<datalist id="jenis1-1">
								<?php foreach ($semuaUniv as $key) { ?>
									<option value="<?php echo $key->item; ?>"><?php echo $key->itemLabel; ?></option>
								<?php } ?>
							</datalist>
						</div>
						<!--end form-group-->
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<input name="jenis2" list="jenis2-2" type="text" class="my-auto form-control" id="jenis2" placeholder="Example : Institut Pertanian Bogor" autocomplete="off" value="<?php if(isset($_POST['jenis2'])){ echo $_POST['jenis2'];} ?>" required>
							<datalist id="jenis2-2">
								<?php foreach ($semuaUniv as $key) { ?>
									<option value="<?php echo $key->item; ?>"><?php echo $key->itemLabel; ?></option>
								<?php } ?>
							</datalist>
						</div>
						<!--end form-group-->
					</div>
					<!--end col-md-3-->
					<div class="col-md-2 checkout_btn_inner d-flex align-items-center ml-auto">
						<input type="submit" class="btn primary-btn w-100" value="Compare">
					</div>
					<!--end col-md-3-->
				
			</div>
				</form>
			<!--end form-row-->
		</div>
	</div>
</div>
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-6 col-12 product_description_area" data-aos="fade-down">
			<div class="s_product_text justify-content-center text-center">
				<h3>UNIVERSITY OF NORTH SUMATRA</h3>
				<h2>Public University</h2>
			</div>
			<div class="s_Product_carousel">
				<div class="single-prd-item">
					<img class="img-fluid" src="img/product/default.png" alt="">
				</div>
				<div class="single-prd-item">
					<img class="img-fluid" src="img/product/default.png" alt="">
				</div>
			</div>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile"
					 aria-selected="false">More Info</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade  show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
					<p>The University of Sumatera Utara (Indonesian: Universitas Sumatera Utara) or (USU) is a public university located in the city of Medan in North Sumatera, Indonesia. It is situated in Padang Bulan, in the Medan Baru subdistrict of Medan, close to the City Centre, with a total area of 122 hectares. Due to an increase in student numbers, a new campus is being constructed in Kwala Bekala, 15 km distant, with a 300 hectare campus area. Its rectors serve eight-year renewable terms. USU was established as a Foundation Universitet North Sumatera on June 4, 1952. The first is the Faculty of Medicine Faculty which was established on August 20, 1952, now commemorated as the anniversary USU. President of Indonesia, Sukarno then USU inaugurated as the seventh state university in Indonesia on November 20, 1957.</p>
				</div>
				<div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table w-100">
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
										<h5><a href=" http://www.usu.ac.id"> http://www.usu.ac.id</a></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Facebook Id</h5>
									</td>
									<td>
										<h5>usuofficial</h5>
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
		</div>
		<div class="col-lg-6 col-12 product_description_area"  data-aos="fade-down" data-aos-duration="3000">
			<div class="s_product_text justify-content-center text-center">
				<h3>UNIVERSITY OF NORTH SUMATRA</h3>
				<h2>Public University</h2>
			</div>
			<div class="s_Product_carousel">
				<div class="single-prd-item">
					<img class="img-fluid" src="img/product/default.png" alt="">
				</div>
				<div class="single-prd-item">
					<img class="img-fluid" src="img/product/default.png" alt="">
				</div>
			</div>
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
					<p>The University of Sumatera Utara (Indonesian: Universitas Sumatera Utara) or (USU) is a public university located in the city of Medan in North Sumatera, Indonesia. It is situated in Padang Bulan, in the Medan Baru subdistrict of Medan, close to the City Centre, with a total area of 122 hectares. Due to an increase in student numbers, a new campus is being constructed in Kwala Bekala, 15 km distant, with a 300 hectare campus area. Its rectors serve eight-year renewable terms. USU was established as a Foundation Universitet North Sumatera on June 4, 1952. The first is the Faculty of Medicine Faculty which was established on August 20, 1952, now commemorated as the anniversary USU. President of Indonesia, Sukarno then USU inaugurated as the seventh state university in Indonesia on November 20, 1957.</p>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table w-100">
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
										<h5><a href=" http://www.usu.ac.id"> http://www.usu.ac.id</a></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Facebook Id</h5>
									</td>
									<td>
										<h5>usuofficial</h5>
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
	<script src="js/selectize.min.js"></script>
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