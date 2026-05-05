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

if (!function_exists('hartford_archdiocese_news_parse_category_ids')) {
    function hartford_archdiocese_news_parse_category_ids($category_ids)
    {
        if (is_array($category_ids)) {
            $category_ids = implode(',', $category_ids);
        }

        $category_ids = trim((string) $category_ids);

        if ($category_ids === '') {
            return array();
        }

        $category_ids = preg_split('/\s*,\s*/', $category_ids);

        if (!is_array($category_ids)) {
            return array();
        }

        $category_ids = array_values(
            array_unique(
                array_filter(
                    array_map('absint', $category_ids)
                )
            )
        );

        return $category_ids;
    }
}

if (!function_exists('hartford_archdiocese_news_get_items')) {
    function hartford_archdiocese_news_get_items($category_ids = null, $show_all_categories = true)
    {
        $query_args = array(
            'per_page' => 4,
            '_embed' => 1,
        );

        if (!$show_all_categories) {
            $parsed_category_ids = hartford_archdiocese_news_parse_category_ids($category_ids);

            if (empty($parsed_category_ids)) {
                $parsed_category_ids = array(14);
            }

            $query_args['categories'] = $parsed_category_ids;
        }

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

$show = get_field('show_archdiocese_news');

if ($show === null || $show === '') {
    $show = true;
}

if (!$show) {
    return;
}

$eyebrow = getField('archdiocese_news_eyebrow', false, false, 'Catholic Transcript Online');
$heading = getField('archdiocese_news_heading', false, false, 'Archdiocese News');
$show_all_categories = getField('archdiocese_news_all_categories', false, false, true);
$category_ids = getField('archdiocese_news_category_id', false, false, '14');
$button = get_field('archdiocese_news_button');
$button_url = $button['url'] ?? 'https://archdioceseofhartford.org/category/news/archdiocese-news/';
$button_title = $button['title'] ?? 'More News';
$button_target = $button['target'] ?? '_blank';
$items = hartford_archdiocese_news_get_items($category_ids, $show_all_categories);
?>

<?php if (!empty($items)) : ?>
    <section class="archdiocese-news-container" data-archdiocese-news>
        <div class="limit-width">

            <div class="archdiocese-news-header">
                <?php if ($heading) : ?>
                    <h2
                        class="archdiocese-news-heading has-text-decoration has-tertiary-background-color-after text-decoration-is-centered">
                        <?php echo esc_html($heading); ?>
                    </h2>
                <?php endif; ?>


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

            <?php if ($button_url && $button_title) : ?>
                <div class="archdiocese-news-button-wrapper">

                    <a class="the-button" href="<?php echo esc_url($button_url); ?>"
                        target="<?php echo esc_attr($button_target); ?>" rel="noopener noreferrer">
                        <?php echo esc_html($button_title); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </section>
<?php endif; ?>
