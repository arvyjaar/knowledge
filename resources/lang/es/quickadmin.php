<?php

return [
		'user-management' => [		'title' => 'User Management',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'fields' => [			'title' => 'Title*',		],	],
		'users' => [		'title' => 'Users',		'fields' => [			'name' => 'Name*',			'email' => 'Email*',			'password' => 'Password*',			'role' => 'Role*',			'remember-token' => 'Remember token',		],	],
		'tag' => [		'title' => 'Tag',		'fields' => [			'title' => 'Title*',		],	],
		'result' => [		'title' => 'Result',		'fields' => [			'title' => 'Title*',		],	],
		'complaints' => [		'title' => 'Appeals',		'fields' => [		],	],
		'city' => [		'title' => 'City',		'fields' => [			'title' => 'Title*',		],	],
		'reason' => [		'title' => 'Reason',		'fields' => [			'title' => 'Title*',		],	],
		'appeal' => [		'title' => 'Appeal',		'fields' => [			'description' => 'Short description*',			'report' => 'Report*',			'appellant' => 'Appellant*',			'date' => 'Date*',			'tags' => 'Tags',			'reason' => 'Reason*',			'court-decision' => 'Court decision',		],	],
		'court-decision' => [		'title' => 'Court decision',		'fields' => [			'title' => 'Title*',		],	],
		'faq' => [		'title' => 'FAQ',		'fields' => [		],	],
		'department' => [		'title' => 'Department',		'fields' => [			'title' => 'Title*',		],	],
		'category' => [		'title' => 'Category',		'fields' => [			'category' => 'Category*',			'description' => 'Description',			'department' => 'Department',		],	],
		'question' => [		'title' => 'Question',		'fields' => [			'question' => 'Question*',			'answer' => 'Answer',			'file' => 'File',			'approved' => 'Approved',			'author' => 'Author',			'category' => 'Category*',			'department' => 'Department',		],	],
		'comment' => [		'title' => 'Comment',		'fields' => [			'question' => 'Question*',			'name' => 'Name*',			'email' => 'Email',			'text' => 'Comment Text*',			'file' => 'File',		],	],
		'documents' => [		'title' => 'Documents',		'fields' => [		],	],
		'doccategory' => [		'title' => 'Doccategory',		'fields' => [			'title' => 'Title*',			'description' => 'Description',		],	],
		'organisation' => [		'title' => 'Organisation',		'fields' => [			'title' => 'Title*',		],	],
		'document' => [		'title' => 'Document',		'fields' => [			'nr' => 'Nr.*',			'title' => 'Title*',			'description' => 'Description',			'signed' => 'Signed*',			'valid-from' => 'Valid from*',			'valid-till' => 'Valid till',			'category' => 'Category*',			'organisation' => 'Organisation*',			'department' => 'Department',			'changed' => 'Changed Doc.',		],	],
	'qa_create' => 'Crear',
	'qa_save' => 'Guardar',
	'qa_edit' => 'Editar',
	'qa_view' => 'Ver',
	'qa_update' => 'Actualizar',
	'qa_list' => 'Listar',
	'qa_no_entries_in_table' => 'Sin valores en la tabla',
	'qa_custom_controller_index' => 'Índice del controlador personalizado (index).',
	'qa_logout' => 'Salir',
	'qa_add_new' => 'Agregar',
	'qa_are_you_sure' => 'Estás seguro?',
	'qa_back_to_list' => 'Regresar a la lista?',
	'qa_dashboard' => 'Tablero',
	'qa_delete' => 'Eliminar',
	'quickadmin_title' => 'Appeals',
];