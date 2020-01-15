<?php
    require_once(APPPATH."views/parts/header_video.php");
?>
	<section class="py-5 team-w3ls" id="best">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-w3 pt-sm-5 mb-5 text-wh font-weight-bold">About Us<br>
					<span>About Planterbag Indonesia</span></h3>

			<?php
				$dataabout = $this->db->query("SELECT * FROM siteproduct where active = 1")->result();
				foreach ($dataabout as $key) {
					echo '
						<div class="d-md-flex">
							<div class="col-md-3" style="z-index: -1;">
								<img style="width: 100%;" src="'.$key->image.'" >
							</div>
							<div class="col-md-9"  style="z-index: -1;">
								<h3>
									'.$key->id_prodtitle.'
								</h3>
								<p>
									'.$key->id_proddesc.'
								</p>
							</div>
						</div>
						<br>
					';	
				}
			?>
		</div>
	</section>
<?php
    require_once(APPPATH."views/parts/footer.php");
?>