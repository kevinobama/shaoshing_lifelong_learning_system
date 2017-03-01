<?php
//this project settings
return [
    'checkInCoins' => 1,
    'defaultPageLimit' => 25,
    'uploads' => [
        'book_covers_folder' => '/uploads/book_covers/',
        'books_folder' => '/uploads/books/',
        'advertisements' => '/uploads/advertisements/',
        'advertisements_images_folder' => '/uploads/advertisements/images',
        'courseCoverImage' => '/uploads/courses/coverImages/',
        'coursefiles' => '/uploads/courses/files/',
        'forums_cover' => '/uploads/forums/cover/',
        'forums_attachments' => '/uploads/forums/attachments/',
        'messages_banners' => '/uploads/messages/banners/',
        'messages_images' => '/uploads/messages/images/',
    ],
    'media_host' => env('MEDIA_HOST', 'http://media.shaoxinglearn.echalk.cn'),
    'media_path' => env('MEDIA_PATH', '/home/shaoshing_lifelong_learning/shaoshing_lifelong_learning_files'),
    'appDownloadUrl' => [
        'iosUrl' => 'https://itunes.apple.com',
        'androidUrl' => 'http://app.hiapk.com/',
    ],
];
