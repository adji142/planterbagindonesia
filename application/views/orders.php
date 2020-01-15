<?php
    require_once(APPPATH."views/parts/header_video.php");
?>
	<section class="py-5 team-w3ls" id="best">
		<div class="container py-xl-5 py-lg-3">
			<h3 class="title-w3 pt-sm-5 mb-5 text-wh font-weight-bold">Cara Order<br>
					<span>Cara Order di Planterbag Indonesia</span></h3>

			<?php
				$dataabout = $this->db->query("SELECT * FROM thowtoorder where active = 1 limit 1")->row();
			?>
			<div class="d-md-flex">
				<div class="col-md-12"  style="z-index: -1;">
					<h4>
						<?php echo $dataabout->description; ?>
					</h4>
				</div>
			</div>
			<div class="d-md-flex">
				<div class="col-md-12" >
					<h3>
						<p>
							<center>Link Media Sosial dan Market place</center>
						</p>
						<p>
							<div class="col-md-12">
								<center>
									<a href="<?php echo $dataabout->toped; ?>" target="_blank">
										<img width="30%" src="<?php echo base_url(); ?>Assets/images/toped.png" alt="tokopedia platerbag indonesia">
									</a>
									<a href="<?php echo $dataabout->bukalapak; ?>" target="_blank">
										<img width="30%" src="<?php echo base_url(); ?>Assets/images/bl.png" alt="Bukalapak platerbag indonesia"> 
									</a>
									<a href="<?php echo $dataabout->shopee; ?>" target="_blank">
										<img width="30%" src="<?php echo base_url(); ?>Assets/images/shopee.png" alt="shopee platerbag indonesia">
									</a>
									<a href="<?php echo $dataabout->instagram; ?>" target="_blank">
										<img width="30%" src="<?php echo base_url(); ?>Assets/images/ig.png" alt="akun instagram platerbag indonesia">
									</a>
									<a href="<?php echo $dataabout->facebook; ?>" target="_blank">
										<img width="30%" src="<?php echo base_url(); ?>Assets/images/fb.png" alt="akun facebook platerbag indonesia | fanspage facebook Planterbag Indonesia">
									</a>
								</center>
							</div>
						</p>
					</h3>
				</div>
			</div>
		</div>
	</section>
<?php
    require_once(APPPATH."views/parts/footer.php");
?>