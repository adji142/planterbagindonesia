<!--
	Author: W3layouts
	Author URL: http://w3layouts.com

	Modifier : Aji AISTrick
	Modifier URL : http://aistrick.com/
-->
<?php 
	$last = $this->uri->total_segments();
	$record_num = $this->uri->segment($last);
	$contact = "";
	$home = "";
	$produk = "";
	$order = "";
	$about = "";
	switch ($record_num) {
		case 'contact':
			$contact = "active";
			break;
		case 'about':
			$about = "active";
			break;
		case 'home':
				$home = "active";
			break;
		case 'produk':
			$produk = "active";
			break;
		case 'order':
			$order = "active";
			break;
		default:
			$home = "active";
			break;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta tags -->
	<title>Planterbag Indonesia</title>
	<meta name="keywords" content="Realbuild a Realestate Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- stylesheets -->
	<link rel="stylesheet" href="<?php echo base_url() ?>Assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>Assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>Assets/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>Assets/css/style.css">

	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,700i,800,900" rel="stylesheet">
	<!-- scripts -->
	<script src="<?php echo base_url() ?>Assets/js/jquery.min.js"></script>

	<!-- Sweet alert -->
	<script src="<?php echo base_url();?>Assets/root/sweetalert2-8.8.0/package/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/sweetalert2-8.8.0/package/dist/sweetalert2.min.css">
</head>
<style>
	div.sticky {
	  position: -webkit-sticky;
	  position: sticky;
	  top: 0;
	  /*padding: 50px;
	  font-size: 20px;*/
	}
</style>
<body>
	<div class="sticky">
	<div class="video-responsive">
		<video class="video" muted="muted" loop="loop" autoplay="autoplay">
			<source src="<?php echo base_url() ?>Assets/video/real2.mp4" type="video/mp4">
			Your browser does not support HTML5 video.
		</video>

		<canvas class="canvas"></canvas>

		<div id="over_video">
			<div class="bg-mask">
				<nav class="navbar w3-navbar">
					<div class="navigation-overlay">
						<div class="container-fluid">
							<div class="row">

								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>

									<!-- Logo -->
									<div class="logo-container">
										<div class="logo-wrap">
											<a href="#home" class="scroll">
												<img src="<?php echo base_url();?>/Assets/images/logo.png" width = '50%'>
												Planterbag Indonesia
											</a>
										</div>
									</div>
								</div> <!-- end navbar-header -->


								<div class="col-md-8 col-xs-12 nav-wrap">
									<div class="collapse text-center navbar-collapse w3ls-nav navbar-collapse">

										<ul class="nav navbar-nav w3ls-nav1 text-center">

											<li class="<?php echo $home; ?>">
												<a href="<?php echo base_url() ?>">Home</a>
											</li>
											<li class="<?php echo $about; ?>">
												<a href="<?php echo base_url() ?>about">About</a>
											</li>
											<li class="<?php echo $produk; ?>">
												<a href="<?php echo base_url() ?>produk">Produk</a>
											</li>
											<li class="<?php echo $order; ?>">
												<a href="<?php echo base_url() ?>order">Order</a>
											</li>
											<li class="<?php echo $contact; ?>">
												<a href="<?php echo base_url() ?>contact">Contact</a>
											</li>

										</ul>
									</div>
								</div> <!-- end col -->
							</div> <!-- end row -->
						</div> <!-- end container -->
					</div> <!-- end navigation -->
				</nav> <!-- end navbar -->
			</div>
		</div>
	</div>
	</div>
	<style>
		.video-responsive {
			padding-bottom: 325px;
			/*position: relative;*/
			width: 100%;
		}

		.canvas,
		.video {
			left: 0;
			position: absolute;
			top: 0;
			background: #000;
			z-index: 5;
			overflow: hidden;
			width: 100%;
			height: 325px;
			object-fit: cover;
		}

		#over_video {
			position: absolute;
			width: 100%;
			height: 325px;
			text-align: center;
			top: 0;
			z-index: 5;
			color: #FFF;
		}
		@media screen and (max-width: 1280px) {
			.video-responsive {
				padding-bottom: 325px;
			}
			.canvas,
			.video {
				height: 325px;
			}
		}
		@media screen and (max-width: 1080px) {
			.video-responsive {
				padding-bottom: 300px;
			}
			.canvas,
			.video {
				height: 300px;
			}
		}
		@media screen and (max-width: 568px) {
			.video-responsive {
				padding-bottom: 275px;
			}
			.canvas,
			.video {
				height: 275px;
			}
		}
	</style>

	<script src="<?php echo base_url() ?>Assets/js/canvas-video-player.js"></script>


	<script>
		var isIOS = /iPad|iPhone|iPod/.test(navigator.platform);

		if (isIOS) {

			var canvasVideo = new CanvasVideoPlayer({
				videoSelector: '.video',
				canvasSelector: '.canvas',
				timelineSelector: false,
				autoplay: true,
				makeLoop: true,
				pauseOnClick: false,
				audio: false
			});

		} else {

			// Use HTML5 video
			document.querySelectorAll('.canvas')[0].style.display = 'none';

		}
	</script>