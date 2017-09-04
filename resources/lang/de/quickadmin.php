<?php

return [
        'user-management' => [        'title' => 'User Management',        'created_at' => 'Time',        'fields' => [        ],    ],
        'roles' => [        'title' => 'Roles',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'users' => [        'title' => 'Users',        'created_at' => 'Time',        'fields' => [            'name' => 'Name*',            'email' => 'Email*',            'password' => 'Password*',            'role' => 'Role*',            'remember-token' => 'Remember token',        ],    ],
        'tag' => [        'title' => 'Tag',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'result' => [        'title' => 'Result',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'complaints' => [        'title' => 'Appeals',        'created_at' => 'Time',        'fields' => [        ],    ],
        'city' => [        'title' => 'City',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'reason' => [        'title' => 'Reason',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'appeal' => [        'title' => 'Appeal',        'created_at' => 'Time',        'fields' => [            'description' => 'Short description*',            'report' => 'Report*',            'appellant' => 'Appellant*',            'date' => 'Date*',            'tags' => 'Tags',            'reason' => 'Reason*',            'court-decision' => 'Court decision',        ],    ],
        'court-decision' => [        'title' => 'Court decision',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'faq' => [        'title' => 'FAQ',        'created_at' => 'Time',        'fields' => [        ],    ],
        'department' => [        'title' => 'Department',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'category' => [        'title' => 'Category',        'created_at' => 'Time',        'fields' => [            'category' => 'Category*',            'description' => 'Description',            'department' => 'Department',        ],    ],
        'question' => [        'title' => 'Question',        'created_at' => 'Time',        'fields' => [            'question' => 'Question*',            'answer' => 'Answer',            'file' => 'File',            'approved' => 'Approved',            'author' => 'Author',            'category' => 'Category*',            'department' => 'Department',        ],    ],
        'comment' => [        'title' => 'Comment',        'created_at' => 'Time',        'fields' => [            'question' => 'Question*',            'name' => 'Name*',            'email' => 'Email',            'text' => 'Comment Text*',            'file' => 'File',        ],    ],
        'documents' => [        'title' => 'Documents',        'created_at' => 'Time',        'fields' => [        ],    ],
        'organisation' => [        'title' => 'Organisation',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',        ],    ],
        'doccategory' => [        'title' => 'Category',        'created_at' => 'Time',        'fields' => [            'title' => 'Title*',            'description' => 'Description',        ],    ],
        'document' => [        'title' => 'Document',        'created_at' => 'Time',        'fields' => [            'nr' => 'Nr*',            'title' => 'Title*',            'signed' => 'Signed*',            'valid-from' => 'Valid from',            'valid-till' => 'Valid till',            'organisation' => 'Organisation*',            'category' => 'Category*',            'file' => 'File',            'changed' => 'Changed Document',        ],    ],
    'qa_create' => 'Erstellen',
    'qa_save' => 'Speichern',
    'qa_edit' => 'Bearbeiten',
    'qa_view' => 'Betrachten',
    'qa_update' => 'Aktualisieren',
    'qa_list' => 'Listen',
    'qa_no_entries_in_table' => 'Keine Einträge in Tabelle',
    'custom_controller_index' => 'Custom controller index.',
    'qa_logout' => 'Abmelden',
    'qa_add_new' => 'Hinzufügen',
    'qa_are_you_sure' => 'Sind Sie sicher?',
    'qa_back_to_list' => 'Zurück zur Liste',
    'qa_dashboard' => 'Dashboard',
    'qa_delete' => 'Löschen',
    'quickadmin_title' => 'Appeals',
];
