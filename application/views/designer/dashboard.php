<?php
	$men_category = array();
	$men_clothing = ["beachwear", "coats", "denim", "jackets", "polo shirts", "shirts", "shorts", "suits", "sweater&knitwear", "trousers", "t-shirts&vests", "other"];
	$men_category["clothing"] = $men_clothing;
	$men_shoes = ["hi-top", "loafers", "boots", "other"];
	$men_category["shoes"] = $men_shoes;
	$men_bags = ["backpacks", "totes", "shoulder bags", "other"];
	$men_category["bags"] = $men_bags;
	$men_accessories = ["belts", "hats", "sunglasses", "other"];
	$men_category["accessories"] = $men_accessories;
	//p(json_encode($men_category));
	$men_category = json_encode($men_category);
	//p($men_category[0][0]);


?>
<div class="container designer-dashboard-container">
	<h3> <?php echo $designer_name; ?> </h3>

	<h5> Designer Name - <?php echo $designer_name; ?></h5>
	<h5> Designer Eamil - <?php echo $designer_email; ?></h5>
	<h5> Designer Boutique - <?php echo $designer_boutique; ?></h5>
	<h5> Item - <?php //echo $item_dir_path; ?></h5>

	<?php echo validation_errors('<p class="error">'); ?>
	<div class="catalog-container hidden">
		<h3>Placeholders for Dashboard</h3>
		<button class="btn btn-warning">New Catalog</button>

		<?php echo form_open_multipart( 'upload/catalog'); ?>

			<select name="choose_catalog" id="choose_catalog">
				<option value="default-select">Please select a Catalog</option>
			</select>
			<p>
				<label for="catalog_name">Catalog Name</label> <br />
				<input type="text" name="catalog_name" size="50" />
			</p>
			<p>
				<label for="cover_image"> Choose a cover image </label>
				<input type="file" name="cover_image" />
			</p>
			<p>
				<label for="tags"> Tags(use space to seperate) </label> <br />
				<input type="text" name="catalog_tags" size="50" />
			</p>
			<input type="submit" name="create-catalog-btn" value="Create Catalog" class="btn btn-warning"/>
		</form>
	</div>
	<hr />
	<!-- Left Menu -->
	<div class="left-bar col-md-4">
		<span class="left-row">
			<a href="#designer-info" id="designer-info-btn" class="left-row-item active">
				<h4>Your Profile</h4>
				<hr />
			</a>
		</span>
		<span class="left-row">
			<a href="#designer-upload" id="designer-upload-btn" class="left-row-item" >
				<h4>Upload Design</h4>
				<hr />
			</a>
		</span>
		<span class="left-row">
			<a href="#manage-store" id="manage-store-btn" class="left-row-item" >
				<h4>Manage Store</h4>
				<hr />
			</a>
		</span>
		<span class="left-row">
			<h4>Orders / History</h4>
			<hr />
		</span>
	</div>
	<!-- Left Menu Ends -->

	<!-- Right Menu -->
	<div class="right-container col-md-8">

		<div id="designer-info" class="desinger-block active">
			<h3> Your Profile </h3>
			<form action="<?php echo base_url().'designer/add_designer'; ?>" method="post" id="designer-info-form">
				<h2>Boutique Information</h2>
				<p>
					<label for="catalog_name">Boutique Name</label> <br />
					<input type="text" name="boutique_name" size="50" value="<?php echo $designer_boutique; ?>" />
				</p>

				<p>
					<label for="catalog_name">Boutique Description</label> <br />
					<textarea name="boutique_description" id="" cols="30" rows="10"><?php if( isset($boutique_description) ) echo $boutique_description; ?>
					</textarea>
				</p>
				<hr />

				<h2>Personal information</h2>
				<p>
					<label for="designer_name">Designer Name</label> <br />
					<input type="text" name="designer_name" size="50" value="<?php echo $designer_name; ?>" />
				</p>
				<p>
					<label for="catalog_name">Email</label> <br />
					<input type="text" name="designer_email" size="50" value="<?php echo $designer_email; ?>" />
				</p>
				<p>
					<label for="catalog_name">Phone</label> <br />
					<input type="text" name="designer_phone" size="50" value="<?php if(isset($designer_phone)) echo $designer_phone; ?>" />
				</p>

				<p>
					<label for="designer_name">Designer Description</label> <br />
					<textarea name="designer_description" id="" cols="30" rows="10"> <?php if(isset($designer_description)) echo $designer_description; ?>
					</textarea>
				</p>

				<input type="Button" name="create-catalog-btn" id="designer-info-update" value="Update" class="btn btn-success"/>
			</form>
			<div class="ajax-error-debug" style="height: 100px; color: orange;">


			</div>
		</div>

		<div id="designer-upload" class="designer-block hide">
			<h3> Upload your design </h3>
			<form action="<?php echo base_url().'designer/add/item'; ?>" method="post" enctype="">
				<p>
					<input type="hidden" name="designer_id" value="<?php echo $designer_id; ?>" size="50" />
				</p>
				<p>
					<label for="item_title">Title</label> <br />
					<input type="text" name="item_title" size="50" />
				</p>
				<p>
					<label for="item_sub_title">Sub Title</label> <br />
					<input type="text" name="item_sub_title" size="50" />
				</p>
				<p>
					<label for="item_price">Price</label> <br />
					<input type="text" name="item_price" size="50" />
				</p>
				<p>
					<span>
						<label for="gender"> Gender </label>
						<select id="gender" name="gender" size="1" onchange="">
							<option value="men" selected="selected"> Men </option>
							<option value="women"> Women </option>
						</select>
					</span>
					<span>
						<label for="category"> Category </label>
						<select id="category" name="category">
							<option value="" selected="selected"> Please select the gender first </option>
						</select>
					</span>
					<span>
						<label for="item-type"> Type </label>
						<select id="item-type" name="item-type" id="">
							<option value="" selected="selected"> Please select the category first </option>
						</select>
					</span>
				</p>
				<p>
					<label for="item_size_available">Size Available</label> <br />
					<select name="item_size_available" id="">
						<option value="all_size_available">All sizes are available</option>
					</select>
				</p>
				<p>
					<label for="item_description">Description</label> <br />
					<textarea name="item_description" id="" cols="30" rows="10"></textarea>
				</p>
				<p>
					<label for="item_composition">Composition</label> <br />
					<input type="text" name="item_composition" size="50" />
				</p>
				<p>
					<label for="tags"> Category </label> <br />
					<input type="text" name="item_category" size="50" />
				</p>
				<input type="submit" name="create-catalog-btn" value="Next" class="btn btn-primary"/>
			</form>
		</div>

		<div id="manage-store" class="designer-block hide">
			<h3> Manage Your Store</h3>
			<table border=1>
				<tr>
					<th>Image</th>
					<th>Product ID</th>
					<th>Product Name</th>
					<th>Categories</th>
					<th>Tags</th>
				</tr>
				<?php
				foreach( $designer_inventory as $index => $item) {
				?>
					<tr>
						<td>
							<img src="<?php echo $item['img_path']; ?>"	/>
						</td>
						<td><?php echo $item['id']; ?></td>
						<td><?php echo $item['title']; ?></td>
						<td><?php echo $item['category']; ?></td>
						<td><?php echo $item['tags']; ?></td>
					</tr>
				<?php
				}
				?>
			</table>
		</div>

	</div>
	<!-- Right Menu Ends -->
</div>

