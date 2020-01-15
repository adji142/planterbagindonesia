<?php
    require_once(APPPATH."views/parts/header_video.php");
    // require_once(APPPATH."views/parts/banner.php");
    // require_once(APPPATH."views/parts/about.php");
    // require_once(APPPATH."views/parts/top6product.php");
?>
		<section class="py-5 team-w3ls" id="best">
			<div class="container py-xl-5 py-lg-3">
				<h3 class="title-w3 pt-sm-5 mb-5 text-wh font-weight-bold">Best Product<br>
					<span>Our main Product</span></h3>
				
					<?php
						$dataproduct = $this->db->query("SELECT * FROM siteproduct where active = 1 limit 6")->result();
						$no = 1;
						$product = '';
						foreach ($dataproduct as $key) {
							if ($no ==1 && $no<=3) {
								$product .= '<div class="d-flex team-w3ls-row pt-xl-5 pt-md-3">';
							}
							if ($no >= 1 && $no <= 3) {
								$product.= '
										<div class="col-lg-4 col-sm-6 view" id = "'.$key->id.'">
											<div class="box20" style="z-index: -1;">
												<img src="'.$key->image.'" alt="'.$key->id_prodtitle.'" class="img-fluid" />
												<div class="box-content" style="z-index:999;">
													<h3 class="title">'.$key->id_prodtitle.'</h3>
												</div>
											</div>
										</div>
									';
									$no++;
							}
							if ($no==4) {
								$product .= '</div><br>';
								$no = 1;
							}
						}
						echo $product;
					?>
		</div>
	</section>
	<div class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="ModalView">
	  <div class="modal-dialog modal-xl modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title"><div id="title_mod"></div></h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>
	      <div class="modal-body">
	        <div class="container-fluid">
	        	<div class="row">
	        		<div id ="detail_content">
	        			
	        		</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
<?php
    // require_once(APPPATH."views/parts/contactus.php");
    require_once(APPPATH."views/parts/footer.php");
?>

<script type="text/javascript">
	$(function () {
		$.ajaxSetup({
	      beforeSend:function(jqXHR, Obj){
	          var value = "; " + document.cookie;
	          var parts = value.split("; csrf_cookie_token=");
	          if(parts.length == 2)   
	          Obj.data += '&csrf_token='+parts.pop().split(";").shift();
	      }
	    });
		$('.view').click(function () {
			var id = $(this).attr("id");
			var table = 'siteproduct';
			$.ajax({
				type : 'post',
				url : '<?=base_url()?>app/FindData',
				data: {id:id,table:table},
				dataType : 'json',
				success:function (response) {
					$.each(response.data,function (k,v) {
						$('#detail_content').append(""+
							"<img src='"+v.image+"'>"
						);
					});
					$('#ModalView').modal('show');
				}
			});
		});
	});
</script>