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
	'qa_create' => 'Criar',
	'qa_save' => 'Salvar',
	'qa_edit' => 'Editar',
	'qa_view' => 'Visualizar',
	'qa_update' => 'Atualizar',
	'qa_list' => 'Listar',
	'qa_no_entries_in_table' => 'Sem entradas na tabela',
	'qa_custom_controller_index' => 'Índice de Controller personalizado.',
	'qa_logout' => 'Sair',
	'qa_add_new' => 'Novo',
	'qa_are_you_sure' => 'Tem certeza?',
	'qa_back_to_list' => 'Voltar',
	'qa_dashboard' => 'Painel',
	'qa_delete' => 'Excluir',
	'quickadmin_title' => 'Appeals',
];