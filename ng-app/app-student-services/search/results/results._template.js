#!/usr/bin/env node
var _ = require('lodash'),
    fs = require('fs');

var  php_context   = {
    'before_services': '',
    'after_services': '',
    'ng_forService': ` [attr.data-category]="<?= $ctxt_search_results['main_category_name'] ?>"`,
    'ng_ifRow': '',
    'image_thumbnail_src': "<?= $ctxt_search_results['image_thumbnail_src'] ?>",
    'share_facebook': "<?= $ctxt_search_results['share_facebook'] ?>",
    'share_twitter':  "<?= $ctxt_search_results['share_twitter'] ?>",
    'image_alt': "<?= $ctxt_search_results['image_alt'] ?>",
    'permalink': "<?= $ctxt_search_results['permalink'] ?>",
    'title':     "<?= $ctxt_search_results['title'] ?>",
    'main_category_link': "<?= $ctxt_search_results['main_category_link'] ?>",
    'main_category_name': "<?= $ctxt_search_results['main_category_name'] ?>",
    'service_category': 
                 `<?php if ( '' !== $ctxt_search_results['main_category_link'] ) : ?>
                    <a href="<?= $ctxt_search_results['main_category_link'] ?>">
                        <?= $ctxt_search_results['main_category_name'] ?>
                    </a>
                  <?php else: ?>
                    <?= $ctxt_search_results['main_category_name'] ?>
                  <?php endif; ?>`,
    'short_descr': "<?= $ctxt_search_results['short_descr'] ?>",
}

var angular_context = {
    'before_services': 
        `<h2 *ngIf="showResultsHeading">
            Results for: &ldquo;{{ query }}&rdquo;
            <span class="clear-results fa fa-times-circle-o" (click)="clearResults()" title="Clear search term."></span>
        </h2>
        <span *ngIf="isLoading" style="font-size: 2em; padding: 12px 0;">
            <span class="loading fa fa-spinner fa-pulse" aria-hidden="true"></span>
            Loading results...<br>
        </span>
        `,
    'after_services': 
        `<span *ngIf="!isLoadingMore && !isLoading && hasResults && canLoadMore" style="font-size: 2em; padding: 12px 0;">
            <span class="fa fa-angle-double-down" aria-hidden="true"></span>
            <a href="" (click)="showNextPage($event)" title="Load more results">
                Load more results...
            </a>
        </span>
        <span *ngIf="isLoadingMore && !isLoading" style="font-size: 2em; padding: 12px 0;">
            <span class="loading fa fa-spinner fa-pulse" aria-hidden="true"></span>
            Loading more results...<br>
        </span>
        <h3 *ngIf="! hasResults() && !isLoading" class="noResults">
              No results found for "{{ query }}".
        </h3>
        `,
    'ng_forService':
                        ` *ngFor="let service of studentServices"
        [attr.data-category]="service?.main_category_name"`,
    'ng_ifRow': ` *ngIf="shouldFilter(service?.main_category_name)"`,
    'image_thumbnail_src': '{{service.image_thumbnail_src}}',
    'share_facebook' : '{{ service.share_facebook }}',
    'share_twitter' : '{{ service.share_twitter }}',
    'image_alt': '{{service.image_alt}}',
    'permalink': '{{service.permalink}}',
    'title': '{{service.title}}',
    'main_category_link': '{{service.main_category_link}}',
    'main_category_name': `<span [outerHTML]='service.main_category_name | unescapeHtml'></span>`,
    'service_category': 
                   `<a href="{{service.main_category_link}}"
                       [innerHTML]='service.main_category_name | unescapeHtml'
                       >
                    </a>`,
    'short_descr': '{{service.short_descr}}',
}

search_results_template = _.template(
`        <%= before_services %>
<span class="student_service-list" *ngIf="!isLoading">
    <div class="service"<%= ng_forService %>>
      <div class="row"<%= ng_ifRow %>>
        <div class="col-sm-4">
            <img class="service-image" src="<%= image_thumbnail_src %>" alt="<%= image_alt %>">
        </div>
        <div class="col-sm-8">
            <ucf-like-tweet-share>
                <div class="service-social pull-md-right">
                    <a target="_blank" href="<%= share_facebook %>"><span class="fa fa-thumbs-o-up"></span></a>       
                    <a target="_blank" href="<%= share_twitter %>"><span class="fa fa-twitter"></span></a>
                </div>
            </ucf-like-tweet-share>

            <div class="service-details">
                <div class="service-title">
                    <a href="<%= permalink %>">
                        <%= title %>
                    </a>
                </div>
                <div class="service-category">
                    <%= service_category %>
                </div>
                <p>
                    <%= short_descr %>
                </p>
            </div>
        </div>
      </div>
    </div> <!-- /.service -->
</span>
        <%= after_services %>
`);

function handleErrors ( err, data ) {
  if (err) {
    return console.log(err);
  }
  // console.log(data);
}

function SaveTemplates() {
    // Save files
    console.log(`${new Date().toLocaleTimeString()} - Saving search/results templates...`);
    fs.writeFile( __dirname + '/results.component.php', search_results_template( php_context ), 'utf8', handleErrors );
    fs.writeFile( __dirname + '/results.component.html', search_results_template( angular_context ), 'utf8', handleErrors);
}


exports.search_results_template = search_results_template;
exports.SaveTemplates = SaveTemplates;
var args;
try{
    // Run with neodoc if installed, or catch and fail gracefully.
    const neodoc = require('neodoc');
    args = neodoc.run(`
        Metatemplate script to generate both a PHP and an Angular template (using lodash template.)
        Usage: results._template.js [-x|--execute]
        Options:
            -x --execute    Run SaveTemplates().`);
} catch (e) {
    args = { '-x': process.argv[2] == '-x' };
}
if ( args['-x'] ) {
    SaveTemplates();
}
