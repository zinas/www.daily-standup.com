<?php
return CMap::mergeArray(
	require(dirname(__FILE__).'/common.php'),
	array(
		'name'=>'Daily Standup',

		// preloading 'log' component
		'preload'=>array('log'),

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
	)
);
return ;