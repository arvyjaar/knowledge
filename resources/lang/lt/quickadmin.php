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
		'document' => [		'title' => 'Document',		'fields' => [			'nr' => 'Nr.*',			'title' => 'Title*',			'description' => 'Description',			'signed' => 'Signed*',			'valid-from' => 'Valid from*',			'valid-till' => 'Valid till',			'category' => 'Category*',			'organisation' => 'Organisation*',			'department' => 'Department',			'changed' => 'Changed Doc.',			'file' => 'File',		],	],
	'qa_save' => 'Išsaugoti',
	'qa_update' => 'Atnaujinti',
	'qa_list' => 'Sąrašas',
	'qa_no_entries_in_table' => 'Įrašų nėra.',
	'qa_create' => 'Sukurti',
	'qa_edit' => 'Redaguoti',
	'qa_view' => 'Peržiūrėti',
	'qa_custom_controller_index' => 'Papildomo Controller\'io puslapis.',
	'qa_logout' => 'Atsijungti',
	'qa_add_new' => 'Pridėti naują',
	'qa_are_you_sure' => 'Ar esate tikri?',
	'qa_back_to_list' => 'Grįžti į sąrašą',
	'qa_dashboard' => 'Pagrindinis',
	'qa_delete' => 'Trinti',
	'qa_restore' => 'Atstatyti',
	'qa_permadel' => 'Ištrinti galutinai',
	'qa_all' => 'Rodyti viską',
	'qa_trash' => 'Rodyti ištrintus',
	'qa_delete_selected' => 'Trinti pažymėtus',
	'qa_category' => 'Kategorija',
	'qa_categories' => 'Kategorijos',
	'qa_sample_category' => 'Pavyzdinė kategorija',
	'quickadmin_title' => 'Appeals',
];