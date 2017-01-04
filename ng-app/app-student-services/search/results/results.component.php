        
<span class="student_service-list" *ngIf="!isLoading">
    <div class="service" [attr.data-category]="<?= $ctxt_search_results['main_category_name'] ?>">
      <div class="row">
        <div class="col-sm-4">
            <img class="service-image img-responsive" src="<?= $ctxt_search_results['image_thumbnail_src'] ?>" alt="<?= $ctxt_search_results['image_alt'] ?>">
        </div>
        <div class="col-sm-8">
            <ucf-like-tweet-share>
                <div class="service-social pull-md-right">
                    <a target="_blank" href="<?= $ctxt_search_results['share_facebook'] ?>">
                        <span class="fa fa-thumbs-o-up"></span>
                        <span class="sr-only">Share on Facebook</span>
                    </a>
                    <a target="_blank" href="<?= $ctxt_search_results['share_twitter'] ?>">
                        <span class="fa fa-twitter"></span>
                        <span class="sr-only">Tweet on Twitter</span>
                    </a>
                </div>
            </ucf-like-tweet-share>

            <div class="service-details">
                <div class="service-title">
                    <a href="<?= $ctxt_search_results['permalink'] ?>">
                        <?= $ctxt_search_results['title'] ?>
                    </a>
                </div>
                <div class="service-category">
                    <?php if ( '' !== $ctxt_search_results['main_category_link'] ) : ?>
                    <a href="<?= $ctxt_search_results['main_category_link'] ?>">
                        <?= $ctxt_search_results['main_category_name'] ?>
                    </a>
                  <?php else: ?>
                    <?= $ctxt_search_results['main_category_name'] ?>
                  <?php endif; ?>
                </div>
                <p>
                    <?= $ctxt_search_results['short_descr'] ?>
                </p>
            </div>
        </div>
      </div>
    </div> <!-- /.service -->
</span>
        
