<?php
function generate_sample_job_offers() {
    $sample_offers = [
        [
            'title' => 'Frontend Developer',
            'description' => 'Praca z najnowszymi technologiami frontendowymi. Praca z React, JavaScript.',
            'meta' => [
                'technologia' => 'JavaScript, React',
                'lokalizacja' => 'Warszawa',
            ],
        ],
        [
            'title' => 'Backend Developer',
            'description' => 'Rozwijanie aplikacji opartych o PHP i MySQL. Optymalizacja baz danych.',
            'meta' => [
                'technologia' => 'PHP, Laravel',
                'lokalizacja' => 'Kraków',
            ],
        ],
        [
            'title' => 'Fullstack Developer',
            'description' => 'Łączenie pracy frontendowej z backendem, praca w Node.js i Angularze.',
            'meta' => [
                'technologia' => 'Node.js, Angular',
                'lokalizacja' => 'Zdalnie',
            ],
        ],
        [
            'title' => 'Tester oprogramowania',
            'description' => 'Testowanie aplikacji webowych i mobilnych, tworzenie testów automatycznych.',
            'meta' => [
                'technologia' => 'Selenium, Python',
                'lokalizacja' => 'Gdańsk',
            ],
        ],
        [
            'title' => 'Data Scientist',
            'description' => 'Analiza danych z wykorzystaniem technologii Big Data i uczenia maszynowego.',
            'meta' => [
                'technologia' => 'Python, R, Spark',
                'lokalizacja' => 'Wrocław',
            ],
        ],
        [
            'title' => 'DevOps Engineer',
            'description' => 'Tworzenie i utrzymanie pipeline CI/CD, automatyzacja procesów.',
            'meta' => [
                'technologia' => 'Docker, Kubernetes, Jenkins',
                'lokalizacja' => 'Poznań',
            ],
        ],
        [
            'title' => 'Project Manager',
            'description' => 'Zarządzanie zespołami IT, koordynacja projektów zgodnie z metodykami Agile.',
            'meta' => [
                'technologia' => 'Scrum, Jira, Trello',
                'lokalizacja' => 'Łódź',
            ],
        ],
        [
            'title' => 'iOS Developer',
            'description' => 'Tworzenie aplikacji mobilnych na platformę iOS z wykorzystaniem Swift i Objective-C.',
            'meta' => [
                'technologia' => 'Swift, Objective-C',
                'lokalizacja' => 'Zdalnie',
            ],
        ],
        [
            'title' => 'Android Developer',
            'description' => 'Tworzenie aplikacji mobilnych na platformę Android, optymalizacja UX/UI.',
            'meta' => [
                'technologia' => 'Kotlin, Java',
                'lokalizacja' => 'Warszawa',
            ],
        ],
        [
            'title' => 'Security Specialist',
            'description' => 'Zapewnienie bezpieczeństwa systemów i aplikacji, audyty bezpieczeństwa.',
            'meta' => [
                'technologia' => 'Penetration Testing, Firewalls',
                'lokalizacja' => 'Zdalnie',
            ],
        ],
        [
            'title' => 'Game Developer',
            'description' => 'Tworzenie gier 2D i 3D z wykorzystaniem silników Unity i Unreal.',
            'meta' => [
                'technologia' => 'Unity, Unreal Engine, C#',
                'lokalizacja' => 'Kraków',
            ],
        ],
        [
            'title' => 'UX Designer',
            'description' => 'Projektowanie interfejsów użytkownika z naciskiem na optymalizację doświadczenia.',
            'meta' => [
                'technologia' => 'Figma, Adobe XD',
                'lokalizacja' => 'Gdynia',
            ],
        ],
        [
            'title' => 'System Administrator',
            'description' => 'Utrzymanie infrastruktury serwerowej, monitorowanie i rozwiązywanie problemów.',
            'meta' => [
                'technologia' => 'Linux, Windows Server',
                'lokalizacja' => 'Poznań',
            ],
        ],
        [
            'title' => 'Blockchain Developer',
            'description' => 'Tworzenie rozwiązań opartych na technologii blockchain, implementacja smart contracts.',
            'meta' => [
                'technologia' => 'Solidity, Ethereum',
                'lokalizacja' => 'Wrocław',
            ],
        ],
        [
            'title' => 'Cloud Engineer',
            'description' => 'Projektowanie i utrzymanie infrastruktury w chmurze.',
            'meta' => [
                'technologia' => 'AWS, Azure, GCP',
                'lokalizacja' => 'Zdalnie',
            ],
        ],
    ];    

    foreach ($sample_offers as $offer) {
        $existing_offer = get_posts([
            'post_type' => 'job_offer',
            'title' => $offer['title'],
            'posts_per_page' => 1,
        ]);

        if (empty($existing_offer)) {
            $post_id = wp_insert_post([
                'post_title' => $offer['title'],
                'post_content' => $offer['description'],
                'post_type' => 'job_offer',
                'post_status' => 'publish',
            ]);

            if ($post_id) {
                foreach ($offer['meta'] as $taxonomy => $terms) {
                    $terms_array = explode(', ', $terms);
                    wp_set_object_terms($post_id, $terms_array, $taxonomy);
                }
            }
        }
    }
}

register_activation_hook(__FILE__, 'generate_sample_job_offers');
function add_generate_job_offers_button() {
    add_submenu_page(
        'edit.php?post_type=job_offer',
        'Generuj Oferty',
        'Generuj Oferty',
        'manage_options',
        'generate_job_offers',
        'generate_job_offers_page'
    );
}
add_action('admin_menu', 'add_generate_job_offers_button');

function generate_job_offers_page() {
    if (isset($_POST['generate_offers'])) {
        generate_sample_job_offers();
        echo '<div class="updated"><p>Brakujące oferty zostały wygenerowane!</p></div>';
    }

    ?>
    <div class="wrap">
        <h1>Generowanie Ofert Pracy</h1>
        <p>Użyj tego przycisku, aby wygenerować brakujące oferty pracy.</p>
        
        <form method="POST">
            <input type="submit" name="generate_offers" class="button-primary" value="Generuj brakujące oferty">
        </form>
    </div>
    <?php
}
