<?php

return array(
    'mail_backend' => 'smtp',
    'mail_host' => 'localhost',
    'mail_port' => 25,
    'mail_auth' => false,
    'mail_username' => '',
    'mail_password' => '',
    'email_no_reply' => 'no-reply@exemple.com',

    'tmp_folder' => sys_get_temp_dir(),
    'template_folders' => array(
        __DIR__ .'/tests/templates',
    ),
);
