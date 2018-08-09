<?php

return [

    'template' => [
        'wrapperStart' => 'wrapperstart.php',
        'view' => ':view_path',
        'wrapperend' => 'wrapperend.php',
    ],

    'header_resources' => [
        'en' => [
            'toastr'    => 'toastr.min.css',
            'bootstrap' => 'bootstrap.min.css',
            'mainjs' => 'main.js',
            'fontawesome' => 'font-awesome.min.css',
            'custom' => 'custom.css',
        ],
        'ar' => [
            'toastr'    => 'toastr.min.css',
            'bootstrap' => 'bootstrap.min.css',
            'mainjs' => 'main.js',
            'fontawesome' => 'font-awesome.min.css',
            'custom' => 'custom.css',
        ]
    ],

    'footer_resources' => [
        'jquery' => 'jquery.min.js',
        'bootstrap' => 'bootstrap.min.js',
        'toastr' => 'toastr.min.js',
        'custom' => 'main.js',
    ]
];
