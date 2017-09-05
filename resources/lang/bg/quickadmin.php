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
	'qa_create' => 'Създай',
	'qa_save' => 'Запази',
	'qa_edit' => 'Промени',
	'qa_view' => 'Покажи',
	'qa_update' => 'Обнови',
	'qa_list' => 'Списък',
	'qa_no_entries_in_table' => 'Няма записи в таблицата',
	'qa_custom_controller_index' => 'Персонализиран контролер.',
	'qa_logout' => 'Изход',
	'qa_add_new' => 'Добави нов',
	'qa_are_you_sure' => 'Сигурни ли сте?',
	'qa_back_to_list' => 'Обратно към списъка',
	'qa_dashboard' => 'Табло',
	'qa_delete' => 'Изтрий',
	'quickadmin_title' => 'Appeals',
];