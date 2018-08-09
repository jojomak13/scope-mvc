<?php

return [

    'template' => [
        'header' => 'header.php',
        'sidebar' => 'sidebar.php',
        'wrapperStart' => 'wrapperstart.php',
        'view' => ':view_path',
        'wrapperEnd' => 'wrapperend.php', 
    ],

    'header_resources' => [
        'en' => [
            'toastr'    => 'toastr.min.css',
            'nicealert' => 'sweetalert.css',
            'bootstrap' => 'bootstrap.min.css',
            'helper' => 'helper.css',
            'style' => 'style.css'
        ],
        'ar' => [
            'toastr'    => 'toastr.min.css',
            'nicealert' => 'sweetalert.css',
            'bootstrap' => 'bootstrap.min.css',
            'helper' => 'helper.css',
            'style' => 'style.css',
            'rtl' => 'rtl.css'
        ]
    ],

    'footer_resources' => [
        'jquery' => 'jquery.min.js',
        'poper' => 'popper.min.js',
        'nicealert' => 'sweetalert.min.js',
        'bootstrap' => 'bootstrap.min.js',
        'sqSlimScroll' => 'jquery.slimscroll.js',
        'SlideMenu' => 'sidebarmenu.js',
        'stikt-kit' => 'sticky-kit.min.js',
        'toastr' => 'toastr.min.js',
        'custom' => 'custom.min.js',
    ]
];