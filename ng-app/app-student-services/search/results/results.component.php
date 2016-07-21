        
<span class="student_service-list" *ngIf="!isLoading">
    <div class="row service">
        <div class="col-sm-4">
            <img class="service-image" src="<?= $ctxt_search_results['image_thumbnail_src'] ?>" alt="<?= $ctxt_search_results['image_alt'] ?>">
        </div>
        <div class="col-sm-8">
            <ucf-like-tweet-share>
                <div class="service-social pull-md-right">
                    <a href="<?= $ctxt_search_results['social_facebook'] ?>"><span class="fa fa-thumbs-o-up"></span></a>       
                    <a href="<?= $ctxt_search_results['social_twitter'] ?>"><span class="fa fa-twitter"></span></a>
                    <a href="#"><span class="fa fa-share-alt"></span></a>
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
    </div> <!-- /.service -->
</span>
        
