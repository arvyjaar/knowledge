<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Tag
        Gate::define('tag_access', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('tag_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('tag_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('tag_view', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('tag_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Result
        Gate::define('result_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('result_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('result_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('result_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('result_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Complaints
        Gate::define('complaint_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        // Auth gates for: City
        Gate::define('city_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Reason
        Gate::define('reason_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('reason_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('reason_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('reason_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('reason_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Appeal
        Gate::define('appeal_access', function ($user) {
            return in_array($user->role_id, [1, 3, 2]);
        });
        Gate::define('appeal_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('appeal_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('appeal_view', function ($user) {
            return in_array($user->role_id, [1, 3, 2]);
        });
        Gate::define('appeal_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Court decision
        Gate::define('court_decision_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('court_decision_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('court_decision_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('court_decision_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('court_decision_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Faq
        Gate::define('faq_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        // Auth gates for: Department
        Gate::define('department_access', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('department_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('department_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('department_view', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('department_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Category
        Gate::define('category_access', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('category_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('category_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('category_view', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('category_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Question
        Gate::define('question_access', function ($user) {
            return in_array($user->role_id, [1, 3, 2]);
        });
        Gate::define('question_create', function ($user) {
            return in_array($user->role_id, [1, 3, 2]);
        });
        Gate::define('question_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('question_view', function ($user) {
            return in_array($user->role_id, [1, 3, 2]);
        });
        Gate::define('question_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Comment
        Gate::define('comment_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('comment_create', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('comment_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('comment_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('comment_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        // Auth gates for: Documents
        Gate::define('document_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        // Auth gates for: Organisation
        Gate::define('organisation_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('organisation_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('organisation_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('organisation_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('organisation_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Doccategory
        Gate::define('doccategory_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('doccategory_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('doccategory_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('doccategory_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('doccategory_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Document
        Gate::define('document_access', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('document_create', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('document_edit', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('document_view', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
        Gate::define('document_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
    }
}
