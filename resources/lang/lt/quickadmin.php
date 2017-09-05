<?php

return [
    
    'user-management' => [
        'title' => 'User Management',
        'created_at' => 'Time',
        'fields' => [
        ],
    ],
    
    'roles' => [
        'title' => 'Roles',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'users' => [
        'title' => 'Users',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Name*',
            'email' => 'Email*',
            'password' => 'Password*',
            'role' => 'Role*',
            'remember-token' => 'Remember token',
        ],
    ],
    
    'tag' => [
        'title' => 'Tag',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'result' => [
        'title' => 'Result',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'complaints' => [
        'title' => 'Appeals',
        'created_at' => 'Time',
        'fields' => [
        ],
    ],
    
    'city' => [
        'title' => 'City',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'reason' => [
        'title' => 'Reason',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'appeal' => [
        'title' => 'Appeal',
        'created_at' => 'Time',
        'fields' => [
            'description' => 'Short description*',
            'report' => 'Report*',
            'appellant' => 'Appellant*',
            'date' => 'Date*',
            'tags' => 'Tags',
            'reason' => 'Reason*',
            'court-decision' => 'Court decision',
        ],
    ],
    
    'court-decision' => [
        'title' => 'Court decision',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'faq' => [
        'title' => 'FAQ',
        'created_at' => 'Time',
        'fields' => [
        ],
    ],
    
    'department' => [
        'title' => 'Department',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'category' => [
        'title' => 'Category',
        'created_at' => 'Time',
        'fields' => [
            'category' => 'Category*',
            'description' => 'Description',
            'department' => 'Department',
        ],
    ],
    
    'question' => [
        'title' => 'Question',
        'created_at' => 'Time',
        'fields' => [
            'question' => 'Question*',
            'answer' => 'Answer',
            'file' => 'File',
            'approved' => 'Approved',
            'author' => 'Author',
            'category' => 'Category*',
            'department' => 'Department',
        ],
    ],
    
    'comment' => [
        'title' => 'Comment',
        'created_at' => 'Time',
        'fields' => [
            'question' => 'Question*',
            'name' => 'Name*',
            'email' => 'Email',
            'text' => 'Comment Text*',
            'file' => 'File',
        ],
    ],
    
    'documents' => [
        'title' => 'Documents',
        'created_at' => 'Time',
        'fields' => [
        ],
    ],
    
    'organisation' => [
        'title' => 'Organisation',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
        ],
    ],
    
    'doccategory' => [
        'title' => 'Category',
        'created_at' => 'Time',
        'fields' => [
            'title' => 'Title*',
            'description' => 'Description',
        ],
    ],
    
    'document' => [
        'title' => 'Document',
        'created_at' => 'Time',
        'fields' => [
            'nr' => 'Nr*',
            'title' => 'Title*',
            'signed' => 'Signed*',
            'valid-from' => 'Valid from',
            'valid-till' => 'Valid till',
            'organisation' => 'Organisation*',
            'category' => 'Category*',
            'file' => 'File',
            'changed' => 'Changed Document',
        ],
    ],
    'qa_save' => 'Išsaugoti',
    'qa_update' => 'Atnaujinti',
    'qa_list' => 'Sąrašas',
    'qa_no_entries_in_table' => 'Įrašų nėra.',
    'qa_create' => 'Sukurti',
    'qa_edit' => 'Redaguoti',
    'qa_view' => 'Peržiūrėti',
    'custom_controller_index' => 'Papildomo Controller\'io puslapis.',
    'qa_logout' => 'Atsijungti',
    'qa_add_new' => 'Pridėti naują',
    'qa_are_you_sure' => 'Ar esate tikri?',
    'qa_back_to_list' => 'Grįžti į sąrašą',
    'qa_dashboard' => 'Pagrindinis',
    'qa_delete' => 'Trinti',
    'quickadmin_title' => env('APP_NAME'),
];
