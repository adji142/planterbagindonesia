<div class="agileits-w3layouts">
	<div class="container">
		<p>© 2019 Realbuild. All rights reserved | Design by <a href=" http://aistrick.com/">AISTrick</a></p>
	</div>
</div>

<script src="<?php echo base_url() ?>Assets/js/bootstrap.min.js"></script>


<!-- smooth scrolling -->
<script src="<?php echo base_url() ?>Assets/js/SmoothScroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>Assets/js/move-top.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>Assets/js/easing.js"></script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
	$(document).ready(function () {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear'
			};
		*/

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<!-- //here ends scrolling icon -->
<!-- smooth scrolling -->

<!-- scrolling script -->
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$(".scroll").click(function (event) {
			event.preventDefault();
			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000);
		});
	});
</script>
<!-- //scrolling script -->

</body>

</html>