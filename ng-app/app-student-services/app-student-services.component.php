<?php
/**
 * Pre-render this component (app-student-services) and its subcomponents using PHP includes.
 * For non-Wordpress servers like NodeJS or ASP.NET Core Server, consider using Angular Universal instead of this pattern.
 * For PHP, Angular Univeral integration might be possible using the V8JS engine. See: https://github.com/angular/universal/issues/281
 */

require_once( get_stylesheet_directory() . '/functions/rest-api.php' );
    use SDES\ServicesTheme\API;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
    use SDES\ServicesTheme\PostTypes\StudentService;

require_once( get_stylesheet_directory() . '/functions/class-sdes-static.php' );
    use SDES\SDES_Static;

if ( isset( $NG_APP_SETTINGS )
    && null !== $NG_APP_SETTINGS['services_limit']
    && null !== $NG_APP_SETTINGS['services_contexts'] )
{
    $services_limit = $NG_APP_SETTINGS['services_limit'] ;
    $services_contexts = $NG_APP_SETTINGS['services_contexts'];
} else {
    $services_limit = SDES_Static::get_theme_mod_defaultIfEmpty( 'services_theme-services_limit', 200 );
    $request = new \WP_REST_Request();
    $request->set_query_params( array( "limit" => $services_limit, ) );
    $services_contexts = API\route_services( $request );
}

$categories = get_categories( array(
    'orderby' => 'name',
    'exclude' => array( 1, ), // Uncategorized.
    'parent' => 0,
    'taxonomy' => 'category',
) );
?>
<script>
    window.ucf_searchResults_limit = Number(<?= $services_limit ?>);
</script>
<article class="row page-wrap">
    <ucf-search-form
        [frontsearch_query]="frontsearch_query"
        [lead]='search_lead'
        [placeholder]='search_placeholder'
        (search)='onSearch($event)'
        (change)='onSearchChanged($event)'
        (blur)='onSearchChanged($event)'
        [action]='<?= get_permalink( $post->ID ) ?>'
    >
        <?php include( get_stylesheet_directory() . '/ng-app/app-student-services/search/form/form.component.php' ); ?>
    </ucf-search-form>

    <div class="container-fluid">
      <div class="row">
        <section id="filter" class="col-md-3 col-md-push-9 side-bar">
            <ucf-search-filter>
                <?php include( get_stylesheet_directory() . '/ng-app/app-student-services/search/filter/filter.component.php' ); ?>
            </ucf-search-filter>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-xs-12">
                    <ucf-campaign [type]="square">
                        <?php
                            $campaign_id = get_post_meta( $post->ID, 'page_campaign_sidebar', true );
                            echo do_shortcode( "[campaign campaign_id='{$campaign_id}' layout='square']" );
                        ?>
                    </ucf-campaign>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                <ucf-calendar-events>
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
                </ucf-calendar-events>
                <script>
                    window.ucf_calendar_events = <?= json_encode( $events ) ?>;
                </script>
                </div>
            </div>
        </section> <!-- /#filter -->

        <section id="services" class="col-sm-12 col-md-9 col-lg-9 col-md-pull-3">
            <h2 class="title"><?= the_title() ?></h2>

            <ucf-campaign [type]="rectangle">
                <?php
                    $campaign_id = get_post_meta( $post->ID, 'page_campaign_primary', true );
                    echo do_shortcode( "[campaign campaign_id='{$campaign_id}' layout='rectangle']" );
                ?>
            </ucf-campaign>
            <div class="clearfix"></div>
            <br>

            <ucf-search-results [query]='query' [api]='api'
                [results]='initialResults'
                [limit]='limit'
                [showResultsHeading]='showResultsHeading'
                (resultsChanged)='onResultsChanged($event)'>
                <?php foreach ( $services_contexts as $ctxt_search_results ) {
                    include( get_stylesheet_directory() . '/ng-app/app-student-services/search/results/results.component.php' );
                } ?>
                <span *ngIf="!isLoadingMore" style="font-size: 2em; padding: 12px 0;">
                    <span class="fa fa-angle-double-down" aria-hidden="true"></span>
                    <a href="" (click)="showNextPage($event)" title="Load more results">
                        Load more results...
                    </a>
                </span>
            </ucf-search-results>
        </section>
      </div>
    </div>
</article>
