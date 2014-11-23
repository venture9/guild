
<div class="container">
	<h3> <?php echo $designer_name; ?> </h3>
	<h5> <?php echo $designer_id; ?> </h5>

	<h5> Designer - <?php echo $designer_dir_path; ?></h5>
	<h5> Item - <?php echo $item_dir_path; ?></h5>
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
	<div class="file-container">
		<h2 class="center">New Design</h2>
		<button class="btn btn-primary">New Design</button>

		<form action="<?php echo base_url().'designer/add/item'; ?>" method="post" enctype="">
			<p>
				<input type="hidden" name="designer_id" value="<?php echo $designer_id; ?>" size="50" />
			</p>
			<p>
				<label for="catalog_name">Title</label> <br />
				<input type="text" name="item_title" size="50" />
			</p>
			<p>
				<label for="catalog_name">Sub Title</label> <br />
				<input type="text" name="item_sub_title" size="50" />
			</p>
			<p>
				<label for="catalog_name">Price</label> <br />
				<input type="text" name="item_price" size="50" />
			</p>
			<p>
				<label for="catalog_name">Size Available</label> <br />
				<select name="item_size_available" id="">
					<option value="all_size_available">All sizes are available</option>
				</select>
			</p>
			<p>
				<label for="catalog_name">Description</label> <br />
				<textarea name="item_description" id="" cols="30" rows="10"></textarea>
			</p>
			<p>
				<label for="catalog_name">Composition</label> <br />
				<input type="text" name="item_composition" size="50" />
			</p>
			<p>
				<label for="tags"> Category </label> <br />
				<input type="text" name="item_category" size="50" />
			</p>
			<input type="submit" name="create-catalog-btn" value="Next" class="btn btn-primary"/>
		</form>
			<!-- Designer designer Info-->
			<hr />
		<h2 class="center">Designer</h2>
		<form action="<?php echo base_url().'designer/add_designer'; ?>" method="post">
			<p>
				<label for="designer_name">Designer Name</label> <br />
				<input type="text" name="designer_name" size="50" />
			</p>
			<p>
				<label for="catalog_name">Email</label> <br />
				<input type="text" name="designer_email" size="50" />
			</p>
			<p>
				<label for="catalog_name">Phone</label> <br />
				<input type="text" name="designer_phone" size="50" />
			</p>

			<p>
				<label for="designer_name">Designer Description</label> <br />
				<textarea name="designer_description" id="" cols="30" rows="10"></textarea>
			</p>

			<p>
				<label for="catalog_name">Boutique Name</label> <br />
				<input type="text" name="boutique_name" size="50" />
			</p>

			<p>
				<label for="catalog_name">Boutique Description</label> <br />
				<textarea name="boutique_description" id="" cols="30" rows="10"></textarea>
			</p>

			<input type="submit" name="create-catalog-btn" value="Next" class="btn btn-success"/>
		</form>
	</div>
</div>

