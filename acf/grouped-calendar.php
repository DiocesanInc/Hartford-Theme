<?php

add_action('acf/include_fields', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_69d933e8707eb',
        'title' => 'Grouped Calendar Settings',
        'fields' => array(
            array(
                'key' => 'field_69dd1ab3d3ba2',
                'label' => 'Grouped Calendar',
                'name' => 'grouped_calendar',
                'aria-label' => '',
                'type' => 'true_false',
                'instructions' => 'Please check this, if this calendar is part of a grouped calendar to set identifying colors',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'allow_in_bindings' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_69dd17e4ae007',
                'label' => 'Color Settings',
                'name' => '',
                'aria-label' => '',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_69dd1ab3d3ba2',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'If this calendar is part of a grouped calendar, you can set the identifying color for this calendar here.',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            array(
                'key' => 'field_69dd18a9ae008',
                'label' => 'Color Palette',
                'name' => 'color_palette',
                'aria-label' => '',
                'type' => 'true_false',
                'instructions' => 'Choose whether to use this theme\'s colors or custom colors.',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_69dd1ab3d3ba2',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'allow_in_bindings' => 0,
                'ui_on_text' => 'Theme Colors',
                'ui_off_text' => 'Custom',
                'ui' => 1,
            ),
            array(
                'key' => 'field_69d933eaf6b62',
                'label' => 'Identifying Color',
                'name' => 'calendar_color_theme',
                'aria-label' => '',
                'type' => 'theme_colors',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_69dd18a9ae008',
                            'operator' => '==',
                            'value' => '1',
                        ),
                        array(
                            'field' => 'field_69dd1ab3d3ba2',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'primary',
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_69dd18f8ae009',
                'label' => 'Identifying Color',
                'name' => 'calendar_color_custom',
                'aria-label' => '',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_69dd18a9ae008',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                        array(
                            'field' => 'field_69dd1ab3d3ba2',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'enable_opacity' => 0,
                'return_format' => 'string',
                'allow_in_bindings' => 0,
                'show_custom_palette' => 0,
                'show_color_wheel' => 1,
                'custom_palette_source' => '',
                'palette_colors' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'calendar',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
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
});
