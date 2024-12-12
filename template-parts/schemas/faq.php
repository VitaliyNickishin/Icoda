<?php
if (is_post_type_archive('post_faq')) :
    $faqs = new WP_Query([
        'post_type' => 'post_faq',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'fields' => 'ids'
    ]);
    $graph = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => []
    ];

    foreach ($faqs->posts as $faq_id) {
        $item_faq = [
            "@type" => "Question",
            "name" => get_the_title($faq_id),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => apply_filters('the_content', get_the_content(null, false, $faq_id))
            ]
        ];
        $graph["mainEntity"][] = $item_faq;
    }
?>

    <script type="application/ld+json">
        <?php echo json_encode($graph); ?>
    </script>

<?php endif; ?>