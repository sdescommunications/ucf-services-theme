#!/usr/bin/env node
var _ = require('lodash'),
    fs = require('fs');

var  php_context   = {
	'action': '<?= get_permalink( $post->ID ); ?>',
	'frontsearch_lead': '<?= $frontsearch_lead ?>',
	'frontsearch_placeholder': '<?= $frontsearch_placeholder ?>',
	'ng_input_params': ''
}

var angular_context = {
	'action': "{{ action }}",
	'frontsearch_lead': `<span [outerHTML]='lead | unescapeHtml'></span>`,
	'frontsearch_placeholder': '{{ placeholder }}',
	'ng_input_params':	`[(ngModel)]="frontsearch_query"
						[ngModelOptions]="{standalone: true}"
						[typeahead]='searchSuggestions'
						(typeaheadOnSelect)="typeaheadOnSelect($event)"
						(typeaheadLoading)="changeTypeaheadLoading($event)"
						(typeaheadNoResults)="changeTypeaheadNoResults($event)"`,
}

search_form_template = _.template(
`<section id="search-frontpage" class="container-fluid">
	<div class="row search">
		<div class="col-md-10 col-md-offset-1">
			<div class="search-lead">
				<%= frontsearch_lead %>
			</div>
		</div>
		<div class="col-md-6 col-md-offset-3 search-bar">
			<div class="search-bar">
				<form name="search" action="<%= action %>" method="POST">
					<span class="fa fa-search">
						<button type="submit" value="Submit" class="hide-if-js">Search</button>
					</span>
					<input type="text" name="search" class="form-control"
						placeholder="<%= frontsearch_placeholder %>"
						autocomplete="off"
						aria-label="Search for student services."
						<%= ng_input_params %>>
				</form>
			</div>
		</div>
	</div>
</section>  <!-- /#search-frontpage -->
`);

function handleErrors ( err, data ) {
  if (err) {
    return console.log(err);
  }
  // console.log(data);
}

function SaveTemplates() {
    // Save files
    console.log(`${new Date().toLocaleTimeString()} - Saving search/form templates...`);
    fs.writeFile( __dirname + '/form.component.php', search_form_template( php_context ), 'utf8', handleErrors );
    fs.writeFile( __dirname + '/form.component.html', search_form_template( angular_context ), 'utf8', handleErrors);
}


exports.search_form_template = search_form_template;
exports.SaveTemplates = SaveTemplates;
var args;
try{
    // Run with neodoc if installed, or catch and fail gracefully.
    const neodoc = require('neodoc');
    args = neodoc.run(`
        Metatemplate script to generate both a PHP and an Angular template (using lodash template.)
        Usage: form._template.js [-x|--execute]
        Options:
            -x --execute    Run SaveTemplates().`);
} catch (e) {
    args = { '-x': process.argv[2] == '-x' };
}
if ( args['-x'] ) {
    SaveTemplates();
}
