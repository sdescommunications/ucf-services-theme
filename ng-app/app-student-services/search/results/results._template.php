<?php 
$search_results = (object) array(
	'social_facebook'  => null,
	'social_twitter'  => null,
	'image_thumbnail_src' => null,
	'image_alt' => null,
	'permalink' => null,
	'title' => null,
	'main_category_link' => null,
	'main_category_name' => null,
	'short_descr' => null,
);

$search_results = (object) array( 
	// 'like_tweet_share' => StudentService::render_like_tweet_share( array(
	// 		'social_facebook' =>  '',
	// 		'social_twitter' => '', )
	// ),
	'image_thumbnail_src' => $search_results->image_thumbnail_src ?: '{{service.image_thumbnail_src}}',
	'social_facebook'  => $search_results->social_facebook ?: '{{service.social_facebook}}',
	'social_twitter'  => $search_results->social_twitter ?: '{{service.social_twitter}}',
	'image_alt' => $search_results->image_alt ?: '{{service.image_alt}}',
	'permalink' => $search_results->permalink ?: '{{service.permalink}}',
	'title' => $search_results->title ?: '{{service.title}}',
	'main_category_link' => $search_results->main_category_link ?: '{{service.main_category_link}}',
	'main_category_name' => $search_results->main_category_name ?: '{{service.main_category_name | unescapeHtml }}',
	'short_descr' => $search_results->short_descr ?: '{{service.short_descr}}',
);
?>
<span class="student_service-list" *ngFor="let service of studentServices">
	<div class="row service">
		<div class="col-sm-4">
			<img class="service-image" src="<?= $search_results->image_thumbnail_src ?>" alt="<?= $search_results->image_alt ?>">
		</div>
		<div class="col-sm-8">
			<ucf-like-tweet-share>

				<div class="service-social pull-md-right">
					<a href="<?= $search_results->social_facebook ?>"><span class="fa fa-thumbs-o-up"></span></a>		
					<a href="<?= $search_results->social_twitter ?>"><span class="fa fa-twitter"></span></a>
					<a href="#"><span class="fa fa-share-alt"></span></a>
				</div>
			</ucf-like-tweet-share>

			<div class="service-details">
				<div class="service-title">
					<a href="<?= $search_results->permalink ?>">
							<?= $search_results->title ?>
					</a>
				</div>
				<div class="service-category">
				  <?php if ( '' !== $search_results->main_category_link ) : ?>
					<a href="<?= $search_results->main_category_link ?>">
						<?= $search_results->main_category_name ?>
					</a>
				  <?php else: ?>
					<?= $search_results->main_category_name ?>
				  <?php endif; ?>
				</div>
				<p>
					<?= $search_results->short_descr ?>
				</p>
			</div>
		</div>
	</div> <!-- /.service -->
</span>
