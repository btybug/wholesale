<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 2/13/2019
 * Time: 10:34 AM
 */

return [
    'most_viewed_pages' => [
        'name' => 'Most viewed pages',
        'description' => 'widget showing pages where users have most activity',
        'view' => 'admin.widgets.most_viewed_pages',
    ],
    'quick_email' => [
        'name' => 'Quick email',
        'description' => 'widget for send email quickly',
        'view' => 'admin.widgets.quick_email',
    ],
    'map_box' => [
        'name' => 'Map box',
        'description' => 'widget map box',
        'view' => 'admin.widgets.map_box',
    ],
    'new_users' => [
        'name' => 'New Registered Users',
        'description' => 'widget showing new registered users',
        'view' => 'admin.widgets.user_registrations',
    ],
    'unique_visitors' => [
        'name' => 'Unique Visitors',
        'description' => 'widget Unique Visitors',
        'view' => 'admin.widgets.unique_visitors',
    ],
    'new_orders' => [
        'name' => 'New Orders',
        'description' => 'widget count of new Orders',
        'view' => 'admin.widgets.new_orders',
    ],

];
