	</body>
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
		var men_category = '{ \
			"clothing":["beachwear", "coats", "denim", "jackets", "polo shirts", "shirts", "shorts", "suits", "sweater&knitwear", "trousers", "t-shirts&vests", "other"], \
			"shoes": ["hi-top", "loafers", "boots", "other"], \
			"bags": ["backpacks", "totes", "shoulder bags", "other"], \
			"accessories": ["belts", "hats", "sunglasses", "other"] \
		}';
		var women_category = '{ \
			"clothing":["all in one", "beachwear", "coats", "denim", "dresses", "jackets", "knitwear", "shorts", "skirts", "suits", "tops", "trousers", "other"], \
			"shoes": ["trainers", "boots", "pumps", "other"], \
			"bags": ["totes", "cluthes", "shoulder bags", "other"], \
			"accessories": ["belts", "hats", "sunglasses", "other"] \
		}';
		men_category = JSON.parse( men_category );
		women_category = JSON.parse( women_category );
		console.log( women_category );
		console.log( women_category["clothing"]);
		console.log( women_category["bags"][0] );

		jQuery(function(){
			$(document).ready(function(){
				check_gender();
				check_item_type();
			});

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

			$("#gender").change(function() {
				check_gender();
				check_item_type();
			});

			$("#category").change(function(){
				gender = $("#gender").val();
				category = $("#category").val();
				check_item_type( gender, category );
			});

			var check_gender = function() {
				gender = $("#gender").val();
				if( gender == "men" ) {
					$("#category").html(" \
						<option value='clothing' selected='selected'> clothing </option> \
						<option value='shoes'> shoes </option> \
						<option value='bags'> bags </option> \
						<option value='accessories'> accessories </option> \
					");
					/*
					console.log( men_category["clothing"],length );
					for( i=0; i < men_category["clothing"].length; i++) {
						$("#item-type").append(" \
							<option>"+men_category["clothing"][i]+"</option> \
						");
					}
					*/
				} else {
					$("#category").html(" \
						<option value='clothing' selected='selected'> clothing </option> \
						<option value='shoes'> shoes </option> \
						<option value='bags'> bags </option> \
						<option value='accessories'> accessories </option> \
					");
				}
			}

			var check_item_type = function() {
				gender = $("#gender").val();
				category = $("#category").val();
				if( gender == "men" ) {
					for( var key in men_category ) {
						if ( key == category ) {
							$("#item-type").html("");
							for( i=0; i < men_category[key].length; i++) {
								$("#item-type").append(" \
									<option>"+men_category[key][i]+"</option> \
								");
							}
						}
					}
				}else {
					for( var key in women_category ) {
						if ( key == category ) {
							$("#item-type").html("");
							for( i=0; i < women_category[key].length; i++) {
								$("#item-type").append(" \
									<option>"+women_category[key][i]+"</option> \
								");
							}
						}
					}
				}
			}
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