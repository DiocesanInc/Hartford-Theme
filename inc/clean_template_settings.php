<?php

// add_action('admin_init', function () {
//     if (! is_admin()) {
//         return;
//     }

//     if (get_option('template_settings_acf_cleanup_done')) {
//         return;
//     }

//     $group_key = 'group_6182f90c43398';

//     $groups = get_posts([
//         'post_type'      => 'acf-field-group',
//         'post_status'    => ['publish', 'draft', 'trash', 'acf-disabled'],
//         'posts_per_page' => -1,
//         'fields'         => 'ids',
//         'meta_query'     => [
//             [
//                 'key'   => 'key',
//                 'value' => $group_key,
//             ],
//         ],
//     ]);

//     foreach ($groups as $group_id) {
//         //update post status to 'acf-disabled' to prevent it from showing up in the ACF UI
//         wp_update_post([
//             'ID'          => $group_id,
//             'post_status' => 'acf-disabled',
//         ]);
//     }

//     $field_key = 'field_6244c66d6d197';

//     $fields = get_posts([
//         'post_type'      => 'acf-field',
//         'post_status'    => ['publish', 'draft', 'trash', 'acf-disabled'],
//         'posts_per_page' => -1,
//         'fields'         => 'ids',
//         'post_name'         => $field_key,
//     ]);

//     foreach ($fields as $field_id) {
//         //update post status to 'acf-disabled' to prevent it from showing up in the ACF UI
//         wp_update_post([
//             'ID'          => $field_id,
//             'post_status' => 'acf-disabled',
//         ]);
//     }

//     update_option('template_settings_acf_cleanup_done', 1);
// });