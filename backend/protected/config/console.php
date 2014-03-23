<?php
return CMap::mergeArray(
	require(dirname(__FILE__).'/common.php'),
	array(
		'name'=>'Daily Standup - Console',

		// preloading 'log' component
		'preload'=>array('log'),

	    'commandMap' => array(
	        'sendreminders' => array(
	            'class' => 'application.modules.postman.commands.StandupRemindersCommand',
	        ),
	        'getreplies' => array(
	            'class' => 'application.modules.postman.commands.GetStandupRepliesCommand',
	        ),
	        'sendreports' => array(
	            'class' => 'application.modules.postman.commands.CreateReportsCommand',
	        ),
	    ),


		// application components
		'components'=>array(
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning',
					),
				),
			),
		),
	)
);