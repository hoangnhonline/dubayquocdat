<?php 
return [    
    'paging' => 100, // number rows for paging
    'uploads' => [
        'storage' => 'local',
        'webpath' => '/media/uploads'
    ],    

    'num_alert' => 10, // number rows for alert on top menu
    'upload_path' => public_path() . '/uploads/', // media_upload_path  
    'upload_thumbs_path' => public_path() . '/uploads/thumbs/', // media_upload_path 
    'upload_thumbs_path_2' => public_path() . '/uploads/thumbs/350x300/',
    'upload_url' => config('app.url') . '/uploads/', // image path,
    'max_size_upload' => 8000000    
];

?>
