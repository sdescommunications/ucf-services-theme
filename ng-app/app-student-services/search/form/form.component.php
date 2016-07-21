<section id="search-frontpage" class="container-fluid">
	<div class="row search">
		<div class="col-md-10 col-md-offset-1">
			<div class="search-lead">
				<?= $frontsearch_lead ?>
			</div>
		</div>
		<div class="col-md-6 col-md-offset-3 search-bar">
			<div class="search-bar">
				<form name="search" action="<?= get_permalink( $post->ID ); ?>" method="POST">
					<span class="fa fa-search">
						<button type="submit" value="Submit" class="hide-if-js">Search</button>
					</span>
					<input type="text" name="search" class="form-control"
						placeholder="<?= $frontsearch_placeholder ?>"
						autocomplete="off"
						aria-label="Search for student services."
						>
				</form>
			</div>
		</div>
	</div>
</section>  <!-- /#search-frontpage -->
