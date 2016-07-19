<?php

require_once( get_stylesheet_directory() . '/functions/rest-api.php' );
    use SDES\ServicesTheme\API;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
    use SDES\ServicesTheme\PostTypes\StudentService;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
    use SDES\SDES_Static;

if ( null === $services_contexts ) {
    $services_limit = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-services_limit', 7 );
    $request = new \WP_REST_Request();
    $request->set_query_params( array( "limit" => $services_limit, ) );
    $services_contexts = API\route_services( $request );
    // $json_services = json_encode( $services_contexts );
}

$categories = get_categories( array(
    'orderby' => 'name',
    'exclude' => array( 1, ), // Uncategorized.
    'parent' => 0,
    'taxonomy' => 'category',
) );
?>
<article class="row page-wrap">
    <ucf-search-form
        (search)='onSearch($event)'
        (change)='onSearchChanged($event)'
        (blur)='onSearchChanged($event)'
        [action]='<?= get_permalink( $post->ID ) ?>'
    >
        <?php include( get_stylesheet_directory() . '/src/ts/search-form.component.php' ); ?>
    </ucf-search-form>

    <div class="container-fluid">
      <div class="row">
        <section id="filter" class="col-md-3 col-md-push-9 side-bar">
            <ucf-service-filter>
                <span class="filter-by">
                    <h2>Filter By</h2>
                    <div class="panel panel-default">
                        <ul class="list-group">
                            <?php if ( null !== $categories ) :
                              foreach ( $categories  as $category ) : ?>
                                <li class="cat-item cat-item-<?= $category->cat_ID ?>">
                                    <input class="filter-checkbox" type="checkbox" id="filter-services-<?= $category->cat_ID ?>">
                                    <label class="list-group-item filter-label" for="filter-services-<?= $category->cat_ID ?>">
                                        <a href="<?= get_category_link( $category ) ?>">
                                            <?= $category->name ?>
                                        </a>
                                    </label>
                                </li>
                            <?php endforeach;
                            else:
                                 echo '<!-- No categories -->';
                            endif; ?>
                          </span><!-- hide PHP -->
                        </ul>
                        <script>
                            // Remove link to category if javascript is enabled.
                            jQuery('label.filter-label a').each( function() { $(this).contents().unwrap(); } );
                        </script>
                    </div>
                </span>
            </ucf-service-filter>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-xs-12">
                    <ucf-campaign [type]="square">
                        <?php
                            $spotlight_id = get_post_meta( $post->ID, 'page_spotlight', true );
                            echo do_shortcode( "[campaign spotlight_id='{$spotlight_id}' layout='square']" );
                        ?>
                    </ucf-campaign>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                <ucf-academic-calendar>
                    <?php
                    // TODO: make calendar_events into a shortcode.
                    $academic_feed = UcfAcademicCalendarModel::$calendar_url;
                    $max_events = 5;
                    $events = UcfAcademicCalendarModel::get_academic_calendar_items();
                    echo StudentService::render_events_calendar( array(
                        'events_cal_feed' => $academic_feed,
                        'events' => $events,
                        'academic_cal' => true,
                        'events_cal_title' => 'Academic Calendar',
                        'more_events' => UcfAcademicCalendarModel::more_link(),
                    )); ?>
                </ucf-academic-calendar>
                </div>
            </div>
        </section> <!-- /#filter -->

        <section id="services" class="col-sm-12 col-md-9 col-lg-9 col-md-pull-3">
            <h2 class="title"><?= the_title() ?></h2>
            
            <ucf-campaign [type]="rectangle">
                <?php
                    $spotlight_id = get_post_meta( $post->ID, 'page_spotlight', true );
                    echo do_shortcode( "[campaign spotlight_id='{$spotlight_id}' layout='rectangle']" );
                ?>
            </ucf-campaign>
            <div class="clearfix"></div>
            <br>
            
            <ucf-search-results [query]='query' [api]='api'>
                <?php foreach ( $services_contexts as $ctxt_search_results ) {
                    include( get_stylesheet_directory() . '/src/ts/search-results.component.php' );
                } ?>
            </ucf-search-results>
        </section>
      </div>
    </div>
</article>