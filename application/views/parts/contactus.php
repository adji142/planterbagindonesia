<div class="w3ls-contact" id="contact">
		<h3 class="center">Contact Us</h3>
		<div class="container">
			<form class="form-horizontal" enctype='multipart/form-data' id="SendEmail">
				<div class="form-input">
					<label>Name <span class="w3-star"> * </span> </label>
					<input type="text" name="name" id="name" placeholder="Your Name" required>
				</div>
				<div class="form-input">
					<label>Email <span class="w3-star"> * </span> </label>
					<input type="email" name="email" id="email" placeholder="Your Email" required>
				</div>
				<div class="form-input">
					<label>Phone <span class="w3-star"> * </span> </label>
					<input type="text" name="mobile" id="mobile" placeholder="Phone Number" required>
				</div>
				<div class="form-textarea">
					<label>Message <span class="w3-star"> * </span> </label>
					<textarea name="content" id="content" placeholder="Your Message" rows="5" cols="20" required></textarea>
				</div>
				<!-- <input type="Submit" value="Submit Message"> -->
				<button class="Submit" id="btn_SendEmail">Submit Message</button>
			</form>
			<!-- <div class="map">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d396368.68564402737!2d-94.8559081017095!3d39.09211671179675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c0f75eafe99997%3A0x558525e66aaa51a2!2sKansas+City%2C+MO%2C+USA!5e0!3m2!1sen!2sin!4v1509960130500"
					allowfullscreen></iframe>
			</div> -->
		</div>
		<?php
			$data_about = $this->ModelsExecuteMaster->FindData(array('active'=>1),'siteabout',"'order','asc'")->row();
		?>
		<div class="agile-contact1">
			<div class="container">

				<div class="address">
					<div class="add-phone">
						<span class="fa fa-phone" aria-hidden="true"></span>
						<p><?php echo $data_about->phone; ?></p>
						<p><?php echo $data_about->secphone; ?></p>
					</div>
					<div class="add-email">
						<span class="fa fa-envelope" aria-hidden="true"></span>
						<a href="mailto:<?php echo $data_about->email; ?>"> <?php echo $data_about->email; ?> </a>

					</div>
					<div class="add-area">
						<span class="fa fa-map-marker" aria-hidden="true"></span>
						<p><?php echo $data_about->address; ?></p>
					</div>
				</div>
				<h3 class="my-logo"> Planterbag Indonesia </h3>

				<div class="footer-icons">
					<ul class="icons1">
						<li><a href="#" class="w3ls-facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a></li>
						<li><a href="#" class="w3ls-twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
						<li><a href="#" class="w3ls-google"><span class="fa fa-google-plus" aria-hidden="true"></span></a></li>
						<li><a href="#" class="w3ls-pinterest"><span class="fa fa-pinterest-p" aria-hidden="true"></span></a></li>
						<li><a href="#" class="w3ls-dribbble"><span class="fa fa-dribbble" aria-hidden="true"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
  $(function () {
    var form_mode = '';
    var _URL = window.URL || window.webkitURL;
    $.ajaxSetup({
      beforeSend:function(jqXHR, Obj){
          var value = "; " + document.cookie;
          var parts = value.split("; csrf_cookie_token=");
          if(parts.length == 2)   
          Obj.data += '&csrf_token='+parts.pop().split(";").shift();
      }
    });
    $('#SendEmail').submit(function (e) {
        $('#btn_SendEmail').text('Tunggu Sebentar.....');
        $('#btn_SendEmail').attr('disabled',true);

	    e.preventDefault();
	    var me = $(this);
	      $.ajax({
	        type    :'post',
	        url     : '<?=base_url()?>app/addcontact',
	        data    : me.serialize(),
	        dataType: 'json',
	        success : function (response) {
	          if(response.success == true){
	            Swal.fire({
	              type: 'success',
	              title: 'Horay..',
	              text: response.message,
	              // footer: '<a href>Why do I have this issue?</a>'
	            }).then((result)=>{
	              location.reload();
	            });
	          }
	          else{
	            $('#modalBanner').modal('toggle');
	            Swal.fire({
	              type: 'error',
	              title: 'Woops...',
	              text: response.message,
	              // footer: '<a href>Why do I have this issue?</a>'
	            }).then((result)=>{
	              $('#btn_SendEmail').text('Save');
	              $('#btn_SendEmail').attr('disabled',false);
	            });
	          }
	        }
	      });
    });
  });
</script>