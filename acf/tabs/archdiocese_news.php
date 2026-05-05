<?php

function acf_archdiocese_news()
{
    return array(
        array(
            'key' => 'field_662809a01a001',
            'label' => 'Archdiocese News',
            'name' => '',
            'type' => 'tab',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'placement' => 'top',
            'endpoint' => 0,
        ),
        array(
            'key' => 'field_662809a01a002',
            'label' => 'Show Archdiocese News?',
            'name' => 'show_archdiocese_news',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '20',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 1,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'ui' => 1,
        ),
        array(
            'key' => 'field_662809a01a004',
            'label' => 'Heading',
            'name' => 'archdiocese_news_heading',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_662809a01a002',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '25',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 'Archdiocese News',
            'placeholder' => 'Archdiocese News',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_662809a01a005',
            'label' => 'Show All Categories?',
            'name' => 'archdiocese_news_all_categories',
            'type' => 'true_false',
            'instructions' => '*Turn on to pull the latest posts from all categories on archdioceseofhartford.org.',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_662809a01a002',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '15',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 1,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'ui' => 1,
        ),
        array(
            'key' => 'field_662809a01a006',
            'label' => 'Category IDs',
            'name' => 'archdiocese_news_category_id',
            'type' => 'text',
            'instructions' => '*Enter one or more WordPress category IDs from archdioceseofhartford.org, separated by commas. Example: 14, 22, 35.',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_662809a01a002',
                        'operator' => '==',
                        'value' => '1',
                    ),
                    array(
                        'field' => 'field_662809a01a005',
                        'operator' => '!=',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '25',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '14',
            'placeholder' => '14, 22, 35',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_662809a01a007',
            'label' => 'Button',
            'name' => 'archdiocese_news_button',
            'type' => 'link',
            'instructions' => '*Leave empty to use the default Archdiocese News category link.',
            'required' => 0,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_662809a01a002',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '25',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'array',
        ),
    );
}
