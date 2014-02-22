<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		// 'gii'=>array(
		// 	'class'=>'system.gii.GiiModule',
		// 	'password'=>'123',
		// 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
		// 	'ipFilters'=>array('127.0.0.1','::1'),
		// ),
		'api'
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		'urlManager'=>array(
		    'urlFormat'=>'path',
		    'rules'=>array(
		        // REST patterns
		        array('api/<model>/list', 'pattern'=>'rest/<model:\w+>', 'verb'=>'GET'),
		        array('api/<model>/view', 'pattern'=>'rest/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
		        array('api/<model>/update', 'pattern'=>'rest/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
		        array('api/<model>/delete', 'pattern'=>'rest/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
		        array('api/<model>/create', 'pattern'=>'rest/<model:\w+>', 'verb'=>'POST'),
		        // Other controllers
		        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		    ),
		),

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
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);