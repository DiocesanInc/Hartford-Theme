<?php

acf_add_local_field_group(array(
    'key' => 'group_660c606d608d4',
    'title' => 'Posts',
    'fields' => array(
        array(
            'key' => 'field_660c606e2a6c5',
            'label' => 'Show Page Header',
            'name' => 'show_page_header',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '*This option will show/hide the page page header on this post. The page header consists of the deafault featured image for posts that\'s set in the Theme Header Settings, a heading and the breadcrumbs (if activated)',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 1,
            'ui_on_text' => 'Show',
            'ui_off_text' => 'Hide',
            'ui' => 1,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'display_title' => '',
    'allow_ai_access' => false,
    'ai_description' => '',
));
