<?php

/**
 * Template part for displaying the mass times on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */

$bg_img = get_field("mass_times_bg_img");
$bg_img_path = $bg_img == 'select' ? get_field('watermark_upload') : get_template_directory_uri() . "/assets/img/$bg_img.svg";

$bg = $bg_img ? "style='background-image:url($bg_img_path);'" : "";

?>

<h2 class="mass-times-heading has-text-decoration has-tertiary-background-color-after text-decoration-is-centered">
    <?php echo get_field("mass_times_headline_1"); ?>
</h2>
<div class="mass-times-container">
    <div class="limit-width-laptop-up">
        <div class="mass-times-left">
            <?php if (have_rows("parishes")) :?>
                <div class="mass-times-image-wrapper">
                <div class="image1 mass-nav-l mass-nav-r mass-slides">
                <?php while (have_rows("parishes")) : the_row();?>
                    <?php if (get_sub_field("mass_times_image_1")) : ?>
                        <?php $mImage1 = get_sub_field("mass_times_image_1")["url"] ?? '';?>
                        <img src="<?php echo $mImage1; ?>" alt="">
                    <?php endif; ?>
                <?php endwhile; ?>
                </div></div>

                <div class="mass-times-image-wrapper">
                <div class="image2 mass-nav-l mass-nav-r mass-slides">
                <?php while (have_rows("parishes")) : the_row();?>
                    <?php if (get_sub_field("mass_times_image_2")) : ?>
                        <?php $mImage2 = get_sub_field("mass_times_image_2")["url"] ?? '';?>
                        <img src="<?php echo $mImage2; ?>" alt="">
                    <?php endif; ?>
                <?php endwhile; ?>
                </div></div>
            <?php endif;?>
        </div>
        <div class="mass-times-right">
            <?php if (have_rows("parishes")) :?>
                <div class="mass-times-right-slides mass-nav-l image1 image2 mass-nav-r">
                    <?php while (have_rows("parishes")) : the_row();?>
                        <div class="mass-times-right-slide">
                            <?php if (get_sub_field("parish_name")) : ?>
                                <h3 class="mass-times-subheading">
                                    <?php echo get_sub_field("parish_name"); ?>
                                </h3>
                            <?php endif; ?>

                            <?php
                            if (get_sub_field("mass_times_content_type")) :
                                if (have_rows("mass_times_sections")) :
                                    get_template_part(
                                        "template-parts/homepage/mass_times",
                                        "schedule"
                                    );
                                endif;
                            else :
                                echo get_sub_field("mass_times_content");
                            endif; 
                            ?>
                        <div class="mass-times-buttons">
                            <?php if (have_rows("mass_times_buttons")) :?>
                                <?php while (have_rows("mass_times_buttons")) : the_row();
                                    echo acfLink(get_sub_field("mass_times_link"), "the-button"); ?>
                                <?php endwhile; ?>
                            <?php endif;?>
                        </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif;?>
        </div>
        <?php if (have_rows("parishes")) :?>
            <div class="mass-times-nav-left mass-nav-r image1 image2 mass-slides">
                <?php while (have_rows("parishes")) : the_row();?>
                        <div class="mass-times-buttons">
                            <?php if (have_rows("mass_times_buttons")) :?>
                                <?php while (have_rows("mass_times_buttons")) : the_row();
                                    echo acfLink(get_sub_field("mass_times_link"), "the-button"); ?>
                                <?php endwhile; ?>
                            <?php endif;?>
                        </div>
                <?php endwhile; ?>
            </div>
        <?php endif;?>
    </div>
    <?php if ($bg_img == 'select') : ?>
        <div class="bg-img select" <?php echo $bg; ?>></div>
    <?php elseif ($bg_img) : ?>
        <div class="bg-img" <?php echo $bg; ?>></div>
    <?php endif; ?>
</div>