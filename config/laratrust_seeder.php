<?php

return [
    'role_structure' => [
        'super_administrator' => [
            'users' => 'c,r,u,d'
        ],
        'administrator' => [
            'users' => 'c,r,u,d'
        ],
        'site_manager' => [
            'users'   => 'c,r'
        ],
    ],
    'permission_structure' => [

    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
