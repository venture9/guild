
<div class="container">
	<h3> <?php echo $designer_name; ?> </h3>
	<h5> <?php echo $designer_id; ?> </h5>
	<h5> <?php echo getcwd(); ?> </h5>
	<h5> <?php echo $designer_dir_path; ?></h5>
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
		<button class="btn btn-primary">New Design</button>

		<form action="<?php echo base_url().'designer/upload/item'; ?>" method="post" enctype="">

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


		<form id="fileupload" action="http://localhost/guild/upload/do_upload/user1" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="userfile" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>


	<!-- The template to display files available for upload -->
	<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	    <tr class="template-upload fade">
	        <td>
	            <span class="preview"></span>
	        </td>
	        <td>
	            <p class="name">{%=file.name%}</p>
	            <strong class="error text-danger"></strong>
	        </td>
	        <td>
	            <p class="size">Processing...</p>
	            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
	        </td>
	        <td>
	            {% if (!i && !o.options.autoUpload) { %}
	                <button class="btn btn-primary start" disabled>
	                    <i class="glyphicon glyphicon-upload"></i>
	                    <span>Start</span>
	                </button>
	            {% } %}
	            {% if (!i) { %}
	                <button class="btn btn-warning cancel">
	                    <i class="glyphicon glyphicon-ban-circle"></i>
	                    <span>Cancel</span>
	                </button>
	            {% } %}
	        </td>
	    </tr>
	{% } %}
	</script>
	<!-- The template to display files available for download -->
	<script id="template-download" type="text/x-tmpl">

	{% for (var i=0, file; file=o.files[i]; i++) { %}
	    <tr class="template-download fade">
	        <td>
	            <span class="preview">
	                {% if (file.thumbnailUrl) { %}
	                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
	                {% } %}
	            </span>
	        </td>
	        <td>
	            <p class="name">
	                {% if (file.url) { %}
	                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
	                {% } else { %}
	                    <span>{%=file.name%}</span>
	                {% } %}
	            </p>
	            {% if (file.error) { %}
	                <div><span class="label label-danger">Error</span> {%=file.error%}</div>

	            {%} %}
	        </td>
	        <td>
	            <span class="size">{%=o.formatFileSize(file.size)%}</span>
	        </td>
	        <td>
	            {% if (file.deleteUrl) { %}
	                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
	                    <i class="glyphicon glyphicon-trash"></i>
	                    <span>Delete</span>
	                </button>
	                <input type="checkbox" name="delete" value="1" class="toggle">
	            {% } else { %}
	                <button class="btn btn-warning cancel">
	                    <i class="glyphicon glyphicon-ban-circle"></i>
	                    <span>Cancel</span>
	                </button>
	            {% } %}
	        </td>
	    </tr>
	{% } %}
	</script>
			<!-- Designer Contact Info-->
			<hr />
		<form action="" method="post">
			<p>
				<label for="catalog_name">Email</label> <br />
				<input type="text" name="contact_email" size="50" />
			</p>
			<p>
				<label for="catalog_name">Phone</label> <br />
				<input type="text" name="contact_phone" size="50" />
			</p>

			<p>
				<label for="catalog_name">Boutique</label> <br />
				<input type="text" name="boutique_name" size="50" />
			</p>

			<p>
				<label for="catalog_name">Boutique Description</label> <br />
				<input type="text" name="boutique_description" size="50" />
			</p>

			<input type="submit" name="create-catalog-btn" value="Next" class="btn btn-success"/>
		</form>
	</div>
</div>

