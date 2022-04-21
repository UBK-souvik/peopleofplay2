<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::group(['namespace' => 'Admin'], function () {
//     Route::get('/', [
//         'uses' => 'LoginController@getLogin',
//         'as' => 'index'
//     ]);
// });

Route::group(['namespace' => 'Admin', 'prefix' => 'admin',], function () {

    Route::get('/export_excel', 'UserController@excel_index');
    Route::get('/export_excel/excel', 'UserController@excel')->name('export_excel.excel');

    Route::get('/', [
        'uses' => 'LoginController@getLogin',
        'as' => 'login'
    ]);
    Route::get('/login', [
        'uses' => 'LoginController@getLogin',
        'as' => 'admin.login'
    ]);
    Route::post('/login', [
        'uses' => 'LoginController@postLogin',
        'as' => 'admin.login'
    ]);
    Route::post('/password/forgot/email', [
        'uses' => 'ForgotPasswordController@postForgotPasswordEmail',
        'as' => 'admin.password.forgot.email'
    ]);
    Route::get('/password/reset/{token}', [
        'uses' => 'ResetPasswordController@showResetForm',
        'as' => 'admin.password.reset'
    ]);
    Route::post('/password/reset', [
        'uses' => 'ResetPasswordController@reset',
        'as' => 'admin.password.reset'
    ]);
});



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
    //Dashboard Routes
    Route::get('/dashboard', [
        'uses' => 'DashboardController@getIndex',
        'as' => 'admin.dashboard'
    ]);


    // Logout Routes
    Route::get('/logout', [
        'uses' => 'LoginController@getlogout',
        'as' => 'admin.logout'
    ]);


    /* Start Admin Controller Routes */
    Route::get('admin', [
        'uses' => 'AdminController@getIndex',
        'as' => 'admin.admins.index'
    ]);

    Route::get('admin/create', [
        'uses' => 'AdminController@getCreate',
        'as' => 'admin.admins.create'
    ]);

    Route::post('admin/create', [
        'uses' => 'AdminController@postCreate',
        'as' => 'admin.admins.create'
    ]);

    Route::get('admin/list', [
        'uses' => 'AdminController@getList',
        'as' => 'admin.admins.list'
    ]);

    Route::get('admin/update/{id?}', [
        'uses' => 'AdminController@getUpdate',
        'as' => 'admin.admins.update'
    ]);

    Route::post('admin/update/{id?}', [
        'uses' => 'AdminController@postUpdate',
        'as' => 'admin.admins.update'
    ]);

    Route::get('admin/delete/{id?}', [
        'uses' => 'AdminController@getDelete',
        'as' => 'admin.admins.delete'
    ]);

    Route::get('admin/view/{id?}', [
        'uses' => 'AdminController@getView',
        'as' => 'admin.admins.view'
    ]);

    Route::get('admin/permission/{id?}', [
        'uses' => 'AdminController@getPermission',
        'as' => 'admin.admins.permission'
    ]);

    Route::post('admin/permission/{id?}', [
        'uses' => 'AdminController@savePermission',
        'as' => 'admin.admins.permission.save'
    ]);


    Route::post('admin-account/reset-password/{id?}', [
        'uses' => 'AdminController@postPasswordReset',
        'as' => 'admin.admins.password-reset'
    ]);

    Route::get('admin-account/reset-password/{id?}', [
        'uses' => 'AdminController@getPasswordReset',
        'as' => 'admin.admins.password-reset'
    ]);
    /* End Admin Controller Routes */


    /* Start Navigation Routes */
    Route::get('navigation', [
        'uses' => 'NavigationController@getIndex',
        'as' => 'admin.navigation.index'
    ]);

    Route::get('navigation/create', [
        'uses' => 'NavigationController@getCreate',
        'as' => 'admin.navigation.create'
    ]);

    Route::post('navigation/create', [
        'uses' => 'NavigationController@postCreate',
        'as' => 'admin.navigation.create'
    ]);

    Route::get('navigation/list', [
        'uses' => 'NavigationController@getList',
        'as' => 'admin.navigation.list'
    ]);

    Route::get('navigation/update/{id?}', [
        'uses' => 'NavigationController@getUpdate',
        'as' => 'admin.navigation.update'
    ]);

    Route::post('navigation/update/{id?}', [
        'uses' => 'NavigationController@postUpdate',
        'as' => 'admin.navigation.update'
    ]);
    /* End Navigation Routes */


    /* Start Role Routes */
    Route::get('role', [
        'uses' => 'RoleController@getIndex',
        'as' => 'admin.role.index'
    ]);

    Route::get('role/list', [
        'uses' => 'RoleController@getList',
        'as' => 'admin.role.list'
    ]);

    Route::get('role/create', [
        'uses' => 'RoleController@getCreate',
        'as' => 'admin.role.create'
    ]);

    Route::post('role/create', [
        'uses' => 'RoleController@postCreate',
        'as' => 'admin.role.create'
    ]);


    Route::get('role/update/{id?}', [
        'uses' => 'RoleController@getUpdate',
        'as' => 'admin.role.update'
    ]);

    Route::post('role/update/{id?}', [
        'uses' => 'RoleController@postUpdate',
        'as' => 'admin.role.update'
    ]);

    Route::get('role/permission/{id?}', [
        'uses' => 'RoleController@getPermission',
        'as' => 'admin.role.permission'
    ]);

    Route::post('role/permission/{id?}', [
        'uses' => 'RoleController@savePermission',
        'as' => 'admin.role.permission.save'
    ]);



    Route::get('permission', [
        'uses' => 'PermissionController@getIndex',
        'as' => 'admin.permission.index'
    ]);

    Route::get('permission/list', [
        'uses' => 'PermissionController@getList',
        'as' => 'admin.permission.list'
    ]);

    Route::get('permission/create', [
        'uses' => 'PermissionController@getCreate',
        'as' => 'admin.permission.create'
    ]);

    Route::post('permission/create', [
        'uses' => 'PermissionController@postCreate',
        'as' => 'admin.permission.create'
    ]);


    Route::get('permission/update/{id?}', [
        'uses' => 'PermissionController@getUpdate',
        'as' => 'admin.permission.update'
    ]);

    Route::post('permission/update/{id?}', [
        'uses' => 'PermissionController@postUpdate',
        'as' => 'admin.permission.update'
    ]);

    Route::get('permission/permission/{id?}', [
        'uses' => 'PermissionController@get_frontend_Permission',
        'as' => 'admin.permission.permission'
    ]);

    Route::post('permission/permission/{id?}', [
        'uses' => 'PermissionController@save_frontend_Permission',
        'as' => 'admin.permission.permission.save'
    ]);



    /* End Role Routes */

    /*Start route for newletter*/
    Route::get('newsletter', [
        'uses' => 'UserController@getNewsletter',
        'as' => 'admin.newsletter.index'
    ]);

    Route::get('newsletter/list', [
        'uses' => 'UserController@getNewsletterList',
        'as' => 'admin.newsletter.list'
    ]);


    Route::get('reports', [
        'uses' => 'UserController@getReports',
        'as' => 'admin.reports.index'
    ]);

    Route::get('reports/list', [
        'uses' => 'UserController@getReportsList',
        'as' => 'admin.reports.list'
    ]);

    Route::get('profile_type', [
        'uses' => 'UserController@getProfileType',
        'as' => 'admin.profile_type.index'
    ]);

    Route::get('profile_type/list', [
        'uses' => 'UserController@getProfileTypeList',
        'as' => 'admin.profile_type.list'
    ]);

    Route::match(['get','post'],'profile_type/edit/{id?}', [
        'uses' => 'UserController@getProfileTypeEdit',
        'as' => 'admin.profile_type.edit'
    ]);

    /*End route for newletter*/


    /* Start User Routes */

	Route::get('/users/skills/getTagsDropdown', [
        'uses' => 'AdminModuleController@admin_get_tags_dropdown',
        'as' => 'admin.user.profile.edit.getTagsDropdown'
    ]);

	Route::get('/users/blog_tags/getBlogTagsDropdown', [
        'uses' => 'AdminModuleController@admin_get_blog_tags_dropdown',
        'as' => 'admin.user.profile.edit.getBlogTagsDropdown'
    ]);

    Route::get('users', [
        'uses' => 'UserController@getIndex',
        'as' => 'admin.users.index'
    ]);

    Route::get('users/list', [
        'uses' => 'UserController@getList',
        'as' => 'admin.users.list'
    ]);

    Route::get('users/create', [
        'uses' => 'UserController@getCreate',
        'as' => 'admin.users.create'
    ]);

    Route::post('users/create', [
        'uses' => 'UserController@postCreate',
        'as' => 'admin.users.create'
    ]);

    Route::get('users/update/{id?}', [
        'uses' => 'UserController@getUpdate',
        'as' => 'admin.users.update'
    ]);

    Route::post('users/update/{id?}', [
        'uses' => 'UserController@postUpdate',
        'as' => 'admin.users.update'
    ]);

    Route::get('users/delete/{id?}', [
        'uses' => 'UserController@getDelete',
        'as' => 'admin.users.delete'
    ]);
    Route::get('users/view/{id?}', [
        'uses' => 'UserController@getView',
        'as' => 'admin.users.view'
    ]);

    Route::get('basic_users', [
        'uses' => 'UserController@basic_getIndex',
        'as' => 'admin.basic.users.index'
    ]);

    Route::get('basic_users/list', [
        'uses' => 'UserController@basic_getList',
        'as' => 'admin.basic.users.list'
    ]);

    Route::get('basic_users/view/{id?}', [
        'uses' => 'UserController@basic_getView',
        'as' => 'admin.basic.users.view'
    ]);

    Route::get('basic_users/showadd', [
        'uses' => 'UserController@basic_showAddUser',
        'as' => 'admin.basic.users.showadd'
    ]);
    Route::post('basic_users/save-add-edit/{id?}', [
        'uses' => 'UserController@saveAddEditUser',
        'as' => 'admin.basic.users.save-add-edit'
    ]);

    Route::get('basic_users/reset-password/{id?}', [
        'uses' => 'UserController@getPasswordReset',
        'as' => 'admin.basic_users.password-reset'
    ]);

    Route::match(['get','post'],'basic_users/showedit/{id?}', [
        'uses' => 'UserController@showEditBasic_users',
        'as' => 'admin.basic_users.showedit'
    ]);

    Route::get('free_users', [
        'uses' => 'UserController@free_getIndex',
        'as' => 'admin.free.users.index'
    ]);

    Route::get('free_users/list', [
        'uses' => 'UserController@free_getList',
        'as' => 'admin.free.users.list'
    ]);


    Route::get('verify_users', [
        'uses' => 'UserController@verify_getIndex',
        'as' => 'admin.verify.users.index'
    ]);

     Route::get('verify_users/list', [
        'uses' => 'UserController@verify_getList',
        'as' => 'admin.verify.users.list'
    ]);

    Route::post('verify_users/status_change', [
        'uses' => 'UserController@statusChange',
        'as' => 'admin.verify.users.change'
    ]);


    Route::get('free_users/view/{id?}', [
        'uses' => 'UserController@free_getView',
        'as' => 'admin.free.users.view'
    ]);

     Route::get('free_users/reset-password/{id?}', [
        'uses' => 'UserController@getPasswordReset',
        'as' => 'admin.free_users.password-reset'
    ]);

    Route::match(['get','post'],'free_users/showedit/{id?}', [
        'uses' => 'UserController@showEditFree_users',
        'as' => 'admin.free_users.showedit'
    ]);

    Route::post('users/reset-password/{id?}', [
        'uses' => 'UserController@postPasswordReset',
        'as' => 'admin.users.password-reset'
    ]);

    Route::get('users/reset-password/{id?}', [
        'uses' => 'UserController@getPasswordReset',
        'as' => 'admin.users.password-reset'
    ]);

	Route::get('users/showadd', [
        'uses' => 'UserController@showAddUser',
        'as' => 'admin.users.showadd'
    ]);
	Route::post('users/save-add-edit/{id?}', [
        'uses' => 'UserController@saveAddEditUser',
        'as' => 'admin.users.save-add-edit'
    ]);

    Route::get('users/getTags', [
        'uses' => 'UserController@get_tags',
        'as' => 'admin.users.getTags'
    ]);

	Route::get('users/showedit/{id?}', [
        'uses' => 'UserController@showEditUser',
        'as' => 'admin.users.showedit'
    ]);


	Route::get('users/delete-role-data/{user_id}/{role_id}', [
        'uses' => 'UserController@deleteUserRole',
        'as' => 'admin.users.delete-role-data'
    ]);

    Route::get('companies', [
        'uses' => 'UserController@getIndexCompany',
        'as' => 'admin.companies.index'
    ]);

    Route::get('companies/list', [
        'uses' => 'UserController@getListCompany',
        'as' => 'admin.companies.list'
    ]);

    Route::get('users/showaddCompany', [
        'uses' => 'UserController@showaddCompany',
        'as' => 'admin.users.showaddCompany'
    ]);

    Route::get('users/showeditCompany/{id?}', [
        'uses' => 'UserController@showEditCompany',
        'as' => 'admin.users.showeditCompany'
    ]);

    Route::post('users/save-add-edit-Company/{id?}', [
        'uses' => 'UserController@saveAddEditCompany',
        'as' => 'admin.users.save-add-edit-Company'
    ]);


	Route::get('users/FunctionName', [
        'uses' => 'UserController@FunctionName',
        'as' => 'admin.users.FunctionName'
    ]);

	Route::get('read-csv/get-import-csv-data', [
        'uses' => 'ImportCsvController@readImportCsv',
        'as' => 'admin.csv.get.import.data'
    ]);

	Route::post('read-csv/read-import-csv-data', [
        'uses' => 'ImportCsvController@readImportCsv',
        'as' => 'admin.csv.read.import.data'
    ]);

	Route::get('import-csv/import-users-data', [
        'uses' => 'ImportCsvController@showUserImportCsv',
        'as' => 'admin.users.show.import.csv'
    ]);

	Route::post('import-csv/save-import-users-data', [
        'uses' => 'ImportCsvController@showUserImportCsv',
        'as' => 'admin.users.save-import-users-data.csv'
    ]);

	Route::get('import-csv/import-company-users-data', [
        'uses' => 'ImportCsvController@showCompanyImportCsv',
        'as' => 'admin.users.company.show.import.csv'
    ]);

	Route::post('import-csv/save-import-company-users-data', [
        'uses' => 'ImportCsvController@showCompanyImportCsv',
        'as' => 'admin.users.company.save-import-users-data.csv'
    ]);

	Route::get('import-csv/import-invoice-csv-data', [
        'uses' => 'ImportCsvController@showInvoiceImportCsv',
        'as' => 'admin.users.company.show.import.csv'
    ]);

	Route::post('import-csv/save-import-invoice-csv-data', [
        'uses' => 'ImportCsvController@showInvoiceImportCsv',
        'as' => 'admin.subscripitions.save-import-invoice-data.csv'
    ]);

    Route::get('companies/view/{id?}', [
        'uses' => 'UserController@getViewCompany',
        'as' => 'admin.companies.view'
    ]);

    Route::get('payments', [
        'uses' => 'UserController@getPayments',
        'as' => 'admin.payments'
    ]);

    Route::get('payments/list', [
        'uses' => 'UserController@getPaymentList',
        'as' => 'admin.payments.list'
    ]);
    Route::get('payments/view/{id}', [
        'uses' => 'UserController@getPaymentView',
        'as' => 'admin.payments.view'
    ]);

    Route::get('transactions', [
        'uses' => 'UserController@getTransactions',
        'as' => 'admin.transactions'
    ]);

    Route::get('transactions/list', [
        'uses' => 'UserController@getTransactionList',
        'as' => 'admin.transactions.list'
    ]);

    Route::get('user/subscription/refund/{id}', [
        'uses' => 'UserController@refund_subscription',
        'as' => 'admin.subscription.refund'
    ]);

    Route::get('/user/subscription/cancel/{id}', [
        'uses' => 'UserController@cancel_subscription',
        'as' => 'admin.subscription.cancel'
    ]);


	Route::post('/user/profile/admin-role-get-people-data', [
        'uses' => 'AdminModuleController@getAdminPeopleData',
        'as' => 'admin.user.role.search.people'
    ]);

    Route::post('/user/profile/admin-role-get-company-data', [
        'uses' => 'AdminModuleController@getAdminCompanyData',
        'as' => 'admin.user.role.search.company'
    ]);

   Route::post('/user/profile/admin-role-get-product-data', [
        'uses' => 'AdminModuleController@getAdminProductData',
        'as' => 'admin.user.role.search.product'
    ]);

	Route::post('/user/profile/admin-role-get-brand-list-data', [
        'uses' => 'AdminModuleController@getAdminBrandListData',
        'as' => 'admin.user.role.search.brand_list'
    ]);


	Route::get('/user/profile/admin-get-user-role-data-ajax/{user_id}/{random_time_stamp}/{int_role_type_id_data_new}', [
        'uses' => 'AdminModuleController@getAdminUserRoleData',
        'as' => 'admin.user.profile.role.data.ajax'
    ]);

	Route::post('/user/profile/admin-role-profile-data/edit', [
        'uses' => 'AdminModuleController@postAdminUserProfileRoleEdit',
        'as' => 'admin.user.profile.role.edit'
    ]);

	Route::get('/user/admin-delete-user-role-data-ajax/{id}', [
        'uses' => 'AdminModuleController@deleteAdminRoleData',
        'as' => 'admin.user.profile.role.delete'
    ]);

	/* End User Routes */

	/* Brands */

	Route::get('brands', [
        'uses' => 'BrandController@getIndex',
        'as' => 'admin.brands.index'
    ]);

	Route::get('brands/list', [
        'uses' => 'BrandController@getList',
        'as' => 'admin.brands.list'
    ]);

	Route::get('brands/delete/{id?}', [
        'uses' => 'BrandController@getDelete',
        'as' => 'admin.brands.delete'
    ]);

	Route::get('brands/showadd', [
        'uses' => 'BrandController@showAddBrand',
        'as' => 'admin.brands.showadd'
    ]);

	Route::get('brands/showedit/{id?}', [
        'uses' => 'BrandController@showEditBrand',
        'as' => 'admin.brands.showedit'
    ]);

	Route::post('brands/save-add-edit/{id?}', [
        'uses' => 'BrandController@saveAddEditBrand',
        'as' => 'admin.brands.save-add-edit'
    ]);

    /* End Brands */

	/* Advertisements */

	Route::get('advertisements/all_index/{is_default?}/{category_id?}', [
        'uses' => 'AdvertisementController@getIndex',
        'as' => 'admin.advertisements.index'
    ]);

	Route::get('advertisements/list/{is_default?}/{category_id?}', [
        'uses' => 'AdvertisementController@getList',
        'as' => 'admin.advertisements.list'
    ]);

	Route::get('advertisements/delete/{id?}', [
        'uses' => 'AdvertisementController@getDelete',
        'as' => 'admin.advertisements.delete'
    ]);

	Route::get('advertisements/showadd/{is_default?}', [
        'uses' => 'AdvertisementController@showAddAdvertisement',
        'as' => 'admin.advertisements.showadd'
    ]);

	Route::get('advertisements/showedit/{id?}/{is_default?}', [
        'uses' => 'AdvertisementController@showEditAdvertisement',
        'as' => 'admin.advertisements.showedit'
    ]);

	Route::post('advertisements/save-add-edit/{id?}/{is_default?}', [
        'uses' => 'AdvertisementController@saveAddEditAdvertisement',
        'as' => 'admin.advertisements.save-add-edit'
    ]);

    /* End Advertisements */

	/* Galleries */

	Route::get('galleries/all_index/{user_id?}/{media_id?}', [
        'uses' => 'ManageGalleryController@getIndex',
        'as' => 'admin.galleries.index'
    ]);

	Route::get('galleries/list/{user_id?}/{media_id?}', [
        'uses' => 'ManageGalleryController@getList',
        'as' => 'admin.galleries.list'
    ]);

	Route::get('galleries/delete/{id?}', [
        'uses' => 'ManageGalleryController@getDelete',
        'as' => 'admin.galleries.delete'
    ]);

	Route::get('galleries/showadd/{gallery_type?}', [
        'uses' => 'ManageGalleryController@showAddGallery',
        'as' => 'admin.galleries.showadd'
    ]);

	Route::get('galleries/showedit/{id?}/{gallery_type?}', [
        'uses' => 'ManageGalleryController@showEditGallery',
        'as' => 'admin.galleries.showedit'
    ]);

	Route::post('galleries/save-add-edit/{id?}/{gallery_type?}', [
        'uses' => 'ManageGalleryController@saveAddEditGallery',
        'as' => 'admin.galleries.save-add-edit'
    ]);

	Route::post('galleries/get-user-product-event/', [
        'uses' => 'ManageGalleryController@getUserProductEvents',
        'as' => 'admin.galleries.get.user.product.event'
    ]);

    /* End Galleries */

	/* Notes */

	Route::get('notes/all_index', [
        'uses' => 'ManageNotesController@getIndex',
        'as' => 'admin.notes.index'
    ]);

	Route::get('notes/list', [
        'uses' => 'ManageNotesController@getList',
        'as' => 'admin.notes.list'
    ]);

	Route::get('notes/delete/{id?}', [
        'uses' => 'ManageNotesController@getDelete',
        'as' => 'admin.notes.delete'
    ]);

	Route::get('notes/showadd', [
        'uses' => 'ManageNotesController@showAddNotes',
        'as' => 'admin.notes.showadd'
    ]);

	Route::get('notes/showedit/{id?}', [
        'uses' => 'ManageNotesController@showEditNotes',
        'as' => 'admin.notes.showedit'
    ]);

	Route::post('notes/save-add-edit/{id?}', [
        'uses' => 'ManageNotesController@saveAddEditNotes',
        'as' => 'admin.notes.save-add-edit'
    ]);

	Route::post('notes/get-user-product-event/', [
        'uses' => 'ManageNotesController@getUserProductEvents',
        'as' => 'admin.notes.get.user.product.event'
    ]);

    /* End Notes */

	/* Article Category */

	Route::get('knowledge-base/article-categories', [
        'uses' => 'ArticleCategoryController@getIndex',
        'as' => 'admin.knowledge-base-article-categories.index'
    ]);

	Route::get('knowledge-base/article-categories/list', [
        'uses' => 'ArticleCategoryController@getList',
        'as' => 'admin.knowledge-base-article-categories.list'
    ]);

	Route::get('knowledge-base/article-categories/delete/{id?}', [
        'uses' => 'ArticleCategoryController@getDelete',
        'as' => 'admin.knowledge-base-article-categories.delete'
    ]);

	Route::get('knowledge-base/article-categories/showadd', [
        'uses' => 'ArticleCategoryController@showAddArticleCategory',
        'as' => 'admin.knowledge-base-article-categories.showadd'
    ]);

	Route::get('knowledge-base/article-categories/showedit/{id?}', [
        'uses' => 'ArticleCategoryController@showEditArticleCategory',
        'as' => 'admin.knowledge-base-article-categories.showedit'
    ]);

	Route::post('knowledge-base/article-categories/save-add-edit/{id?}', [
        'uses' => 'ArticleCategoryController@saveAddEditArticleCategory',
        'as' => 'admin.knowledge-base-article-categories.save-add-edit'
    ]);

    /* End Article Category */

	/* Article */

	Route::get('knowledge-base/articles', [
        'uses' => 'ArticleController@getIndex',
        'as' => 'admin.knowledge-base-articles.index'
    ]);

	Route::get('knowledge-base/articles/list', [
        'uses' => 'ArticleController@getList',
        'as' => 'admin.knowledge-base-articles.list'
    ]);

	Route::get('knowledge-base/articles/delete/{id?}', [
        'uses' => 'ArticleController@getDelete',
        'as' => 'admin.knowledge-base-articles.delete'
    ]);

	Route::get('knowledge-base/articles/showadd', [
        'uses' => 'ArticleController@showAddArticle',
        'as' => 'admin.knowledge-base-articles.showadd'
    ]);

	Route::get('knowledge-base/articles/showedit/{id?}', [
        'uses' => 'ArticleController@showEditArticle',
        'as' => 'admin.knowledge-base-articles.showedit'
    ]);

	Route::post('knowledge-base/articles/save-add-edit/{id?}', [
        'uses' => 'ArticleController@saveAddEditArticle',
        'as' => 'admin.knowledge-base-articles.save-add-edit'
    ]);

    /* End Article */

	/* Faq Category */

	Route::get('knowledge-base/faq-categories', [
        'uses' => 'FaqCategoryController@getIndex',
        'as' => 'admin.knowledge-base-faq-categories.index'
    ]);

	Route::get('knowledge-base/faq-categories/list', [
        'uses' => 'FaqCategoryController@getList',
        'as' => 'admin.knowledge-base-faq-categories.list'
    ]);

	Route::get('knowledge-base/faq-categories/delete/{id?}', [
        'uses' => 'FaqCategoryController@getDelete',
        'as' => 'admin.knowledge-base-faq-categories.delete'
    ]);

	Route::get('knowledge-base/faq-categories/showadd', [
        'uses' => 'FaqCategoryController@showAddFaqCategory',
        'as' => 'admin.knowledge-base-faq-categories.showadd'
    ]);

	Route::get('knowledge-base/faq-categories/showedit/{id?}', [
        'uses' => 'FaqCategoryController@showEditFaqCategory',
        'as' => 'admin.knowledge-base-faq-categories.showedit'
    ]);

	Route::post('knowledge-base/faq-categories/save-add-edit/{id?}', [
        'uses' => 'FaqCategoryController@saveAddEditFaqCategory',
        'as' => 'admin.knowledge-base-faq-categories.save-add-edit'
    ]);

    /* End Faq Category */

	/* Faq Question */

	Route::get('knowledge-base/faq-questions', [
        'uses' => 'FaqQuestionController@getIndex',
        'as' => 'admin.knowledge-base-faq-questions.index'
    ]);

	Route::get('knowledge-base/faq-questions/list', [
        'uses' => 'FaqQuestionController@getList',
        'as' => 'admin.knowledge-base-faq-questions.list'
    ]);

	Route::get('knowledge-base/faq-questions/delete/{id?}', [
        'uses' => 'FaqQuestionController@getDelete',
        'as' => 'admin.knowledge-base-faq-questions.delete'
    ]);

	Route::get('knowledge-base/faq-questions/showadd', [
        'uses' => 'FaqQuestionController@showAddFaqQuestion',
        'as' => 'admin.knowledge-base-faq-questions.showadd'
    ]);

	Route::get('knowledge-base/faq-questions/showedit/{id?}', [
        'uses' => 'FaqQuestionController@showEditFaqQuestion',
        'as' => 'admin.knowledge-base-faq-questions.showedit'
    ]);

	Route::post('knowledge-base/faq-questions/save-add-edit/{id?}', [
        'uses' => 'FaqQuestionController@saveAddEditFaqQuestion',
        'as' => 'admin.knowledge-base-faq-questions.save-add-edit'
    ]);

    /* End Faq Question */


    /* Start product Routes */
        Route::get('/products-export', [
            'uses' => 'ProductController@products_export',
            'as' => 'admin.products.export'
        ]);

        Route::get('/products', [
            'uses' => 'ProductController@getIndex',
            'as' => 'admin.products.index'
        ]);

        Route::get('product/list', [
	        'uses' => 'ProductController@getList',
	        'as' => 'admin.product.list'
	    ]);

    	Route::get('products/create', [
	        'uses' => 'ProductController@getCreate',
	        'as' => 'admin.products.create'
	    ]);

        Route::post('products/create', [
            'uses' => 'ProductController@postCreate',
            'as' => 'admin.products.create'
        ]);

        Route::get('product/update/{id?}', [
	        'uses' => 'ProductController@getUpdate',
	        'as' => 'admin.product.update'
	    ]);

        Route::get('product/view/{id?}', [
            'uses' => 'ProductController@getView',
            'as' => 'admin.product.view'
        ]);

	    Route::get('product/delete/{id?}', [
	        'uses' => 'ProductController@getDelete',
	        'as' => 'admin.product.delete'
	    ]);

	    Route::post('/product/collaborator/AddEdit', [
	        'uses' => 'ProductController@collaborator_AddEdit',
	        'as' => 'admin.product.collaborator.AddEdit'
	    ]);

	    Route::get('/product/collaborator/delete/{id}', [
	        'uses' => 'ProductController@collaborator_delete',
	        'as' => 'admin.product.collaborator.delete()'
	    ]);

        Route::get('/product/get_sub_category', [
            'uses' => 'ProductController@get_sub_category',
            'as' => 'admin.product.get_sub_category'
        ]);

        Route::get('/product/get_category_BYGroup', [
            'uses' => 'ProductController@get_category_BYGroup',
            'as' => 'admin.product.get_category_BYGroup'
        ]);
    /* End product Routes */

	/* Start brand list Routes */
        Route::get('/brand_lists_export', [
            'uses' => 'BrandListController@brand_lists_export',
            'as' => 'admin.brand_lists.export'
        ]);

        Route::get('/brand_lists', [
            'uses' => 'BrandListController@getIndex',
            'as' => 'admin.brand_lists.index'
        ]);

        Route::get('brand_list/list', [
	        'uses' => 'BrandListController@getList',
	        'as' => 'admin.brand_list.list'
	    ]);

    	Route::get('brand_lists/create', [
	        'uses' => 'BrandListController@getCreate',
	        'as' => 'admin.brand_lists.create'
	    ]);

        Route::post('brand_lists/create', [
            'uses' => 'BrandListController@postCreate',
            'as' => 'admin.brand_lists.create'
        ]);

        Route::get('brand_list/update/{id?}', [
	        'uses' => 'BrandListController@getUpdate',
	        'as' => 'admin.brand_list.update'
	    ]);

        Route::get('brand_list/view/{id?}', [
            'uses' => 'BrandListController@getView',
            'as' => 'admin.brand_list.view'
        ]);

	    Route::get('brand_list/delete/{id?}', [
	        'uses' => 'BrandListController@getDelete',
	        'as' => 'admin.brand_list.delete'
	    ]);

	    Route::post('/brand_list/collaborator/AddEdit', [
	        'uses' => 'BrandListController@collaborator_AddEdit',
	        'as' => 'admin.brand_list.collaborator.AddEdit'
	    ]);

	    Route::get('/brand_list/collaborator/delete/{id}', [
	        'uses' => 'BrandListController@collaborator_delete',
	        'as' => 'admin.brand_list.collaborator.delete()'
	    ]);

        Route::get('/brand_list/get_sub_category', [
            'uses' => 'BrandListController@get_sub_category',
            'as' => 'admin.brand_list.get_sub_category'
        ]);

        Route::get('/brand_list/get_category_BYGroup', [
            'uses' => 'BrandListController@get_category_BYGroup',
            'as' => 'admin.brand_list.get_category_BYGroup'
        ]);
    /* End brand list Routes */


    /* Start user list Page Routes */
        Route::get('/user_role', [
            'uses' => 'ProductController@User_role_Index',
            'as' => 'admin.user_role.index'
        ]);

        Route::get('user_role/list', [
            'uses' => 'ProductController@User_role_getList',
            'as' => 'admin.user_role.list'
        ]);

        Route::match(['get','post'],'user_role/create', [
            'uses' => 'ProductController@User_role_getCreate',
            'as' => 'admin.user_role.create'
        ]);

        Route::get('user_role/update/{id?}', [
            'uses' => 'ProductController@User_role_getUpdate',
            'as' => 'admin.user_role.update'
        ]);

        Route::get('user_role/delete/{id?}', [
            'uses' => 'ProductController@User_role_getDelete',
            'as' => 'admin.user_role.delete'
        ]);
    /* End user role Page Routes */


    /* Start category Page Routes */
        Route::get('/category', [
            'uses' => 'SubCategoryController@category_getIndex',
            'as' => 'admin.category.index'
        ]);

        Route::get('category/list', [
            'uses' => 'SubCategoryController@category_getList',
            'as' => 'admin.category.list'
        ]);

        Route::match(['get','post'],'category/create', [
            'uses' => 'SubCategoryController@category_getCreate',
            'as' => 'admin.category.create'
        ]);

        Route::get('category/update/{id?}', [
            'uses' => 'SubCategoryController@category_getUpdate',
            'as' => 'admin.category.update'
        ]);

        Route::get('category/delete/{id?}', [
            'uses' => 'SubCategoryController@getDelete',
            'as' => 'admin.category.delete'
        ]);
    /* End category Page Routes */


    /* Start Sub category Page Routes */
         Route::get('/bulk_upload', [
            'uses' => 'SubCategoryController@bulk_upload',
            'as' => 'admin.bulk_upload'
        ]);

        Route::get('/sub_category', [
            'uses' => 'SubCategoryController@getIndex',
            'as' => 'admin.sub_category.index'
        ]);

        Route::get('sub_category/list', [
            'uses' => 'SubCategoryController@getList',
            'as' => 'admin.sub_category.list'
        ]);

        Route::match(['get','post'],'sub_category/create', [
            'uses' => 'SubCategoryController@getCreate',
            'as' => 'admin.sub_category.create'
        ]);

        Route::get('sub_category/update/{id?}', [
            'uses' => 'SubCategoryController@getUpdate',
            'as' => 'admin.sub_category.update'
        ]);

        Route::get('sub_category/delete/{id?}', [
            'uses' => 'SubCategoryController@getDelete',
            'as' => 'admin.sub_category.delete'
        ]);
    /* End Sub category Page Routes */


    /* Start company category Page Routes */
        Route::get('/company-category', [
            'uses' => 'CompanyCategoryController@category_getIndex',
            'as' => 'admin.company-category.index'
        ]);

        Route::get('company-category/list', [
            'uses' => 'CompanyCategoryController@category_getList',
            'as' => 'admin.company-category.list'
        ]);

        Route::match(['get','post'],'company-category/create', [
            'uses' => 'CompanyCategoryController@category_getCreate',
            'as' => 'admin.company-category.create'
        ]);

        Route::get('company-category/update/{id?}', [
            'uses' => 'CompanyCategoryController@category_getUpdate',
            'as' => 'admin.company-category.update'
        ]);

        Route::get('company-category/delete/{id?}', [
            'uses' => 'CompanyCategoryController@category_getDelete',
            'as' => 'admin.company-category.delete'
        ]);
    /* End Company category Page Routes */

    /* Start Feeds category Page Routes */
        Route::get('/feeds_category', [
            'uses' => 'FeedsCategoryController@category_getIndex',
            'as' => 'admin.feeds-category.index'
        ]);

        Route::get('feeds-category/list', [
            'uses' => 'FeedsCategoryController@category_getList',
            'as' => 'admin.feeds-category.list'
        ]);

        Route::match(['get','post'],'feeds-category/create', [
            'uses' => 'FeedsCategoryController@category_getCreate',
            'as' => 'admin.feeds-category.create'
        ]);

        Route::get('feeds-category/update/{id?}', [
            'uses' => 'FeedsCategoryController@category_getUpdate',
            'as' => 'admin.feeds-category.update'
        ]);

        Route::get('feeds-category/delete/{id?}', [
            'uses' => 'FeedsCategoryController@category_getDelete',
            'as' => 'admin.feeds-category.delete'
        ]);

        Route::get('news_feeds_user_status', [
            'uses' => 'FeedsCategoryController@news_feeds_user_status',
            'as' => 'admin.feeds.news_feeds_user_status'
        ]);
    /* End Feeds category Page Routes */

    /* Start News Feeds Page Routes */
        Route::get('/news_feeds', [
            'uses' => 'NewsFeedsController@news_feeds_getIndex',
            'as' => 'admin.news_feeds.index'
        ]);

        Route::get('news_feeds/list', [
            'uses' => 'NewsFeedsController@news_feeds_getList',
            'as' => 'admin.news_feeds.list'
        ]);

        Route::get('/news_feeds/featured_news_feeds', [
            'uses' => 'NewsFeedsController@featured_news_feeds_getIndex',
            'as' => 'admin.news_feeds.featured_news_feeds'
        ]);

        Route::get('news_feeds/featured_news_feeds_list', [
            'uses' => 'NewsFeedsController@featured_news_feeds_list',
            'as' => 'admin.news_feeds.featured_news_feeds_list'
        ]);

        Route::match(['get','post'],'news_feeds/featured_news/create', [
            'uses' => 'NewsFeedsController@featured_news_getCreate',
            'as' => 'admin.news_feeds.featured_news.create'
        ]);

        Route::get('/news_feeds/featured_news/update/{id?}', [
            'uses' => 'NewsFeedsController@featured_news_getUpdate',
            'as' => 'admin.news_feeds.featured_news.update'
        ]);

        Route::match(['get','post'],'news_feeds/create', [
            'uses' => 'NewsFeedsController@news_feeds_getCreate',
            'as' => 'admin.news_feeds.create'
        ]);

        Route::get('/news_feeds/update/{id?}', [
            'uses' => 'NewsFeedsController@news_feeds_getUpdate',
            'as' => 'admin.news_feeds.update'
        ]);

        Route::get('/news_feeds/delete/{id?}', [
            'uses' => 'NewsFeedsController@news_feeds_getDelete',
            'as' => 'admin.news_feeds.delete'
        ]);

        Route::post('/news_feeds/get_youtube_thumbnail', [
            'uses' => 'NewsFeedsController@postYoutubeThumbnail',
            'as' => 'admin.news_feeds.get_youtube_thumbnail'
        ]);

        Route::get('news_feeds_user_status', [
            'uses' => 'NewsFeedsController@news_feeds_user_status',
            'as' => 'admin.feeds.news_feeds_user_status'
        ]);
    /* End News Feeds Page Routes */

    /* Start Bloom Reports Page Routes */

        Route::get('/bloom_reports_test', [
            'uses' => 'BloomReportsController@index',
            'as' => 'admin.bloom_reports.index'
        ]);
        Route::get('/bloom_reports_test_advt_image_list', [
            'uses' => 'BloomReportsController@getAdvtImageList',
            'as' => 'admin.bloom_reports.advt_image_list'
        ]);
        Route::get('/bloom_reports_test_list', [
            'uses' => 'BloomReportsController@getList',
            'as' => 'admin.bloom_reports.list'
        ]);
        Route::get('/bloom_reports_test_weekly_report_list', [
            'uses' => 'BloomReportsController@getWeeklyReportList',
            'as' => 'admin.bloom_reports.weekly_report_list'
        ]);
        Route::get('/bloom_reports_test_create', [
            'uses' => 'BloomReportsController@getCreate',
            'as' => 'admin.bloom_reports.create'
        ]);
        Route::post('/bloom_reports_test_submit', [
            'uses' => 'BloomReportsController@postSubmit',
            'as' => 'admin.bloom_reports.submit'
        ]);

    /* End Bloom Reports Page Routes */

	/* start skill */
	Route::get('skills', [
        'uses' => 'SkillsController@getIndex',
        'as' => 'admin.skills.index'
    ]);

	Route::get('skill/list', [
        'uses' => 'SkillsController@getList',
        'as' => 'admin.skills.list'
    ]);

	Route::get('skill/delete/{id?}', [
        'uses' => 'SkillsController@getDelete',
        'as' => 'admin.skills.delete'
    ]);

	/* end skill */

	/* start collection */
	Route::get('collection', [
        'uses' => 'CollectionController@getIndex',
        'as' => 'admin.collection.index'
    ]);

    Route::get('collection/list', [
        'uses' => 'CollectionController@getList',
        'as' => 'admin.collection.list'
    ]);

    Route::get('collection/create', [
        'uses' => 'CollectionController@getCreate',
        'as' => 'admin.collection.create'
    ]);

    Route::post('collection/create', [
        'uses' => 'CollectionController@postCreate',
        'as' => 'admin.collection.create'
    ]);

    Route::get('collection/update/{id?}', [
        'uses' => 'CollectionController@getUpdate',
        'as' => 'admin.collection.update'
    ]);

    Route::get('collection/delete/{id?}', [
        'uses' => 'CollectionController@getDelete',
        'as' => 'admin.collection.delete'
    ]);

	/* end collection */

	/* Start Dictionary Routes */
    Route::get('dictionary', [
        'uses' => 'AdminDictionaryController@getIndex',
        'as' => 'admin.dictionary.index'
    ]);

    Route::get('dictionary/list', [
        'uses' => 'AdminDictionaryController@getList',
        'as' => 'admin.dictionary.list'
    ]);

    Route::get('dictionary/create', [
        'uses' => 'AdminDictionaryController@getCreate',
        'as' => 'admin.dictionary.create'
    ]);

	Route::get('dictionary/calendar_word', [
        'uses' => 'AdminDictionaryController@getCalendarDictionary',
        'as' => 'admin.dictionary.calendar'
    ]);

    Route::post('dictionary/create', [
        'uses' => 'AdminDictionaryController@postCreate',
        'as' => 'admin.dictionary.create'
    ]);

	 Route::post('dictionary/create_calendar', [
        'uses' => 'AdminDictionaryController@postDictionaryCalendar',
        'as' => 'admin.dictionary.calendar.create'
    ]);

    Route::get('dictionary/update/{id?}', [
        'uses' => 'AdminDictionaryController@getUpdate',
        'as' => 'admin.dictionary.update'
    ]);

    Route::get('dictionary/delete/{id?}', [
        'uses' => 'AdminDictionaryController@getDelete',
        'as' => 'admin.dictionary.delete'
    ]);

	 Route::get('dictionary/get-dictionary-description/{id?}', [
        'uses' => 'AdminDictionaryController@getDictionaryDescription',
        'as' => 'admin.dictionary.word.description'
    ]);


	/* Dictionary */

	/* start seo url */
    Route::get('seo_url', [
        'uses' => 'SeoController@getIndex',
        'as' => 'admin.seo_url.index'
    ]);

    Route::get('seo_url/list', [
        'uses' => 'SeoController@getList',
        'as' => 'admin.seo_url.list'
    ]);

    Route::get('seo_url/create', [
        'uses' => 'SeoController@getCreate',
        'as' => 'admin.seo_url.create'
    ]);

    Route::post('seo_url/create', [
        'uses' => 'SeoController@postCreate',
        'as' => 'admin.seo_url.create'
    ]);

    Route::get('seo_url/update/{id?}', [
        'uses' => 'SeoController@getUpdate',
        'as' => 'admin.seo_url.update'
    ]);

    Route::get('seo_url/delete/{id?}', [
        'uses' => 'SeoController@getDelete',
        'as' => 'admin.seo_url.delete'
    ]);

	/* end seo url */


	/* start classified */
    Route::get('classified', [
        'uses' => 'ClassifiedController@getIndex',
        'as' => 'admin.classified.index'
    ]);

    Route::get('classified/list', [
        'uses' => 'ClassifiedController@getList',
        'as' => 'admin.classified.list'
    ]);

    Route::get('classified/create', [
        'uses' => 'ClassifiedController@getCreate',
        'as' => 'admin.classified.create'
    ]);

    Route::post('classified/create', [
        'uses' => 'ClassifiedController@postCreate',
        'as' => 'admin.classified.create'
    ]);

    Route::get('classified/update/{id?}', [
        'uses' => 'ClassifiedController@getUpdate',
        'as' => 'admin.classified.update'
    ]);

    Route::get('classified/delete/{id?}', [
        'uses' => 'ClassifiedController@getDelete',
        'as' => 'admin.classified.delete'
    ]);

	Route::post('classified/get-user-url', [
        'uses' => 'ClassifiedController@getUserProfileUrl',
        'as' => 'admin.classified.get-user-url'
    ]);

	/* end classified */

	/* Start Blog  pedia Routes */
    Route::get('blog_pedia', [
        'uses' => 'BlogPediaController@getIndex',
        'as' => 'admin.blog_pedia.index'
    ]);

    Route::get('blog_pedia/list', [
        'uses' => 'BlogPediaController@getList',
        'as' => 'admin.blog_pedia.list'
    ]);

    Route::get('blog_pedia/create', [
        'uses' => 'BlogPediaController@getCreate',
        'as' => 'admin.blog_pedia.create'
    ]);

    Route::post('blog_pedia/create', [
        'uses' => 'BlogPediaController@postCreate',
        'as' => 'admin.blog_pedia.create'
    ]);

    Route::get('blog_pedia/update/{id?}', [
        'uses' => 'BlogPediaController@getUpdate',
        'as' => 'admin.blog_pedia.update'
    ]);

    Route::get('blog_pedia/delete/{id?}', [
        'uses' => 'BlogPediaController@getDelete',
        'as' => 'admin.blog_pedia.delete'
    ]);
	/* end blog pedia */

    /*   Columnist Blog  */

     Route::get('blog_columnists', [
        'uses' => 'BlogColumnistsController@getIndex',
        'as' => 'admin.blog_columnists.index'
    ]);
      Route::get('blog_columnists/list', [
        'uses' => 'BlogColumnistsController@getList',
        'as' => 'admin.blog_columnists.list'
    ]);

    Route::get('blog_columnists/delete/{id?}', [
        'uses' => 'BlogColumnistsController@getDelete',
        'as' => 'admin.blog_columnists.delete'
    ]);

    Route::post('blog_columnists/create', [
        'uses' => 'BlogColumnistsController@postCreate',
        'as' => 'admin.blog_columnists.create'
    ]);

     /*   Columnist Blog  */

	/* Start question Routes */
    Route::get('question', [
        'uses' => 'QuestionController@getIndex',
        'as' => 'admin.question.index'
    ]);

    Route::get('question/list', [
        'uses' => 'QuestionController@getList',
        'as' => 'admin.question.list'
    ]);

    Route::get('question/create', [
        'uses' => 'QuestionController@getCreate',
        'as' => 'admin.question.create'
    ]);

    Route::post('question/create', [
        'uses' => 'QuestionController@postCreate',
        'as' => 'admin.question.create'
    ]);

    Route::get('question/update/{id?}', [
        'uses' => 'QuestionController@getUpdate',
        'as' => 'admin.question.update'
    ]);

    Route::get('question/delete/{id?}', [
        'uses' => 'QuestionController@getDelete',
        'as' => 'admin.question.delete'
    ]);


	/* end question Routes */


    /* Start quiz question Routes */
    Route::get('quiz-question', [
        'uses' => 'QuizQuestionController@getIndex',
        'as' => 'admin.quiz.question.index'
    ]);

    Route::get('quiz-question/list', [
        'uses' => 'QuizQuestionController@getList',
        'as' => 'admin.quiz.question.list'
    ]);

    Route::get('quiz-question/create', [
        'uses' => 'QuizQuestionController@getCreate',
        'as' => 'admin.quiz.question.create'
    ]);

    Route::post('quiz-question/create', [
        'uses' => 'QuizQuestionController@postCreate',
        'as' => 'admin.quiz.question.create'
    ]);

    Route::get('quiz-question/update/{id?}', [
        'uses' => 'QuizQuestionController@getUpdate',
        'as' => 'admin.quiz.question.update'
    ]);

    Route::get('quiz-question/delete/{id?}', [
        'uses' => 'QuizQuestionController@getDelete',
        'as' => 'admin.quiz.question.delete'
    ]);


	/* end quiz question Routes */

    /* Start quiz Routes */
    Route::get('quiz', [
        'uses' => 'QuizController@getIndex',
        'as' => 'admin.quiz.index'
    ]);

    Route::get('quiz/list', [
        'uses' => 'QuizController@getList',
        'as' => 'admin.quiz.list'
    ]);

    Route::get('quiz/create', [
        'uses' => 'QuizController@getCreate',
        'as' => 'admin.quiz.create'
    ]);

    Route::post('quiz/create', [
        'uses' => 'QuizController@postCreate',
        'as' => 'admin.quiz.create'
    ]);

    Route::post('quiz/upload', [
        'uses' => 'QuizController@postUpload',
        'as' => 'admin.quiz.upload'
    ]);

    Route::get('quiz/update/{id?}', [
        'uses' => 'QuizController@getUpdate',
        'as' => 'admin.quiz.update'
    ]);

    Route::get('quiz/delete/{id?}', [
        'uses' => 'QuizController@getDelete',
        'as' => 'admin.quiz.delete'
    ]);


    /* end quiz Routes */


    /* Start Blog Routes */
    Route::get('blog', [
        'uses' => 'BlogController@getIndex',
        'as' => 'admin.blog.index'
    ]);

    Route::get('blog/list', [
        'uses' => 'BlogController@getList',
        'as' => 'admin.blog.list'
    ]);

    Route::get('blog/create', [
        'uses' => 'BlogController@getCreate',
        'as' => 'admin.blog.create'
    ]);

     Route::post('blog/upload', [
        'uses' => 'BlogController@postUpload',
        'as' => 'admin.blog.upload'
    ]);

    Route::post('blog/create', [
        'uses' => 'BlogController@postCreate',
        'as' => 'admin.blog.create'
    ]);

    Route::get('blog/update/{id?}', [
        'uses' => 'BlogController@getUpdate',
        'as' => 'admin.blog.update'
    ]);

    Route::get('blog/delete/{id?}', [
        'uses' => 'BlogController@getDelete',
        'as' => 'admin.blog.delete'
    ]);


    Route::get('interview', [
        'uses' => 'BlogController@InterviewIndex',
        'as' => 'admin.interview.index'
    ]);

    Route::get('interview/list', [
        'uses' => 'BlogController@InterviewList',
        'as' => 'admin.interview.list'
    ]);

    Route::get('interview/create', [
        'uses' => 'BlogController@InterviewCreate',
        'as' => 'admin.interview.create'
    ]);

    Route::post('interview/create', [
        'uses' => 'BlogController@InterviewpostCreate',
        'as' => 'admin.interview.create'
    ]);

    Route::get('interview/update/{id?}', [
        'uses' => 'BlogController@InterviewUpdate',
        'as' => 'admin.interview.update'
    ]);

    Route::get('interview/delete/{id?}', [
        'uses' => 'BlogController@InterviewDelete',
        'as' => 'admin.interview.delete'
    ]);
    /* End Blog Routes */

    /* Start pubs Routes */
    Route::get('pub', [
        'uses' => 'EventController@getPubIndex',
        'as' => 'admin.pub.index'
    ]);

    Route::get('pub/list', [
        'uses' => 'EventController@getPubList',
        'as' => 'admin.pub.list'
    ]);

    Route::get('pub/create', [
        'uses' => 'EventController@getPubCreate',
        'as' => 'admin.pub.create'
    ]);

    Route::post('pub/create', [
        'uses' => 'EventController@postPubCreate',
        'as' => 'admin.pub.create'
    ]);

    Route::get('pub/update/{id?}', [
        'uses' => 'EventController@getPubUpdate',
        'as' => 'admin.pub.update'
    ]);

    Route::get('pub/view/{id?}', [
        'uses' => 'EventController@getPubView',
        'as' => 'admin.pub.view'
    ]);

    Route::get('pub/delete/{id?}', [
        'uses' => 'EventController@getPubDelete',
        'as' => 'admin.pub.delete'
    ]);
    /* End Pubs Routes */

    /* Start Event Routes */
    Route::get('events', [
        'uses' => 'EventController@getIndex',
        'as' => 'admin.event.index'
    ]);

    Route::get('events/list', [
        'uses' => 'EventController@getList',
        'as' => 'admin.event.list'
    ]);

    Route::get('events/create', [
        'uses' => 'EventController@getCreate',
        'as' => 'admin.event.create'
    ]);

    Route::post('events/create', [
        'uses' => 'EventController@postCreate',
        'as' => 'admin.event.create'
    ]);

    Route::get('events/update/{id?}', [
        'uses' => 'EventController@getUpdate',
        'as' => 'admin.event.update'
    ]);

    Route::get('events/view/{id?}', [
        'uses' => 'EventController@getView',
        'as' => 'admin.event.update'
    ]);

    Route::get('events/delete/{id?}', [
        'uses' => 'EventController@getDelete',
        'as' => 'admin.event.delete'
    ]);
    /* End Event Routes */


    /* Start Event 2022 Routes */
    Route::get('eventyear', [
        'uses' => 'EventYearController@getIndex',
        'as' => 'admin.eventyear.index'
    ]);

    Route::get('eventyear/list', [
        'uses' => 'EventYearController@getList',
        'as' => 'admin.eventyear.list'
    ]);

    Route::get('eventyear/create', [
        'uses' => 'EventYearController@getCreate',
        'as' => 'admin.eventyear.create'
    ]);

    Route::post('eventyear/create', [
        'uses' => 'EventYearController@postCreate',
        'as' => 'admin.eventyear.create'
    ]);

    Route::get('eventyear/update/{id?}', [
        'uses' => 'EventYearController@getUpdate',
        'as' => 'admin.eventyear.update'
    ]);

    Route::get('eventyear/view/{id?}', [
        'uses' => 'EventYearController@getView',
        'as' => 'admin.eventyear.update'
    ]);

    Route::get('eventyear/delete/{id?}', [
        'uses' => 'EventYearController@getDelete',
        'as' => 'admin.eventyear.delete'
    ]);
    /* End Event 2022 Routes */



    /* Start Event Profile Header Routes */
    Route::get('profileheader', [
        'uses' => 'ProfileHeaderController@getIndex',
        'as' => 'admin.profileheader.index'
    ]);

    Route::get('profileheader/list', [
        'uses' => 'ProfileHeaderController@getList',
        'as' => 'admin.profileheader.list'
    ]);

    Route::get('profileheader/create', [
        'uses' => 'ProfileHeaderController@getCreate',
        'as' => 'admin.profileheader.create'
    ]);

    Route::post('profileheader/create', [
        'uses' => 'ProfileHeaderController@postCreate',
        'as' => 'admin.profileheader.create'
    ]);

    Route::get('profileheader/update/{id?}', [
        'uses' => 'ProfileHeaderController@getUpdate',
        'as' => 'admin.profileheader.update'
    ]);

    Route::get('profileheader/view/{id?}', [
        'uses' => 'ProfileHeaderController@getView',
        'as' => 'admin.profileheader.update'
    ]);

    Route::get('profileheader/delete/{id?}', [
        'uses' => 'ProfileHeaderController@getDelete',
        'as' => 'admin.profileheader.delete'
    ]);
    /* End Event Profile header Routes */


    /* Start Event Description Header Routes */
    Route::get('descriptionheader', [
        'uses' => 'DescriptionHeaderController@getIndex',
        'as' => 'admin.descriptionheader.index'
    ]);

    Route::get('descriptionheader/list', [
        'uses' => 'DescriptionHeaderController@getList',
        'as' => 'admin.descriptionheader.list'
    ]);

    Route::get('descriptionheader/create', [
        'uses' => 'DescriptionHeaderController@getCreate',
        'as' => 'admin.descriptionheader.create'
    ]);

    Route::post('descriptionheader/create', [
        'uses' => 'DescriptionHeaderController@postCreate',
        'as' => 'admin.descriptionheader.create'
    ]);

    Route::get('descriptionheader/update/{id?}', [
        'uses' => 'DescriptionHeaderController@getUpdate',
        'as' => 'admin.descriptionheader.update'
    ]);

    Route::get('descriptionheader/view/{id?}', [
        'uses' => 'DescriptionHeaderController@getView',
        'as' => 'admin.descriptionheader.update'
    ]);

    Route::get('descriptionheader/delete/{id?}', [
        'uses' => 'DescriptionHeaderController@getDelete',
        'as' => 'admin.descriptionheader.delete'
    ]);
    /* End Event Profile header Routes */


    /* Start Event Header Routes */
    Route::get('eventheader', [
        'uses' => 'EventHeaderController@getIndex',
        'as' => 'admin.eventheader.index'
    ]);

    Route::get('eventheader/list', [
        'uses' => 'EventHeaderController@getList',
        'as' => 'admin.eventheader.list'
    ]);

    Route::get('eventheader/create', [
        'uses' => 'EventHeaderController@getCreate',
        'as' => 'admin.eventheader.create'
    ]);

    Route::post('eventheader/create', [
        'uses' => 'EventHeaderController@postCreate',
        'as' => 'admin.eventheader.create'
    ]);

    Route::get('eventheader/update/{id?}', [
        'uses' => 'EventHeaderController@getUpdate',
        'as' => 'admin.eventheader.update'
    ]);

    Route::get('eventheader/view/{id?}', [
        'uses' => 'EventHeaderController@getView',
        'as' => 'admin.eventheader.update'
    ]);

    Route::get('eventheader/delete/{id?}', [
        'uses' => 'EventHeaderController@getDelete',
        'as' => 'admin.eventheader.delete'
    ]);
    /* End Event Header Routes */


    /* Start Section Three Routes */
    Route::get('sectionthree', [
        'uses' => 'SectionthreeController@getIndex',
        'as' => 'admin.sectionthree.index'
    ]);

    Route::get('sectionthree/list', [
        'uses' => 'SectionthreeController@getList',
        'as' => 'admin.sectionthree.list'
    ]);

    Route::get('sectionthree/create', [
        'uses' => 'SectionthreeController@getCreate',
        'as' => 'admin.sectionthree.create'
    ]);

    Route::post('sectionthree/create', [
        'uses' => 'SectionthreeController@postCreate',
        'as' => 'admin.sectionthree.create'
    ]);

    Route::get('sectionthree/update/{id?}', [
        'uses' => 'SectionthreeController@getUpdate',
        'as' => 'admin.sectionthree.update'
    ]);

    Route::get('sectionthree/view/{id?}', [
        'uses' => 'SectionthreeController@getView',
        'as' => 'admin.sectionthree.update'
    ]);

    Route::get('sectionthree/delete/{id?}', [
        'uses' => 'SectionthreeController@getDelete',
        'as' => 'admin.sectionthree.delete'
    ]);
    /* End Section Three Header Routes */



    /* Start Section Three Routes */
    Route::get('sectionprofile', [
        'uses' => 'SectionprofileController@getIndex',
        'as' => 'admin.sectionprofile.index'
    ]);

    Route::get('sectionprofile/list', [
        'uses' => 'SectionprofileController@getList',
        'as' => 'admin.sectionprofile.list'
    ]);

    Route::get('sectionprofile/create', [
        'uses' => 'SectionprofileController@getCreate',
        'as' => 'admin.sectionprofile.create'
    ]);

    Route::post('sectionprofile/create', [
        'uses' => 'SectionprofileController@postCreate',
        'as' => 'admin.sectionprofile.create'
    ]);

    Route::get('sectionprofile/update/{id?}', [
        'uses' => 'SectionprofileController@getUpdate',
        'as' => 'admin.sectionprofile.update'
    ]);

    Route::get('sectionprofile/view/{id?}', [
        'uses' => 'SectionprofileController@getView',
        'as' => 'admin.sectionprofile.update'
    ]);

    Route::get('sectionprofile/delete/{id?}', [
        'uses' => 'SectionprofileController@getDelete',
        'as' => 'admin.sectionprofile.delete'
    ]);
    /* End Section Three Header Routes */


    /* Start Event Description Routes */
    Route::get('eventdescription', [
        'uses' => 'EventDescriptionController@getIndex',
        'as' => 'admin.eventdescription.index'
    ]);

    Route::get('eventdescription/list', [
        'uses' => 'EventDescriptionController@getList',
        'as' => 'admin.eventdescription.list'
    ]);

    Route::get('eventdescription/create', [
        'uses' => 'EventDescriptionController@getCreate',
        'as' => 'admin.eventdescription.create'
    ]);

    Route::post('eventdescription/create', [
        'uses' => 'EventDescriptionController@postCreate',
        'as' => 'admin.eventdescription.create'
    ]);

    Route::get('eventdescription/update/{id?}', [
        'uses' => 'EventDescriptionController@getUpdate',
        'as' => 'admin.eventdescription.update'
    ]);

    Route::get('eventdescription/view/{id?}', [
        'uses' => 'EventDescriptionController@getView',
        'as' => 'admin.eventdescription.update'
    ]);

    Route::get('eventdescription/delete/{id?}', [
        'uses' => 'EventDescriptionController@getDelete',
        'as' => 'admin.eventdescription.delete'
    ]);
    /* End Event Description Routes */


    /* Start Event Banner Routes */
    Route::get('eventbanner', [
        'uses' => 'EventBannerController@getIndex',
        'as' => 'admin.eventbanner.index'
    ]);

    Route::get('eventbanner/list', [
        'uses' => 'EventBannerController@getList',
        'as' => 'admin.eventbanner.list'
    ]);

    Route::get('eventbanner/create', [
        'uses' => 'EventBannerController@getCreate',
        'as' => 'admin.eventbanner.create'
    ]);

    Route::post('eventbanner/create', [
        'uses' => 'EventBannerController@postCreate',
        'as' => 'admin.eventbanner.create'
    ]);

    Route::get('eventbanner/update/{id?}', [
        'uses' => 'EventBannerController@getUpdate',
        'as' => 'admin.eventbanner.update'
    ]);

    Route::get('eventbanner/view/{id?}', [
        'uses' => 'EventBannerController@getView',
        'as' => 'admin.eventbanner.update'
    ]);

    Route::get('eventbanner/delete/{id?}', [
        'uses' => 'EventBannerController@getDelete',
        'as' => 'admin.eventbanner.delete'
    ]);
    /* End Event Banner Routes */

    /* Start Award Routes */
    Route::get('award/{event_id?}', [
        'uses' => 'AwardController@getIndex',
        'as' => 'admin.event.award.index'
    ]);

    Route::get('award/list/{event_id?}', [
        'uses' => 'AwardController@getList',
        'as' => 'admin.event.award.list'
    ]);

    Route::get('award/create/{event_id?}', [
        'uses' => 'AwardController@getCreate',
        'as' => 'admin.event.award.create'
    ]);

    Route::post('award/create', [
        'uses' => 'AwardController@postCreate',
        'as' => 'admin.event.award.create'
    ]);

    Route::get('award/update/{id?}', [
        'uses' => 'AwardController@getUpdate',
        'as' => 'admin.event.award.update'
    ]);

    Route::get('award/delete/{id?}', [
        'uses' => 'AwardController@getDelete',
        'as' => 'admin.event.award.delete'
    ]);

	Route::post('/user/award/admin-nominee-data', [
        'uses' => 'AwardController@getNominee',
        'as' => 'admin.user.award.nominee.list'
    ]);
    /* End Award Routes */

    /* Start Polls Routes */
    Route::get('polls', [
        'uses' => 'PollsController@getIndex',
        'as' => 'admin.polls.index'
    ]);

    Route::get('polls/list', [
        'uses' => 'PollsController@getList',
        'as' => 'admin.polls.list'
    ]);

    Route::get('polls/create', [
        'uses' => 'PollsController@getCreate',
        'as' => 'admin.polls.create'
    ]);

    Route::post('polls/create', [
        'uses' => 'PollsController@postCreate',
        'as' => 'admin.polls.create'
    ]);

    Route::get('polls/update/{id?}', [
        'uses' => 'PollsController@getUpdate',
        'as' => 'admin.polls.update'
    ]);

    Route::get('polls/delete/{id?}', [
        'uses' => 'PollsController@getDelete',
        'as' => 'admin.polls.delete'
    ]);

    Route::get('polls/search', [
        'uses' => 'PollsController@getDataOnBasisOfType',
        'as' => 'admin.polls.search'
    ]);

    Route::get('polls/stats/{id?}', [
        'uses' => 'PollsController@getStats',
        'as' => 'admin.polls.stats'
    ]);
    /* End Polls Routes */

    /* Start News Routes */
    Route::get('news', [
        'uses' => 'NewsController@getIndex',
        'as' => 'admin.news.index'
    ]);

    Route::get('news/list', [
        'uses' => 'NewsController@getList',
        'as' => 'admin.news.list'
    ]);

    Route::get('news/create', [
        'uses' => 'NewsController@getCreate',
        'as' => 'admin.news.create'
    ]);

    Route::post('news/create', [
        'uses' => 'NewsController@postCreate',
        'as' => 'admin.news.create'
    ]);

    Route::get('news/update/{id?}', [
        'uses' => 'NewsController@getUpdate',
        'as' => 'admin.news.update'
    ]);

    Route::get('news/delete/{id?}', [
        'uses' => 'NewsController@getDelete',
        'as' => 'admin.news.delete'
    ]);

    Route::get('did-you-know', [
        'uses' => 'NewsController@DidYouKnow_Index',
        'as' => 'admin.did-you-know.index'
    ]);

    Route::get('did-you-know/list', [
        'uses' => 'NewsController@DidYouKnow_List',
        'as' => 'admin.did-you-know.list'
    ]);

    Route::get('did-you-know/create', [
        'uses' => 'NewsController@DidYouKnow_Create',
        'as' => 'admin.did-you-know.create'
    ]);

    Route::post('did-you-know/create', [
        'uses' => 'NewsController@DidYouKnow_postCreate',
        'as' => 'admin.did-you-know.create'
    ]);

    Route::get('did-you-know/update/{id?}', [
        'uses' => 'NewsController@DidYouKnow_Update',
        'as' => 'admin.did-you-know.update'
    ]);

    Route::get('did-you-know/delete/{id?}', [
        'uses' => 'NewsController@DidYouKnow_Delete',
        'as' => 'admin.did-you-know.delete'
    ]);
    /* End News Routes */

    /* Start News Category Routes */
    Route::get('news-category', [
        'uses' => 'NewsCategoryController@getIndex',
        'as' => 'admin.news_category.index'
    ]);

    Route::get('news-category/list', [
        'uses' => 'NewsCategoryController@getList',
        'as' => 'admin.news_category.list'
    ]);

    Route::get('news-category/create', [
        'uses' => 'NewsCategoryController@getCreate',
        'as' => 'admin.news_category.create'
    ]);

    Route::post('news-category/create', [
        'uses' => 'NewsCategoryController@postCreate',
        'as' => 'admin.news_category.create'
    ]);

    Route::get('news-category/update/{id?}', [
        'uses' => 'NewsCategoryController@getUpdate',
        'as' => 'admin.news_category.update'
    ]);

    Route::get('news-category/delete/{id?}', [
        'uses' => 'NewsCategoryController@getDelete',
        'as' => 'admin.news_category.delete'
    ]);
    /* End News Category Routes */


    /* Start Blog Category Routes */
    Route::get('blog-category', [
        'uses' => 'BlogCategoryController@getIndex',
        'as' => 'admin.blog_category.index'
    ]);

    Route::get('blog-category/list', [
        'uses' => 'BlogCategoryController@getList',
        'as' => 'admin.blog_category.list'
    ]);

    Route::get('blog-category/create', [
        'uses' => 'BlogCategoryController@getCreate',
        'as' => 'admin.blog_category.create'
    ]);

    Route::post('blog-category/create', [
        'uses' => 'BlogCategoryController@postCreate',
        'as' => 'admin.blog_category.create'
    ]);

    Route::get('blog-category/update/{id?}', [
        'uses' => 'BlogCategoryController@getUpdate',
        'as' => 'admin.blog_category.update'
    ]);

    Route::get('blog-category/delete/{id?}', [
        'uses' => 'BlogCategoryController@getDelete',
        'as' => 'admin.blog_category.delete'
    ]);
    /* End Blog Category Routes */



    /* Start Event Category Routes */
    Route::get('event-category', [
        'uses' => 'EventCategoryController@getIndex',
        'as' => 'admin.event_category.index'
    ]);

    Route::get('event-category/list', [
        'uses' => 'EventCategoryController@getList',
        'as' => 'admin.event_category.list'
    ]);

    Route::get('event-category/create', [
        'uses' => 'EventCategoryController@getCreate',
        'as' => 'admin.event_category.create'
    ]);

    Route::post('event-category/create', [
        'uses' => 'EventCategoryController@postCreate',
        'as' => 'admin.event_category.create'
    ]);

    Route::get('event-category/update/{id?}', [
        'uses' => 'EventCategoryController@getUpdate',
        'as' => 'admin.event_category.update'
    ]);

    Route::get('event-category/delete/{id?}', [
        'uses' => 'EventCategoryController@getDelete',
        'as' => 'admin.event_category.delete'
    ]);
    /* End Event Category Routes */


    /* Start Event Category Routes */
    Route::get('event-subcategory', [
        'uses' => 'EventSubCategoryController@getIndex',
        'as' => 'admin.event_subcategory.index'
    ]);

    Route::get('event-subcategory/list', [
        'uses' => 'EventSubCategoryController@getList',
        'as' => 'admin.event_subcategory.list'
    ]);

    Route::get('event-subcategory/create', [
        'uses' => 'EventSubCategoryController@getCreate',
        'as' => 'admin.event_subcategory.create'
    ]);

    Route::post('event-subcategory/create', [
        'uses' => 'EventSubCategoryController@postCreate',
        'as' => 'admin.event_subcategory.create'
    ]);

    Route::get('event-subcategory/update/{id?}', [
        'uses' => 'EventSubCategoryController@getUpdate',
        'as' => 'admin.event_subcategory.update'
    ]);

    Route::get('event-subcategory/delete/{id?}', [
        'uses' => 'EventSubCategoryController@getDelete',
        'as' => 'admin.event_subcategory.delete'
    ]);
    /* End Event Category Routes */

    /* Start Home Page CMS Routes */
    Route::get('cms/home-page', [
        'uses' => 'HomePageController@getIndex',
        'as'   => 'admin.cms.home_page.index'
    ]);

    Route::get('cms/home-page/list', [
        'uses' => 'HomePageController@getList',
        'as'   => 'admin.cms.home_page.list'
    ]);

    Route::get('cms/home-page/update/{id?}', [
        'uses' => 'HomePageController@getUpdate',
        'as' => 'admin.cms.home_page.update'
    ]);

    Route::post('cms/home-page/update/{id?}', [
        'uses' => 'HomePageController@postUpdate',
        'as' => 'admin.cms.home_page.update'
    ]);

	Route::post('cms/home-page/save-order', [
        'uses' => 'HomePageController@saveOrder',
        'as' => 'admin.cms.home_page.save_order'
    ]);

    Route::get('cms/home-page/search', [
        'uses' => 'HomePageController@getDataOnBasisOfType',
        'as' => 'admin.cms.home_page.search'
    ]);
    /* End Home Page Routes */

	/* Home Happy Whatever day */
	Route::get('cms/home-page-whateverdays', [
        'uses' => 'HomePageController@getHappyWhateverDayIndex',
        'as'   => 'admin.cms.happy_whatever_day.index'
    ]);

	Route::get('cms/home-page-whateverdays/list', [
        'uses' => 'HomePageController@getHappyWhateverDayList',
        'as'   => 'admin.cms.happy_whatever_day.list'
    ]);

	Route::post('cms/home-page-whateverday/update/{id?}', [
        'uses' => 'HomePageController@postHappyWhateverDayUpdate',
        'as' => 'admin.cms.happy_whatever_day.update'
    ]);

	Route::get('cms/home-page-whateverday/update/{id?}', [
        'uses' => 'HomePageController@getHappyWhateverDayUpdate',
        'as' => 'admin.cms.happy_whatever_day.update'
    ]);

	Route::get('cms/home-page-whateverday/create', [
        'uses' => 'HomePageController@getHappyWhateverDayCreate',
        'as' => 'admin.cms.happy_whatever_day.create'
    ]);

	Route::get('cms/home-page-whateverday/delete/{id?}', [
        'uses' => 'HomePageController@getHappyWhateverDayDelete',
        'as' => 'admin.cms.happy_whatever_day.delete'
    ]);
	/* */

    /* Home Award List */

    Route::get('cms/home-award', [
        'uses' => 'HomePageController@getHomeAwardIndex',
        'as'   => 'admin.cms.home-award.index'
    ]);

    Route::get('cms/award_list', [
        'uses' => 'HomePageController@getAwardList',
        'as' => 'admin.cms.home_page_award_list'
    ]);

    Route::get('cms/home-award/create', [
        'uses' => 'HomePageController@getHomeAwradCreate',
        'as' => 'admin.cms.home-award.create'
    ]);

    Route::post('cms/home-award/update/{id?}', [
        'uses' => 'HomePageController@postHomeAwardUpdate',
        'as' => 'admin.cms.home-award.update'
    ]);

    Route::get('cms/home-award/delete/{id?}', [
        'uses' => 'HomePageController@getHomeAwardDelete',
        'as' => 'admin.cms.home-award.delete'
    ]);

    Route::get('cms/home-award/update/{id?}', [
        'uses' => 'HomePageController@getHomeAwardUpdate',
        'as' => 'admin.cms.home-award.update'
    ]);
    /* */
    /* Home Award List */
    Route::get('cms/home-award_type', [
        'uses' => 'HomePageController@getHomeAwardTypeIndex',
        'as'   => 'admin.cms.home-award_type.index'
    ]);

     Route::get('cms/award_type_list', [
        'uses' => 'HomePageController@getAwardTypeList',
        'as' => 'admin.cms.home_page_award_type_list'
    ]);
     Route::get('cms/home-award_type/delete/{id?}', [
        'uses' => 'HomePageController@getHomeAwardTypeDelete',
        'as' => 'admin.cms.home-award_type.delete'
    ]);
     Route::get('cms/home-award-type/create', [
        'uses' => 'HomePageController@getHomeAwradTypeCreate',
        'as' => 'admin.cms.home-award-type.create'
    ]);
    Route::get('cms/home-award_type/update/{id?}', [
        'uses' => 'HomePageController@getHomeAwardTypeUpdate',
        'as' => 'admin.cms.home-award_type.update'
    ]);

     Route::post('cms/home-award_type/update/{id?}', [
        'uses' => 'HomePageController@postHomeAwardTypeUpdate',
        'as' => 'admin.cms.home-award_type.update'
    ]);
    /* */

    /* Start Main List Page CMS Routes */

	Route::get('cms/main-list-page-paragraphs', [
        'uses' => 'MainListPageController@getMainListParagraphIndex',
        'as'   => 'admin.cms.main_list_paragraph.index'
    ]);

	Route::get('cms/main-list-page-paragraphs/list', [
        'uses' => 'MainListPageController@getMainListParagraphList',
        'as'   => 'admin.cms.main_list_paragraph.list'
    ]);

	Route::post('cms/main-list-page-paragraph/update/{id?}', [
        'uses' => 'MainListPageController@postMainListParagraphUpdate',
        'as' => 'admin.cms.main_list_paragraph.update'
    ]);

	Route::get('cms/main-list-page-paragraph/update/{id?}', [
        'uses' => 'MainListPageController@getMainListParagraphUpdate',
        'as' => 'admin.cms.main_list_paragraph.update'
    ]);


	Route::get('cms/main-list-page', [
        'uses' => 'MainListPageController@getIndex',
        'as'   => 'admin.cms.main_list_page.index'
    ]);

    Route::get('cms/main-list-page/list', [
        'uses' => 'MainListPageController@getList',
        'as'   => 'admin.cms.main_list_page.list'
    ]);

    Route::get('cms/main-list-page/update/{id?}', [
        'uses' => 'MainListPageController@getUpdate',
        'as' => 'admin.cms.main_list_page.update'
    ]);

    Route::post('cms/main-list-page/update/{id?}', [
        'uses' => 'MainListPageController@postUpdate',
        'as' => 'admin.cms.main_list_page.update'
    ]);

    Route::get('cms/main-list-page/search', [
        'uses' => 'MainListPageController@getDataOnBasisOfType',
        'as' => 'admin.cms.main_list_page.search'
    ]);

	Route::post('cms/main-list-page/get-items-bycategory/{id?}', [
        'uses' => 'MainListPageController@getItemsByCategory',
        'as' => 'admin.mainlist.get-category-items'
    ]);
    /* End Main List Page Routes */

    /* Start Sidbar List Page CMS Routes */
    Route::get('cms/sidebar-page', [
        'uses' => 'MainListPageController@sidebar_page_Index',
        'as'   => 'admin.cms.sidebar_page.index'
    ]);

    Route::get('cms/sidebar-page/list', [
        'uses' => 'MainListPageController@sidebar_page_getList',
        'as'   => 'admin.cms.sidebar_page.list'
    ]);

    Route::get('cms/sidebar-page/update/{id?}', [
        'uses' => 'MainListPageController@sidebar_page_getUpdate',
        'as' => 'admin.cms.sidebar_page.update'
    ]);

    Route::post('cms/sidebar-page/update/{id?}', [
        'uses' => 'MainListPageController@sidebar_page_postUpdate',
        'as' => 'admin.cms.sidebar_page.update'
    ]);
    Route::get('cms/sidebar-page/search', [
        'uses' => 'MainListPageController@getDataOnBasisOfType_sidebar',
        'as' => 'admin.cms.sidebar.search'
    ]);
    /* End Sidebar List Page Routes */

    /* Start App Settings Routes */
    Route::get('settings', [
        'uses' => 'SettingController@getIndex',
        'as'   => 'admin.settings.index'
    ]);

    Route::get('settings/list', [
        'uses' => 'SettingController@getList',
        'as'   => 'admin.settings.list'
    ]);

    Route::get('settings/update/{id?}', [
        'uses' => 'SettingController@getUpdate',
        'as' => 'admin.settings.update'
    ]);

    Route::post('settings/update/{id?}', [
        'uses' => 'SettingController@postUpdate',
        'as' => 'admin.settings.update'
    ]);
    /* End App Settings Routes */

    /* Start Pub heading Routes */
    Route::get('pub_heading', [
        'uses' => 'PubHeadingController@getIndex',
        'as'   => 'admin.pub_heading.index'
    ]);

    Route::get('pub_heading/list', [
        'uses' => 'PubHeadingController@getList',
        'as'   => 'admin.pub_heading.list'
    ]);

    /******** || Shubham Code Start ||  ********/
    Route::get('/feeds_reports', [
        'uses' => 'FeedReportsController@getIndex',
        'as'   => 'admin.feeds_reports.index'
    ]);

    Route::get('feed_reports/list', [
        'uses' => 'FeedReportsController@getList',
        'as'   => 'admin.feed_reports.list'
    ]);

    Route::get('feed_reports/report_view', [
        'uses' => 'FeedReportsController@getReportView',
        'as'   => 'admin.feed_reports.report_view'
    ]);

    Route::get('feed_reports/delete_report_feed', [
        'uses' => 'FeedReportsController@deleteReportFeed',
        'as'   => 'admin.feed_reports.delete_report_feed'
    ]);

    Route::get('/expiring_customers', [
        'uses' => 'ExpiringCustomersController@getIndex',
        'as'   => 'admin.expiring_customers.index'
    ]);

    Route::get('expiring_customers/list', [
        'uses' => 'ExpiringCustomersController@getList',
        'as'   => 'admin.expiring_customers.list'
    ]);

    Route::get('/feeds_ad', [
        'uses' => 'FeedsAdController@getIndex',
        'as'   => 'admin.feeds_ad.index'
    ]);

    Route::post('/uploadAdImage', [
        'uses' => 'FeedsAdController@uploadAdImage',
        'as'   => 'admin.FeedsAdController.uploadAdImage'
    ]);

    Route::post('/deleteAdImage', [
        'uses' => 'FeedsAdController@deleteAdImage',
        'as'   => 'admin.FeedsAdController.deleteAdImage'
    ]);

    /******** || Shubham Code End ||  ********/
    Route::get('pub_heading/update/{id?}', [
        'uses' => 'PubHeadingController@getUpdate',
        'as' => 'admin.pub_heading.update'
    ]);

    Route::post('pub_heading/update/{id?}', [
        'uses' => 'PubHeadingController@postUpdate',
        'as' => 'admin.pub_heading.update'
    ]);
    /* End Pub heading Routes */

    /* End Pub heading Routes */
    Route::get('/pub_meeting', [
        'uses' => 'PubHeadingController@getPubMeetingIndex',
        'as'   => 'admin.pub_heading.pub_meeting'
    ]);

    Route::get('/pub_meeting_list', [
        'uses' => 'PubHeadingController@getMeetingList',
        'as'   => 'admin.pub_heading.pub_meeting_list'
    ]);

    Route::get('/create_meeting', [
        'uses' => 'PubHeadingController@getCreateMeeting',
        'as'   => 'admin.pub_heading.create_meeting'
    ]);

    Route::get('/update_meeting/{id?}', [
        'uses' => 'PubHeadingController@getUpdateMeeting',
        'as'   => 'admin.pub_heading.update_meeting'
    ]);

    Route::post('/save_meeting', [
        'uses' => 'PubHeadingController@postSaveMeeting',
        'as'   => 'admin.pub_heading.save_meeting'
    ]);

    Route::get('/deletePubMeetingRoom', [
        'uses' => 'PubHeadingController@deletePubMeetingRoom',
        'as'   => 'admin.pub_heading.deletePubMeetingRoom'
    ]);
    /* End Pub heading Routes */



     /* Feed Preference  */
    Route::get('feed_preference/iama', [
        'uses' => 'FeedPreferenceController@getIndexiama',
        'as'   => 'admin.feed_preference.iama.index'
    ]);

    Route::get('feed_preference/i_am_a_list', [
        'uses' => 'FeedPreferenceController@getList',
        'as' => 'admin.feed_preference.i_am_a.list'
    ]);

    Route::get('feed_preference/iama/delete/{id?}', [
        'uses' => 'FeedPreferenceController@getIamaDelete',
        'as' => 'aadmin.feed_preference.iama.delete'
    ]);

    Route::get('feed_preference/iama/create', [
        'uses' => 'FeedPreferenceController@getIamaCreate',
        'as' => 'admin.feed_preference.iama.create'
    ]);

   Route::Post('feed_preference/iama/create', [
        'uses' => 'FeedPreferenceController@postIamaCreate',
        'as' => 'admin.feed_preference.iama.create'
    ]);
    Route::get('feed_preference/iama/update/{id?}', [
        'uses' => 'FeedPreferenceController@getIamaUpdate',
        'as' => 'admin.feed_preference.iama.update'
    ]);



    Route::get('feed_preference/ilove', [
        'uses' => 'FeedPreferenceController@getIndexilove',
        'as'   => 'admin.feed_preference.ilove.index'
    ]);

    Route::get('feed_preference/ilove/list', [
        'uses' => 'FeedPreferenceController@getIloveList',
        'as' => 'admin.feed_preference.ilove.list'
    ]);

     Route::get('feed_preference/ilove/create', [
        'uses' => 'FeedPreferenceController@getIloveCreate',
        'as' => 'admin.feed_preference.ilove.create'
    ]);

      Route::get('/feed_preference/get_category_BYGroup', [
        'uses' => 'ProductController@get_category_BYGroup',
        'as' => 'admin.feed_preference.ilove.get_category_BYGroup'
    ]);

    Route::Post('feed_preference/ilove/create', [
        'uses' => 'FeedPreferenceController@postIloveCreate',
        'as' => 'admin.feed_preference.ilove.create'
    ]);

    Route::get('feed_preference/ilove/update/{id?}', [
        'uses' => 'FeedPreferenceController@getIloveUpdate',
        'as' => 'admin.feed_preference.ilove.update'
    ]);

    Route::get('feed_preference/ilove/delete/{id?}', [
        'uses' => 'FeedPreferenceController@getIamaDelete',
        'as' => 'aadmin.feed_preference.ilove.delete'
    ]);
    /* */

    /****** Wiki ******/
    /****** Wiki Category  ******/
    Route::get('wiki/category', [
        'uses' => 'WikiCategoryController@getIndex',
        'as'   => 'admin.wiki.category.index'
    ]);

    Route::get('wiki/category/list', [
        'uses' => 'WikiCategoryController@getList',
        'as' => 'admin.wiki.category.list'
    ]);

    Route::get('wiki/category/create', [
        'uses' => 'WikiCategoryController@getCreate',
        'as' => 'admin.wiki.category.create'
    ]);

    Route::Post('wiki/category/create', [
        'uses' => 'WikiCategoryController@postCreate',
        'as' => 'admin.wiki.category.create'
    ]);

     Route::get('wiki/category/update/{id?}', [
        'uses' => 'WikiCategoryController@getUpdate',
        'as' => 'admin.wiki.category.update'
    ]);

    Route::get('wiki/category/delete/{id?}', [
        'uses' => 'WikiCategoryController@getDelete',
        'as' => 'admin.wiki.category.delete'
    ]);
    /****** Wiki Category******/

    Route::get('wiki', [
        'uses' => 'WikiController@getIndex',
        'as'   => 'admin.wiki.index'
    ]);

    Route::get('wiki/list', [
        'uses' => 'WikiController@getList',
        'as' => 'admin.wiki.list'
    ]);

    Route::get('wiki/create', [
        'uses' => 'WikiController@getCreate',
        'as' => 'admin.wiki.create'
    ]);

    Route::Post('wiki/create', [
        'uses' => 'WikiController@postCreate',
        'as' => 'admin.wiki.create'
    ]);

    Route::get('wiki/update/{id?}', [
        'uses' => 'WikiController@getUpdate',
        'as' => 'admin.wiki.update'
    ]);

    Route::get('wiki/delete/{id?}', [
        'uses' => 'WikiController@getDelete',
        'as' => 'admin.wiki.delete'
    ]);

    Route::get('wiki/view/{id?}', [
        'uses' => 'WikiController@getView',
        'as' => 'admin.wiki.view'
    ]);
    /****** Wiki   ******/


    /****** Rest In PLay ******/
    /****** RIP Category  ******/
    Route::get('rest-in-play/category', [
        'uses' => 'RipCategoryController@getIndex',
        'as'   => 'admin.rest-in-play.category.index'
    ]);

    Route::get('rest-in-play/category/list', [
        'uses' => 'RipCategoryController@getList',
        'as' => 'admin.rest-in-play.category.list'
    ]);

    Route::get('rest-in-play/category/create', [
        'uses' => 'RipCategoryController@getCreate',
        'as' => 'admin.rest-in-play.category.create'
    ]);

    Route::Post('rest-in-play/category/create', [
        'uses' => 'RipCategoryController@postCreate',
        'as' => 'admin.rest-in-play.category.create'
    ]);

     Route::get('rest-in-play/category/update/{id?}', [
        'uses' => 'RipCategoryController@getUpdate',
        'as' => 'admin.rest-in-play.category.update'
    ]);

    Route::get('rest-in-play/category/delete/{id?}', [
        'uses' => 'RipCategoryController@getDelete',
        'as' => 'admin.rest-in-play.category.delete'
    ]);
    /****** RIP Category******/

    Route::get('rest-in-play', [
        'uses' => 'RipController@getIndex',
        'as'   => 'admin.rest-in-play.index'
    ]);

    Route::get('rest-in-play/list', [
        'uses' => 'RipController@getList',
        'as' => 'admin.rest-in-play.list'
    ]);

    Route::get('rest-in-play/create', [
        'uses' => 'RipController@getCreate',
        'as' => 'admin.rest-in-play.create'
    ]);

    Route::Post('rest-in-play/create', [
        'uses' => 'RipController@postCreate',
        'as' => 'admin.rest-in-play.create'
    ]);

    Route::get('rest-in-play/update/{id?}', [
        'uses' => 'RipController@getUpdate',
        'as' => 'admin.rest-in-play.update'
    ]);

    Route::get('rest-in-play/delete/{id?}', [
        'uses' => 'RipController@getDelete',
        'as' => 'admin.rest-in-play.delete'
    ]);

    Route::get('rest-in-play/view/{id?}', [
        'uses' => 'RipController@getView',
        'as' => 'admin.rest-in-play.view'
    ]);
    /****** Rest In Play   ******/


   /****** || Youtube Premieres || ******/
    Route::get('youtube-premieres', [
        'uses' => 'YoutubePremieresController@getIndex',
        'as'   => 'admin.youtube-premieres.index'
    ]);

    Route::get('youtube-premieres/list', [
        'uses' => 'YoutubePremieresController@getList',
        'as' => 'admin.youtube-premieres.list'
    ]);

    Route::get('youtube-premieres/create', [
        'uses' => 'YoutubePremieresController@getCreate',
        'as' => 'admin.youtube-premieres.create'
    ]);

    Route::Post('youtube-premieres/create', [
        'uses' => 'YoutubePremieresController@postCreate',
        'as' => 'admin.youtube-premieres.create'
    ]);

     Route::get('youtube-premieres/update/{id?}', [
        'uses' => 'YoutubePremieresController@getUpdate',
        'as' => 'admin.youtube-premieres.update'
    ]);

    Route::get('youtube-premieres/delete/{id?}', [
        'uses' => 'YoutubePremieresController@getDelete',
        'as' => 'admin.youtube-premieres.delete'
    ]);

    Route::get('youtube-premieres/view/{id?}', [
        'uses' => 'YoutubePremieresController@getView',
        'as' => 'admin.youtube-premieres.view'
    ]);
    /****** || Youtube Premieres || ******/

    /****** || Master Login || ******/
    Route::get('/mester-login/{id}', [
        'uses' => 'LoginController@postMesterLogin',
        'as' => 'admin.mester_login.{id}'
    ]);
     /****** || Master Login || ******/



    /****** POP Entertainment ******/
    /******POP Entertainment Category  ******/
    Route::get('entertainment/category', [
        'uses' => 'EntertainmentCategoryController@getIndex',
        'as'   => 'admin.entertainment.category.index'
    ]);

    Route::get('entertainment/category/list', [
        'uses' => 'EntertainmentCategoryController@getList',
        'as' => 'admin.entertainment.category.list'
    ]);

    Route::get('entertainment/category/create', [
        'uses' => 'EntertainmentCategoryController@getCreate',
        'as' => 'admin.entertainment.category.create'
    ]);

    Route::Post('entertainment/category/create', [
        'uses' => 'EntertainmentCategoryController@postCreate',
        'as' => 'admin.entertainment.category.create'
    ]);

     Route::get('entertainment/category/update/{id?}', [
        'uses' => 'EntertainmentCategoryController@getUpdate',
        'as' => 'admin.entertainment.category.update'
    ]);

    Route::get('entertainment/category/delete/{id?}', [
        'uses' => 'EntertainmentCategoryController@getDelete',
        'as' => 'admin.entertainment.category.delete'
    ]);
    /****** POP Entertainment Category******/

    Route::get('entertainment', [
        'uses' => 'EntertainmentController@getIndex',
        'as'   => 'admin.entertainment.index'
    ]);

    Route::get('entertainment/list', [
        'uses' => 'EntertainmentController@getList',
        'as' => 'admin.entertainment.list'
    ]);

    Route::get('entertainment/create', [
        'uses' => 'EntertainmentController@getCreate',
        'as' => 'admin.entertainment.create'
    ]);

    Route::Post('entertainment/create', [
        'uses' => 'EntertainmentController@postCreate',
        'as' => 'admin.entertainment.create'
    ]);

    Route::get('entertainment/update/{id?}', [
        'uses' => 'EntertainmentController@getUpdate',
        'as' => 'admin.entertainment.update'
    ]);

    Route::get('entertainment/delete/{id?}', [
        'uses' => 'EntertainmentController@getDelete',
        'as' => 'admin.entertainment.delete'
    ]);

    Route::get('entertainment/view/{id?}', [
        'uses' => 'EntertainmentController@getView',
        'as' => 'admin.entertainment.view'
    ]);
    /****** POP Entertainment   ******/

    /****** POP CAST ******/
    /******POP CAST Category  ******/
    Route::get('cast/category', [
        'uses' => 'CastCategoryController@getIndex',
        'as'   => 'admin.cast.category.index'
    ]);

    Route::get('cast/category/list', [
        'uses' => 'CastCategoryController@getList',
        'as' => 'admin.cast.category.list'
    ]);

    Route::get('cast/category/create', [
        'uses' => 'CastCategoryController@getCreate',
        'as' => 'admin.cast.category.create'
    ]);

    Route::Post('cast/category/create', [
        'uses' => 'CastCategoryController@postCreate',
        'as' => 'admin.cast.category.create'
    ]);

     Route::get('cast/category/update/{id?}', [
        'uses' => 'CastCategoryController@getUpdate',
        'as' => 'admin.cast.category.update'
    ]);

    Route::get('cast/category/delete/{id?}', [
        'uses' => 'CastCategoryController@getDelete',
        'as' => 'admin.cast.category.delete'
    ]);
    /****** POP CAST Category******/

    Route::get('cast', [
        'uses' => 'CastController@getIndex',
        'as'   => 'admin.cast.index'
    ]);

    Route::get('cast/list', [
        'uses' => 'CastController@getList',
        'as' => 'admin.cast.list'
    ]);

    Route::get('cast/create', [
        'uses' => 'CastController@getCreate',
        'as' => 'admin.cast.create'
    ]);

    Route::Post('cast/create', [
        'uses' => 'CastController@postCreate',
        'as' => 'admin.cast.create'
    ]);

    Route::get('cast/update/{id?}', [
        'uses' => 'CastController@getUpdate',
        'as' => 'admin.cast.update'
    ]);

    Route::get('cast/delete/{id?}', [
        'uses' => 'CastController@getDelete',
        'as' => 'admin.cast.delete'
    ]);

    Route::get('cast/view/{id?}', [
        'uses' => 'CastController@getView',
        'as' => 'admin.cast.view'
    ]);
    /****** POP CAST   ******/


   /****** POP CAST ******/
    Route::get('office-hour', [
        'uses' => 'OfficeHourController@getIndex',
        'as'   => 'admin.office-hour.index'
    ]);

    Route::get('office-hour/list', [
        'uses' => 'OfficeHourController@getList',
        'as' => 'admin.office-hour.list'
    ]);

    Route::get('office-hour/create', [
        'uses' => 'OfficeHourController@getCreate',
        'as' => 'admin.office-hour.create'
    ]);

    Route::Post('office-hour/create', [
        'uses' => 'OfficeHourController@postCreate',
        'as' => 'admin.office-hour.create'
    ]);

    Route::get('office-hour/update/{id?}', [
        'uses' => 'OfficeHourController@getUpdate',
        'as' => 'admin.office-hour.update'
    ]);

    Route::get('office-hour/delete/{id?}', [
        'uses' => 'OfficeHourController@getDelete',
        'as' => 'admin.office-hour.delete'
    ]);

    Route::get('office-hour/view/{id?}', [
        'uses' => 'OfficeHourController@getView',
        'as' => 'admin.office-hour.view'
    ]);
    /****** POP CAST   ******/

     /******MEME ******/
    Route::get('meme', [
        'uses' => 'MemeController@getIndex',
        'as'   => 'admin.meme.index'
    ]);

    Route::get('meme/list', [
        'uses' => 'MemeController@getList',
        'as' => 'admin.meme.list'
    ]);

    Route::get('meme/create', [
        'uses' => 'MemeController@getCreate',
        'as' => 'admin.meme.create'
    ]);

    Route::Post('meme/create', [
        'uses' => 'MemeController@postCreate',
        'as' => 'admin.meme.create'
    ]);

    Route::get('meme/update/{id?}', [
        'uses' => 'MemeController@getUpdate',
        'as' => 'admin.meme.update'
    ]);

    Route::get('meme/delete/{id?}', [
        'uses' => 'MemeController@getDelete',
        'as' => 'admin.meme.delete'
    ]);

    Route::get('meme/view/{id?}', [
        'uses' => 'MemeController@getView',
        'as' => 'admin.meme.view'
    ]);
     /****** MEME ******/

    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
});
