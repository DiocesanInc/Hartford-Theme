<?php

/**
 * Template Name: Homepage
 *
 * The template for displaying the Homepage Template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

get_header();

$add_wrapper = false;
$skip = false;

?>

<div class="content-area" id="primary">
    <main class="site-main page-template-homepage" id="main">
        <?php get_template_part("template-parts/homepage/hero");

        $has_archdiocese_news = false;

        if (have_rows("section_order", "options")) :

            //iterate through the sections set in the template settings
            while (have_rows("section_order", "options")) : the_row();

                //get section name
                $section = get_sub_field("section");

                //check if section is archdiocese news
                if ($section === "archdiocese_news") {
                    $has_archdiocese_news = true;
                }

                //determine if we need to wrap the next two sections
                //(calendar and news)
                $add_wrapper =
                    get_field("show_news") &&       //if news section is displayed
                    get_field("show_calendar") &&   //if calendar section is displayed
                    get_field("news_position") &&   //if news section is next to calendar
                    $section === "calendar";        //if current section is calendar

                $section = $add_wrapper ? "cols" : $section;    //add cols section instead

                $args = $add_wrapper ? array("calendar", "news") : null;

                //check if section needs to be skipped
                //(if calendar and news are next to each other, news needs to be skipped
                //so it doesn't appear twice)
                if (!$skip) :
                    //load template
                    $template = $section === "archdiocese_news" ? "archdiocese-news" : $section;
                    get_template_part("template-parts/homepage/$template", null, $args);
                else :
                    //set skip to false, to not skip more than needed
                    $skip = false;
                endif;

                //check if during the next iteration a section has to be skipped
                $skip = $add_wrapper ? true : false;

            endwhile;

        else : ?>

            <?php get_template_part("template-parts/homepage/mission"); ?>
            <?php get_template_part("template-parts/homepage/featured-content"); ?>
            <?php get_template_part("template-parts/homepage/news"); ?>
            <?php get_template_part("template-parts/homepage/gallery"); ?>
            <?php get_template_part("template-parts/homepage/banner"); ?>
            <?php get_template_part("template-parts/homepage/contact"); ?>


        <?php endif; ?>

        <?php if (!$has_archdiocese_news) : ?>
            <?php get_template_part("template-parts/homepage/archdiocese-news"); ?>
        <?php endif; ?>

    </main>
</div>

<?php get_footer();
