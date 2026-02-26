<?php

/**
 * Template part for displaying the mass times schedule on the homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package alphonsus
 */
?>

<div class="mass-times-schedule">
    <?php while (have_rows("mass_times_sections")) : the_row();

    ?>
            <div class="mass-times-sction">
                <h3 class="mass-times-section-title">
                    <?php echo get_sub_field("title"); ?>
                </h3>

                <div class="times">
                    <?php while (have_rows("times")) : the_row();
                    ?>

                            <div class="time">
                                <span class="day"><?php echo get_sub_field("day"); ?>:</span>
                                <span class="daytimes"><?php echo get_sub_field("day_times"); ?></span>
                                <?php if (get_sub_field("languages")) : ?>
                                    <span class="languages"><?php echo get_sub_field("languages"); ?></span>
                                <?php endif; ?>
                                <?php if (get_sub_field("additional_notes")) : ?>
                                    <span class="notes"><?php echo get_sub_field("additional_notes"); ?></span>
                                <?php endif; ?>
                            </div>
                    <?php 
                    endwhile; ?>
                </div>
            </div>
    <?php 
    endwhile;?>
</div>