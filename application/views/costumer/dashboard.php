<div class="container costumer-dashboard-container">
	<h3> <?php echo $costumer_name; ?> </h3>

	<h5> costumer Name - <?php echo $costumer_name; ?></h5>
	<h5> costumer Eamil - <?php echo $costumer_email; ?></h5>
	<h5> costumer Project - <?php echo $costumer_company; ?></h5>

	<?php echo validation_errors('<p class="error">'); ?>
	<!-- Left Menu -->
	<div class="left-bar col-md-3">
		<span class="left-row">
			<a href="#costumer-info" id="costumer-info-btn" class="left-row-item active">
				<h4>Your Profile</h4>
				<hr />
			</a>
		</span>
		<span class="left-row">
			<a href="#create-project" id="costumer-create-btn" class="left-row-item" >
				<h4>Create a Project</h4>
				<hr />
			</a>
		</span>
		<span class="left-row">
			<a href="#manage-store" id="manage-store-btn" class="left-row-item" >
				<h4>Manage Projects</h4>
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
	<div class="right-container col-md-9">

		<div id="costumer-info" class="desinger-block active">
			<h3> Your Profile </h3>
			<form action="<?php echo base_url().'costumer/update_costumer'; ?>" method="post" id="costumer-info-form">
				<h2>Company Information</h2>
				<p>
					<label for="catalog_name">Company</label> <br />
					<input type="text" name="costumer_company" size="50" value="<?php echo $costumer_company; ?>" />
				</p>

				<p>
					<label for="catalog_name">Company Description</label> <br />
					<textarea name="company_description" id="" cols="30" rows="10"><?php if( isset($company_description) ) echo $company_description; ?>
					</textarea>
				</p>
				<hr />

				<h2>Personal information</h2>
				<p>
					<label for="costumer_name">costumer Name</label> <br />
					<input type="text" name="costumer_name" size="50" value="<?php echo $costumer_name; ?>" />
				</p>
				<p>
					<label for="catalog_name">Email</label> <br />
					<input type="text" name="costumer_email" size="50" value="<?php echo $costumer_email; ?>" />
				</p>
				<p>
					<label for="catalog_name">Phone</label> <br />
					<input type="text" name="costumer_phone" size="50" value="<?php if(isset($costumer_phone)) echo $costumer_phone; ?>" />
				</p>

				<p>
					<label for="costumer_name">Costumer Description</label> <br />
					<textarea name="costumer_description" id="" cols="30" rows="10"> <?php if(isset($costumer_description)) echo $costumer_description; ?>
					</textarea>
				</p>

				<input type="Button" name="create-catalog-btn" id="costumer-info-update" value="Update" class="btn btn-success"/>
			</form>
			<div class="ajax-error-debug" style="height: 100px; color: orange;">

			</div>
		</div>

		<div id="create-project" class="costumer-block hide">
			<h3> Create a project</h3>
			<form action="<?php echo base_url().'costumer/create_project'; ?>" id="create-project-form">
				<p>
					<label for="project-name">Project</label> <br />
					<input type="text" name="project_name" size="50" />
				</p>
				<p>
					<label for="release-date"> Release Date </label> <br />
					<input type="text" name="release_date" size="50" />
				</p>
				<p>
					<label for="project-description">Project Description</label> <br />
					<textarea name="project_description" id="" cols="30" rows="10"></textarea>
				</p>
				<input type="button" id="create-project-btn" class="btn btn-primary" value="Create" />
			</form>
			<div class="ajax-create-error" style="height: 100px; color: orange;">

			</div>
		</div>

		<div id="manage-store" class="costumer-block hide">
			<h3> Manage Your Projects</h3>
			<table>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Release Date</th>
					<th>Active</th>
					<th>Create Date</th>
					<th> </th>
				</tr>
				<tbody>
				<?php
					for( $i=0; $i < sizeof($project_list); $i++ ) {
				?>
					<tr>
						<td> <?php echo $project_list[$i]['Name']; ?> </td>
						<td> <?php echo $project_list[$i]['Description']; ?> </td>
						<td> <?php echo $project_list[$i]['Release_date']; ?></td>
						<td> <?php echo $project_list[$i]['Current']; ?> </td>
						<td> <?php echo $project_list[$i]['Create_date']; ?> </td>
						<td> <button class="btn btn-success"> Edit </button> </td>
					</tr>
				<?php
					}
				?>
				</tbody>
			</table>
		</div>

	</div>
	<!-- Right Menu Ends -->
</div>