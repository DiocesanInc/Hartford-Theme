<?php

/**
 * Template part for displaying remote Archdiocese news on the homepage.
 *
 * @package alphonsus
 */

if (!function_exists('hartford_archdiocese_news_get_text')) {
    function hartford_archdiocese_news_get_text($value)
    {
        return wp_strip_all_tags(
            html_entity_decode((string) $value, ENT_QUOTES, get_bloginfo('charset'))
        );
    }
}

if (!function_exists('hartford_archdiocese_news_get_featured_image')) {
    function hartford_archdiocese_news_get_featured_image($post)
    {
        $media = $post['_embedded']['wp:featuredmedia'][0] ?? null;

        if (!$media) {
            return getDefaultFeaturedImage(true);
        }

        $sizes = $media['media_details']['sizes'] ?? [];

        foreach (array('large', 'medium_large', 'full') as $size) {
            if (!empty($sizes[$size]['source_url'])) {
                return $sizes[$size]['source_url'];
            }
        }

        return $media['source_url'] ?? getDefaultFeaturedImage(true);
    }
}

if (!function_exists('hartford_archdiocese_news_prepare_item')) {
    function hartford_archdiocese_news_prepare_item($post)
    {
        if (empty($post['link']) || empty($post['title']['rendered'])) {
            return null;
        }

        $timestamp = !empty($post['date']) ? strtotime($post['date']) : false;

        return array(
            'title' => hartford_archdiocese_news_get_text($post['title']['rendered']),
            'link' => esc_url_raw($post['link']),
            'date' => $timestamp ? date_i18n('F j, Y', $timestamp) : '',
            'image' => hartford_archdiocese_news_get_featured_image($post),
        );
    }
}

if (!function_exists('hartford_archdiocese_news_get_items')) {
    function hartford_archdiocese_news_get_items()
    {
        $query_args = array(
            'per_page' => 6,
            '_embed' => 1,
            'categories' => 14,
        );

        $endpoint = add_query_arg(
            $query_args,
            'https://archdioceseofhartford.org/wp-json/wp/v2/posts'
        );

        $transient_key = 'hartford_archdiocese_news_' . md5($endpoint);
        $cached_items = get_transient($transient_key);

        if ($cached_items !== false) {
            return $cached_items;
        }

        $response = wp_remote_get(
            $endpoint,
            array(
                'timeout' => 10,
                'headers' => array(
                    'Accept' => 'application/json',
                ),
            )
        );

        if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
            return array();
        }

        $remote_posts = json_decode(wp_remote_retrieve_body($response), true);

        if (!is_array($remote_posts)) {
            return array();
        }

        $items = array_values(
            array_filter(
                array_map('hartford_archdiocese_news_prepare_item', $remote_posts)
            )
        );

        set_transient($transient_key, $items, HOUR_IN_SECONDS);

        return $items;
    }
}

$items = hartford_archdiocese_news_get_items();
?>

<?php if (!empty($items)) : ?>
    <section class="archdiocese-news-container" data-archdiocese-news>
        <div class="limit-width">

            <div class="archdiocese-news-header">
                <h2
                    class="archdiocese-news-heading has-text-decoration has-tertiary-background-color-after text-decoration-is-centered">
                    Archdiocese News
                </h2>


            </div>

            <div class="archdiocese-news-grid">
                <?php foreach ($items as $item) : ?>
                    <article class="archdiocese-news-card">
                        <a class="archdiocese-news-card-link" href="<?php echo esc_url($item['link']); ?>" target="_blank"
                            rel="noopener noreferrer">
                            <?php if (!empty($item['image'])) : ?>
                                <img class="archdiocese-news-card-image" src="<?php echo esc_url($item['image']); ?>"
                                    alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                            <?php endif; ?>

                            <div class="archdiocese-news-card-overlay" aria-hidden="true"></div>

                            <div class="archdiocese-news-card-content">
                                <?php if (!empty($item['date'])) : ?>
                                    <time class="archdiocese-news-card-date">
                                        <?php echo esc_html($item['date']); ?>
                                    </time>
                                <?php endif; ?>

                                <h3 class="archdiocese-news-card-title">
                                    <?php echo esc_html($item['title']); ?>
                                </h3>

                                <div class="read-more">
                                    <span class="read-more-text">Read More</span>
                                    <span class="read-more-icon" aria-hidden="true">→</span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>

            <div class="archdiocese-news-button-wrapper">

                <a class="the-button" href="https://archdioceseofhartford.org/category/news/archdiocese-news/"
                    target="_blank" rel="noopener noreferrer">
                    More News
                </a>
            </div>
        </div>

    </section>
<?php endif; ?>