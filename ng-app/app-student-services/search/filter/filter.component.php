<span class="filter-by">
    <h2>Filter By</h2>
    <div class="panel panel-default">
        <ul class="list-group">
            <?php
                $categories = get_categories( array(
                    'orderby' => 'name',
                    'exclude' => array( 1, ), // Uncategorized.
                    'parent' => 0,
                    'taxonomy' => 'category',
                ) );
                if ( null !== $categories ) :
                foreach ( $categories  as $category ) : ?>
                <li class="cat-item cat-item-<?= $category->cat_ID ?>">
                <input class="filter-checkbox" type="checkbox" id="filter-services-<?= $category->cat_ID ?>" 
                        data-name='<?= $category->name ?>'
                        data-cat_ID='<?= $category->cat_ID ?>'>
                <label class="list-group-item filter-label" for="filter-services-<?= $category->cat_ID ?>">
                    <a href="<?= get_category_link( $category ) ?>">
                        <?= $category->name ?>
                    </a>
                </label>
            </li>
            <?php endforeach;
            else:
                 echo '<span class="filter-no-categories"><!-- No categories --></span>';
            endif; ?>
            <script>
                // Remove link to category if javascript is enabled.
                jQuery('label.filter-label a').each( function() { jQuery(this).contents().unwrap(); } );
            </script>
        </ul>
    </div>
</span>