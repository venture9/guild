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

			$("#designer-info-btn").click(function(event){
				event.preventDefault();
				// toggle up others, toggle down designer-info-design
				$("#designer-upload").hide();
				$("#designer-info").slideDown(400);
			});

			$("#designer-upload-btn").click(function(event){
				event.preventDefault();
				// toggle up others, toggle down designer-upload-design
				$("#designer-info").hide();
				$("#designer-upload").slideDown(400);
			});
		});
	</script>
</html>