<?php
$context = (object) array(
	'frontsearch_lead' => $NG_APP_SETTINGS['ucf_search_lead'] ?: "<span [outerHTML]='lead | unescapeHtml'></span>",
	'frontsearch_placeholder' => $NG_APP_SETTINGS['ucf_search_placeholder'] ?: '{{ placeholder }}'
);
?>
<section id="search-frontpage" class="container-fluid">
	<div class="row search">
		<div class="col-md-10 col-md-offset-1">
			<div class="search-lead">
				<?= $context->frontsearch_lead ?>
			</div>
		</div>
		<div class="col-md-6 col-md-offset-3 search-bar">
			<div class="search-bar">
				<form action="#">
					<span class="fa fa-search"></span>
					<input type="search" class="form-control"
						placeholder="<?= $context->frontsearch_placeholder ?>"
						aria-label="Search for student services."
						[(ngModel)]="frontsearch_query"
						[ngModelOptions]="{standalone: true}"
						>
				</form>
			</div>
		</div>
	</div>
</section>  <!-- /#search-frontpage -->
