	</body>
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
		jQuery(function(){
			$("#designer-info-update").click(function(){

				$ajax_url = "<?php echo base_url().'ajax/designer_info_update'; ?>";
				$.ajax({
					type: "post",
					url: $ajax_url,
					data: $("#designer-info-form").serialize(),
					success: function(res) {
						//alert(res);
						$( ".ajax-error-debug" ).html( res );
						//location.reload();
					},
					error: function( xhr, ajaxOptions, thrownError ) {
						alert(thrownError);
						$( ".ajax-error-debug" ).html( res );
					}
				});
			});

			$('.left-bar > .left-row > a').click(function( event ){
				event.preventDefault();
				// hide current content.
				var active_selector_id = $('.left-bar > .left-row > a.active').attr('href');
				$(active_selector_id).removeClass('active');
				$(active_selector_id).addClass('hide');
				// de-active current nav.
				var active_nav = $('.left-bar > .left-row > a.active');
				active_nav.removeClass('active');

				// show the clicked content.
				var target_selector_id = $(this).attr('href');
				$(target_selector_id).removeClass('hide');
				$(target_selector_id).addClass('active');
				//$(target_selector_id).toggle(400);
				// active clicked nav
				$(this).addClass('active');

			});
			/*
			$("#designer-info-btn").click(function(event){
				event.preventDefault();
				// toggle up others, toggle down designer-info-design
				$("#designer-upload").hide();
				$("")
				$("#designer-info").slideDown(400);
			});

			$("#designer-upload-btn").click(function(event){
				event.preventDefault();
				// toggle up others, toggle down designer-upload-design
				$("#designer-info").hide();
				$("#designer-upload").slideDown(400);
			});
			*/
		});
	</script>
</html>