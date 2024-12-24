<?php
function register_job_offers_post_type() {
    $args = [
        'label' => 'Oferty Pracy',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => ['title', 'editor'],
        'taxonomies' => ['technologia', 'lokalizacja'],
        'menu_icon' => 'dashicons-portfolio',
    ];
    register_post_type('job_offer', $args);
}
add_action('init', 'register_job_offers_post_type');

function register_job_offers_taxonomies() {
    register_taxonomy('technologia', 'job_offer', [
        'label' => 'Technologie',
        'public' => true,
        'hierarchical' => true,
    ]);
    register_taxonomy('lokalizacja', 'job_offer', [
        'label' => 'Lokalizacje',
        'public' => true,
        'hierarchical' => true,
    ]);
}
add_action('init', 'register_job_offers_taxonomies');