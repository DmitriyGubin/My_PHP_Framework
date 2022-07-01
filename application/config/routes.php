<?php
//URL
return [
	
	//AdminController

	'' => [//authorization+
		'controller' => 'admin',
		'action' => 'login'
	],

	'admin/logout' => [//exit+
		'controller' => 'admin',
		'action' => 'logout'
	],

	'admin/add' => [//adding a user+
		'controller' => 'admin',
		'action' => 'add'
	],

	'admin/edit/{id:\d+}' => [//user editing+
		'controller' => 'admin',
		'action' => 'edit'
	],

	'admin/delete/{id:\d+}' => [//deleting a user+
		'controller' => 'admin',
		'action' => 'delete'
	],

	'admin/posts/{page:\d+}' => [//user table+
		'controller' => 'admin',
		'action' => 'posts'
	],

	'admin/posts' => [//user table+
		'controller' => 'admin',
		'action' => 'posts'
	],

	'admin/post/{id:\d+}' => [//viewing user information
		'controller' => 'admin',
		'action' => 'post'
	],

	'admin/posts/{parameter:name|surname|gender|DOB}/{type:ASC|DESC}/{page:\d+}' => [//sorting
		'controller' => 'admin',
		'action' => 'sorting'
	]
]; 