@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            
            @can('complaint_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span class="title">@lang('quickadmin.complaints.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('appeal_access')
                <li class="{{ $request->segment(2) == 'appeals' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.appeals.index') }}">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">
                                @lang('quickadmin.appeal.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('tag_access')
                <li class="{{ $request->segment(2) == 'tags' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.tags.index') }}">
                            <i class="fa fa-hashtag"></i>
                            <span class="title">
                                @lang('quickadmin.tag.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('result_access')
                <li class="{{ $request->segment(2) == 'results' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.results.index') }}">
                            <i class="fa fa-balance-scale"></i>
                            <span class="title">
                                @lang('quickadmin.result.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('city_access')
                <li class="{{ $request->segment(2) == 'cities' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.cities.index') }}">
                            <i class="fa fa-home"></i>
                            <span class="title">
                                @lang('quickadmin.city.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('reason_access')
                <li class="{{ $request->segment(2) == 'reasons' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.reasons.index') }}">
                            <i class="fa fa-frown-o"></i>
                            <span class="title">
                                @lang('quickadmin.reason.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('court_decision_access')
                <li class="{{ $request->segment(2) == 'court_decisions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.court_decisions.index') }}">
                            <i class="fa fa-gavel"></i>
                            <span class="title">
                                @lang('quickadmin.court-decision.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('faq_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-question"></i>
                    <span class="title">@lang('quickadmin.faq.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('question_access')
                <li class="{{ $request->segment(2) == 'questions' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.questions.index') }}">
                            <i class="fa fa-question"></i>
                            <span class="title">
                                @lang('quickadmin.question.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('category_access')
                <li class="{{ $request->segment(2) == 'categories' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="fa fa-car"></i>
                            <span class="title">
                                @lang('quickadmin.category.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('department_access')
                <li class="{{ $request->segment(2) == 'departments' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.departments.index') }}">
                            <i class="fa fa-flag"></i>
                            <span class="title">
                                @lang('quickadmin.department.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('comment_access')
                <li class="{{ $request->segment(2) == 'comments' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.comments.index') }}">
                            <i class="fa fa-comment"></i>
                            <span class="title">
                                @lang('quickadmin.comment.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('document_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text"></i>
                    <span class="title">@lang('quickadmin.documents.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('document_access')
                <li class="{{ $request->segment(2) == 'documents' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.documents.index') }}">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">
                                @lang('quickadmin.document.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('doccategory_access')
                <li class="{{ $request->segment(2) == 'doccategories' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.doccategories.index') }}">
                            <i class="fa fa-book"></i>
                            <span class="title">
                                @lang('quickadmin.doccategory.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('organisation_access')
                <li class="{{ $request->segment(2) == 'organisations' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.organisations.index') }}">
                            <i class="fa fa-flag-o"></i>
                            <span class="title">
                                @lang('quickadmin.organisation.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan

            

            

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
