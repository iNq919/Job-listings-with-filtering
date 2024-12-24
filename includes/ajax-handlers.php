<?php
// Hook do obsługi Ajax w WordPressie
add_action('wp_ajax_load_filtered_job_offers', 'load_filtered_job_offers');
add_action('wp_ajax_nopriv_load_filtered_job_offers', 'load_filtered_job_offers');

function load_filtered_job_offers() {
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
    $paged = isset($_POST['paged']) ? $_POST['paged'] : 1;

    $args = [
        'post_type' => 'job_offer',
        'posts_per_page' => 4,
        'paged' => $paged,
    ];

    if (!empty($filters['technologia'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'technologia',
            'field'    => 'slug',
            'terms'    => $filters['technologia'],
            'operator' => 'IN',
        ];
    }

    if (!empty($filters['lokalizacja'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'lokalizacja',
            'field'    => 'slug',
            'terms'    => $filters['lokalizacja'],
            'operator' => 'IN',
        ];
    }

    $job_query = new WP_Query($args);

    if ($job_query->have_posts()) {
        while ($job_query->have_posts()) {
            $job_query->the_post();
            $tech_terms = wp_get_post_terms(get_the_ID(), 'technologia', ['fields' => 'names']);
            $loc_terms = wp_get_post_terms(get_the_ID(), 'lokalizacja', ['fields' => 'names']);
            ?>
            <div class="job-listing" 
                 data-technologia="<?php echo implode(' ', wp_get_post_terms(get_the_ID(), 'technologia', ['fields' => 'slugs'])); ?>" 
                 data-lokalizacja="<?php echo implode(' ', wp_get_post_terms(get_the_ID(), 'lokalizacja', ['fields' => 'slugs'])); ?>">
                 
                <h3><?php the_title(); ?></h3>
                <div class="info">
                    <?php if (!empty($tech_terms)) : ?>
                        <p class="tech"><?php echo implode(', ', $tech_terms); ?></p>
                    <?php endif; ?>
    
                    <?php if (!empty($loc_terms)) : ?>
                        <i class="fa fa-map-marker-alt"></i>
                        <p class="loc"><?php echo implode(', ', $loc_terms); ?></p>
                    <?php endif; ?>
                </div>
               <?php the_excerpt(); ?>
                <div class="buttons">
                    <a class="apply-btn" href="/formularz-aplikacyjny?title=<?php the_title(); ?>">Aplikuj</a>
                    <a class="more-info" href="<?php echo get_permalink(); ?>" target="_blank">Szczegóły</a>
                </div>
            </div>
            <?php
        }
    
        // Paginacja
        echo '<div class="pagination-container">';
        echo paginate_links([
            'total' => $job_query->max_num_pages,
            'current' => $paged,
            'format' => '?paged=%#%',
            'prev_next' => false,
        ]);
        echo '</div>';
    } else {
        echo '<p>Brak ofert pracy.</p>';
    }
    
    wp_reset_postdata();

    die();
} ?>
