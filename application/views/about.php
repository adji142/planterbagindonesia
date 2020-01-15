<?php
    require_once(APPPATH."views/parts/header_video.php");
?>
	<section class="py-5 team-w3ls" id="best">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-w3 pt-sm-5 mb-5 text-wh font-weight-bold">About Us<br>
					<span>About Planterbag Indonesia</span></h3>

			<?php
				$dataabout = $this->db->query("SELECT * FROM siteabout where active = 1 limit 1")->row();
			?>
			<div class="d-md-flex">
				<div class="col-md-6"  style="z-index: -1;">
					<img style="width: 100%;" src="<?php echo $dataabout->imageabout; ?>" >
				</div>
				<div class="col-md-6"  style="z-index: -1;">
					<h3>
						<?php echo $dataabout->headline; ?>
					</h3>
					<p>
						<?php echo $dataabout->id_desc; ?>
					</p>
				</div>
			</div>
		</div>
	</section>
<?php
    require_once(APPPATH."views/parts/footer.php");
?>