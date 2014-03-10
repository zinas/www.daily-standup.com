<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

    'modules'=>array(
        'api',
        'postman' => array(
            'components' => array(
                'gmail' => array(
                    'class'=>'GmailComponent',
                    'username' => 'zinas.nikos.dev@gmail.com',
                    'password' => 'potato1pass',
                    'hostname' => '{imap.gmail.com:993/imap/ssl}INBOX'
                ),
                'smtp'=>array(
                    'class'=>'application.extensions.smtpmail.PHPMailer',
                    'Host'=>"smtp.gmail.com",
                    'Username'=>'zinas.nikos.dev@gmail.com',
                    'Password'=>'potato1pass',
                    'Mailer'=>'smtp',
                    'Port'=>587,
                    'SMTPAuth'=>true,
                    'SMTPSecure' => 'tls'
                ),
            )
        )
    ),

    // application components
    'components'=>array(
        // uncomment the following to use a MySQL database
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=daily-standup',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
    ),
);