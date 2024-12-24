<?php
function display_job_offers($atts) {
    $atts = shortcode_atts(
        [
            'paged' => 1,
        ], 
        $atts, 
        'job_offers'
    );

    $args = [
        'post_type' => 'job_offer',
        'posts_per_page' => 4,
        'paged' => $atts['paged'],
    ];

    ob_start();
    ?>
<div class="container">
    <?php 
    $job_query = new WP_Query($args);
    $total_jobs = $job_query->found_posts;
    echo "<h2 id='total-title'><strong>$total_jobs</strong> Ofert pracy</h2>";
    ?>
    <div class="left-right">
        <form class="job-filters">
            <div class="titles">
                <h3 class="title">Filtry</h3>
                <button type="button" id="clear-filters">Resetuj</button>
            </div>
            <div class="filters">
                <div class="filter-section js-toggle-filter">
                    <h3 class="title">Technologia</h3>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div class="options-container">
                    <div class="options">
                        <?php
                            $tech_terms = get_terms(['taxonomy' => 'technologia', 'hide_empty' => false]);
                            foreach ($tech_terms as $term) {
                                echo '<label class="option"><input type="checkbox" class="filter-checkbox js-msdCheck" data-taxonomy="technologia" value="' . $term->slug . '"> ' . $term->name . '</label>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="filters">
                <div class="filter-section js-toggle-filter">
                    <h3 class="title">Lokalizacja</h3>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div class="options-container">
                    <div class="options">
                        <?php
                            $loc_terms = get_terms(['taxonomy' => 'lokalizacja', 'hide_empty' => false]);
                            foreach ($loc_terms as $term) {
                                echo '<label><input type="checkbox" class="filter-checkbox js-msdCheck" data-taxonomy="lokalizacja" value="' . $term->slug . '"> ' . $term->name . '</label>';
                            }
                        ?>
                    </div>
                    </div>
                </div>
          
        </form>

        <div class="job-listings">
            <div id="job-listings-content">
        

        <div id="pagination-container"></div>
        </div>
        </div>
    </div>
</div>

<?php return ob_get_clean();
}
add_shortcode('job_offers', 'display_job_offers');
?>
