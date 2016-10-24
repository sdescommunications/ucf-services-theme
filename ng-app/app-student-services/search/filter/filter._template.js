#!/usr/bin/env node
var _ = require('lodash'),
    fs = require('fs');

// TODO: add namespace to PHP include templates to reduce global namespace pollution.
var  php_context   = {
    'li_open': 
            `<?php
                $categories = get_categories( array(
                    'orderby' => 'name',
                    'exclude' => array( 1, ), // Uncategorized.
                    'parent' => 0,
                    'taxonomy' => 'category',
                ) );
                if ( null !== $categories ) :
                foreach ( $categories  as $category ) : ?>
                <li class="cat-item cat-item-<?= $category->cat_ID ?>">`,
    'input_id': `filter-services-<?= $category->cat_ID ?>`,
    'input_properties': `data-name='<?= $category->name ?>'
                        data-cat_ID='<?= $category->cat_ID ?>'`,
    'label_properties': `for="filter-services-<?= $category->cat_ID ?>"`,
    'label_content':
                    `<a href="<?= get_category_link( $category ) ?>">
                        <?= $category->name ?>
                    </a>`,
    'after_li':
            `<?php endforeach;
            else:
                 echo '<span class="filter-no-categories"><!-- No categories --></span>';
            endif; ?>
            <script>
                // Remove link to category if javascript is enabled.
                jQuery('label.filter-label a').each( function() { jQuery(this).contents().unwrap(); } );
            </script>`
}

var angular_context = {
    'li_open': `<li *ngFor="let category of categories"
                class="cat-item cat-item-{{category.cat_ID}}"
                (change)="onFilterChanged($event)">`,
    'input_id': `filter-services-{{category.cat_ID}}`,
    'input_properties': `[(ngModel)]='category.checked'
                        [attr.data-name]='category.name'
                        [attr.data-cat_ID]='category.cat_ID'`,
    'label_properties': `[attr.for]="'filter-services-' + category.cat_ID"
                        [innerHTML]='category.name  | unescapeHtml'`,
    'label_content': '',
    'after_li': `<span class='filter-no-categories' *ngIf='!hasCategories()'><!-- No categories --></span>`
};

search_filter_template = _.template(
`<span class="filter-by">
    <h2>Filter By</h2>
    <div class="panel panel-default">
        <ul class="list-group">
            <%= li_open %>
                <input class="filter-checkbox" type="checkbox" id="<%= input_id %>" 
                        <%= input_properties %>>
                <label class="list-group-item filter-label" <%= label_properties %>>
                    <%= label_content %>
                </label>
            </li>
            <%= after_li %>
        </ul>
    </div>
</span>`
);

function handleErrors ( err, data ) {
  if (err) {
    return console.log(err);
  }
  // console.log(data);
}

function SaveTemplates() {
    // Save files
    console.log(`${new Date().toLocaleTimeString()} - Saving search/filter templates...`);
    fs.writeFile( __dirname + '/filter.component.php', search_filter_template( php_context ), 'utf8', handleErrors );
    fs.writeFile( __dirname + '/filter.component.html', search_filter_template( angular_context ), 'utf8', handleErrors);
}

exports.search_filter_template = search_filter_template;
exports.SaveTemplates = SaveTemplates;
var args;
try{
    // Run with neodoc if installed, or catch and fail gracefully.
    const neodoc = require('neodoc');
    args = neodoc.run(`
        Metatemplate script to generate both a PHP and an Angular template (using lodash template.)
        Usage: filter._template.js [-x|--execute]
        Options:
            -x --execute    Run SaveTemplates().`);
} catch (e) {
    args = { '-x': process.argv[2] == '-x' };
}
if ( args['-x'] ) {
    SaveTemplates();
} else { console.log('\nTo write template files, call this script with parameter `-x`.\n') }
