php.ini settings:
post_max_size = 200M
upload_max_filesize = 200M
--------------one API allows token or no token.------------------------------------
/app/Http/Middleware/Authenticate.php
remove $this->auth->guard($guard)->check() to check user
override /vendor/laravel/framework/src/Illuminate/Auth/Middleware/Authenticate.php
------------disable--centos7-selinux-----------------------------------
laravel.log could not be opened failed to open stream permission denied
/etc/sysconfig/selinux
SELINUX=disabled
--------------nginx conf------------------------------------
server {
    set $host_path "/shaoshing_lifelong_learning_system";

    server_name  api.shaoxinglearn.echalk.cn;
    root   $host_path/public;

    charset utf-8;
    client_max_body_size 300M;# upload video

   location / {
        index  index.html;
        try_files $uri;
    }

    location ~ ^/(protected|vendor|themes/\w+/views) {
        deny  all;
    }

    #avoid processing of calls to unexisting static files by yii
    location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
        try_files $uri =404;
    }

    location ~ \.php {
        fastcgi_split_path_info  ^(.+\.php)(.*)$;

        #let yii catch the calls to unexising PHP files
        set $fsn /$yii_bootstrap;
        if (-f $document_root$fastcgi_script_name){
            set $fsn $fastcgi_script_name;
        }

        fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
        include fastcgi_params;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fsn;

        #PATH_INFO and PATH_TRANSLATED can be omitted, but RFC 3875 specifies them for CGI
        fastcgi_param  PATH_INFO        $fastcgi_path_info;
        fastcgi_param  PATH_TRANSLATED  $document_root$fsn;
    }

    location ~ /\. {
        deny all;
        access_log off;
        log_not_found off;
    }
}
