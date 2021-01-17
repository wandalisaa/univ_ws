<?php
require_once realpath(__DIR__.'')."/vendor/autoload.php";
require_once __DIR__."/html_tag_helpers.php";

\EasyRdf\RdfNamespace::set('wd', 'http://www.wikidata.org/entity/');
\EasyRdf\RdfNamespace::set('wdt', 'http://www.wikidata.org/prop/direct/');
\EasyRdf\RdfNamespace::set('wikibase', 'http://wikiba.se/ontology#');


$sparql = new \EasyRdf\Sparql\Client('https://query.wikidata.org/sparql');

$semuaUniv = $sparql->query('
SELECT DISTINCT ?item ?itemLabel ?foundingdate
 WHERE{
  		?item wdt:P31 wd:Q3918.
		  ?item wdt:P17 wd:Q252.
		?item wdt:P571 ?foundingdate
  		SERVICE wikibase:label { bd:serviceParam wikibase:language "[AUTO_LANGUAGE],id". bd:serviceParam wikibase:language "[AUTO_LANGUAGE],en". } 
  	}
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
	<link rel="stylesheet" href="css/selectize.css" type="text/css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

	
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
							<li class="nav-item"><a class="nav-link" href="profil.php">More Info</a></li>
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
				<form class="d-flex justify-content-between" method="post" action="search.php">
					<input type="text" class="form-control" id="search_input" name="keyword" placeholder="Enter a city name... Example : makassar">
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
					<h1>Information</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="compare.php">Info</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
<div class="container">
<h2>DISCOGRAPHY TIMELINE</h2>

<?php

	$univ_timeline = [];
	foreach ($semuaUniv as $row) {

		if (isset($row->foundingdate) && strlen($row->foundingdate) >= 8) {
			$tmp['univ'] = $row->itemLabel;
			$tmp['tahun'] = date("Y", strtotime($row->foundingdate));
			$tmp['bulan'] = date("m", strtotime($row->foundingdate));
			$tmp['hari'] = date("d", strtotime($row->foundingdate));
			$univ_timeline[] = $tmp;
		}
	}
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="timeline" style="height: 480px;"></div>

<script>
google.charts.load('current', {'packages':['timeline']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var container = document.getElementById('timeline');
  var chart = new google.visualization.Timeline(container);
  var dataTable = new google.visualization.DataTable();

  dataTable.addColumn({ type: 'string', id: 'No' });
  dataTable.addColumn({ type: 'string', id: 'Name' });
  dataTable.addColumn({ type: 'date', id: 'Start' });
  dataTable.addColumn({ type: 'date', id: 'End' });
  dataTable.addRows([
	<?php
	$j = count($univ_timeline);
	for ($i=0;$i<$j;$i++) {
	  if ($i+1 >= $j) {
		?>
		  [ "<?= $i+1 ?>", "<?= $univ_timeline[$i]['univ'] ?>", new Date(<?= $univ_timeline[$i]['tahun'] ?>, <?= $univ_timeline[$i]['bulan'] ?>, <?= $univ_timeline[$i]['hari'] ?>), new Date(<?= $univ_timeline[$i]['tahun'] ?>, <?= $univ_timeline[$i]['bulan'] ?>, <?= $univ_timeline[$i]['hari'] ?>) ],
		<?php
	  } else {
		?>
		  [ "<?= $i+1 ?>", "<?= $univ_timeline[$i]['univ'] ?>", new Date(<?= $univ_timeline[$i+1]['tahun'] ?>, <?= $univ_timeline[$i+1]['bulan'] ?>, <?= $univ_timeline[$i+1]['hari'] ?>), new Date(<?= $univ_timeline[$i]['tahun'] ?>, <?= $univ_timeline[$i]['bulan'] ?>, <?= $univ_timeline[$i]['hari'] ?>) ],
		<?php
	  }
	}
	?>
	  ]);

  chart.draw(dataTable);
}
</script>
</div>
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-12 col-12 product_description_area" data-aos="fade-down">
			<div class="s_product_text justify-content-center text-center">
				<h3>UNIVERSITY</h3>
				<h2>Information</h2>
			</div>
			<table class="table table-striped" id="mytable">
				<thead>
					<tr>
					<th scope="col">No</th>
					<th scope="col">University</th>
					<th scope="col">Accreditation</th>
					<th scope="col">Number of Study Program</th>
					</tr>
				</thead>
				<tbody>
				<?php $no=1;
				$dataset = \EasyRdf\Graph::newAndLoad('http://localhost/univ_ws/univ.rdf');
				$docs = $dataset->primaryTopic();

				foreach ($docs->all('foaf:consists') as $key ) {  ?>
					<tr>
						<th scope="row"><?=$no; $no++;?></th>
						<td><?=$key->get('foaf:name');?></td>
						<td><?=$key->get('foaf:akreditasi');?></td>
						<td><?=$key->get('foaf:jurusan');?></td>
					</tr>
					<?php
						} ?>
				</tbody>
				</table>
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
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
	<script>
		AOS.init();

		$(document).ready( function () {
    $('#mytable').DataTable();
} );
	  </script>
</body>

</html>