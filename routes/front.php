<?php

Route::get('pop-dictionary', function () {return redirect('pop-dictionary-word-of-day/1',301);});

Route::get('dictionary', function () {return redirect('pop-dictionary-word-of-day/1',301);});


Route::get('/invoice-remainder-mail', function() {
 Artisan::call('invoices:cron');
});

Route::get('/remainder-subscription-mail', function() {
 Artisan::call('reminder:cron');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    // return what you want
});


Route::group(['namespace' => 'Front'], function () {
/*  Game Room */
      Route::get('/game_room', [
        'uses' => 'GameRoomController@index',
        'as' => 'front.game_room'
    ]);
      /*  Game Room */


    Route::get('/', [
        'uses' => 'FeedsController@index',
        'as' => 'front.home'
    ]);

    Route::any('/feeds', [
        'uses' => 'FeedsController@index',
        'as' => 'front.feeds'
    ]);

    Route::any('/news_feeds_filter', [
        'uses' => 'FeedsController@news_feeds_filter',
        'as' => 'front.news_feeds_filter'
    ]);

    Route::get('/feeds_blogs', [
        'uses' => 'FeedsController@getBlog',
        'as' => 'front.feeds_blogs'
    ]);

    Route::post('/feeds_save', [
        'uses' => 'FeedsController@feeds_save',
        'as' => 'front.feeds.save'
    ]);

     Route::get('/feed_type', [
        'uses' => 'FeedsController@feed_type',
        'as' => 'front.feeds.feed_type'
    ]);

    Route::post('feed/new_post_type', [
        'uses' => 'FeedsController@new_post_type',
        'as' => 'front.feeds.new_post_type'
    ]);

     Route::post('/product-info', [
        'uses' => 'FeedsController@get_product_infp',
        'as' => 'front.feeds.product-info'
    ]);

    Route::post('/feed_image_upload', [
        'uses' => 'FeedsController@feed_image_upload',
        'as' => 'front.feeds.feed_image_upload'
    ]);

     Route::post('/feed_favorite', [
        'uses' => 'FeedsController@feed_favorite',
        'as' => 'front.feeds.feed_favorite'
    ]);

    Route::post('/feed_like', [
        'uses' => 'FeedsController@feed_like',
        'as' => 'front.feeds.feed_like'
    ]);

    Route::post('/feed_comment', [
        'uses' => 'FeedsController@feed_comment',
        'as' => 'front.feeds.feed_comment'
    ]);

    Route::post('/feed_comment_like', [
        'uses' => 'FeedsController@feed_comment_like',
        'as' => 'front.feeds.feed_comment_like'
    ]);

    Route::post('/feed_comment_like_user', [
        'uses' => 'FeedsController@feed_comment_like_user',
        'as' => 'front.feeds.feed_comment_like_user'
    ]);

    Route::post('/feed_preference', [
        'uses' => 'FeedsController@feedPreference',
        'as' => 'front.feeds.feed_preference'
    ]);


    Route::post('/feed_preference_search', [
        'uses' => 'FeedsController@feedPreferenceSearch',
        'as' => 'front.feeds.feed_preference_search'
    ]);

    Route::get('/feed/{id}', [
        'uses' => 'FeedsController@feedShare',
        'as' => 'front.feed.{id}'
    ]);

    Route::get('/feeds/croppieIndex', [
        'uses' => 'FeedsController@croppieIndex',
        'as' => 'front.feed.croppieIndex'
    ]);
    Route::post('/feeds/croppie-image-post', [
        'uses' => 'FeedsController@croppieUploadCropImage',
        'as' => 'front.feed.croppie-image-post'
    ]);

    /******** || Shubham Code Start ||  ********/
        Route::post('/feed_truth_data', [
            'uses' => 'FeedsController@feedTruthData',
            'as' => 'front.feeds.feed_truth_data'
        ]);
        Route::post('/feed_action_type', [
            'uses' => 'FeedsController@feedActionType',
            'as' => 'front.feeds.feed_action_type'
        ]);
        Route::get('/user/feed/update/{slug}/{id}', [
            'uses' => 'FeedsController@userFeedUpdate',
            'as' => 'front.user.feed.update/{slug}/{id}'
        ]);

        Route::any('/feeds/feed_check', [
            'uses' => 'FeedsController@feed_check',
            'as' => 'front.feeds.feed_check'
        ]);

        Route::any('/getOgProperty', [
            'uses' => 'FeedsController@getOgProperty',
            'as' => 'front.feeds.getOgProperty'
        ]);

        // -------------------------------------------------------- //

        Route::any('/news-feeds', [
            'uses' => 'FeedsNewsController@newsFeeds',
            'as' => 'front.feeds_news.news-feeds'
        ]);
        Route::get('/news_feed/{id}', [
            'uses' => 'FeedsNewsController@feedShare',
            'as' => 'front.feed_news.{id}'
        ]);
        Route::post('/news_feeds_feeds/croppie-image-post', [
            'uses' => 'FeedsNewsController@croppieUploadCropImage',
            'as' => 'front.feeds_news.croppie-image-post'
        ]);
        Route::post('/news_feeds_feed_like', [
            'uses' => 'FeedsNewsController@feed_like',
            'as' => 'front.feeds_news.feed_like'
        ]);
        Route::post('/news_feeds_feed_comment', [
            'uses' => 'FeedsNewsController@feed_comment',
            'as' => 'front.feeds_news.feed_comment'
        ]);
        Route::post('/news_feeds_feed_comment_like', [
            'uses' => 'FeedsNewsController@feed_comment_like',
            'as' => 'front.feeds_news.feed_comment_like'
        ]);
        Route::post('/news_feed_comment_like_user', [
            'uses' => 'FeedsNewsController@news_feed_comment_like_user',
            'as' => 'front.feeds_news.news_feed_comment_like_user'
        ]);
        Route::post('/searchNewFeedsData', [
            'uses' => 'FeedsNewsController@searchNewFeedsData',
            'as' => 'front.feeds_news.searchNewFeedsData'
        ]);
        Route::post('/news_feeds_submit_news_feeds_form', [
            'uses' => 'FeedsNewsController@submit_news_feeds_form',
            'as' => 'front.feeds_news.submit_news_feeds_form'
        ]);
        Route::post('/news_feeds_submit_news_feeds', [
            'uses' => 'FeedsNewsController@submit_news_feeds',
            'as' => 'front.feeds_news.submit_news_feeds'
        ]);
        Route::post('/news_feeds_new_post_type', [
            'uses' => 'FeedsNewsController@new_post_type',
            'as' => 'front.feeds_news.new_post_type'
        ]);
        Route::any('/news_feeds_news_feeds_filter', [
            'uses' => 'FeedsNewsController@news_feeds_filter',
            'as' => 'front.feeds_news.news_feeds_filter'
        ]);
        Route::post('/news_feeds_feeds_save', [
            'uses' => 'FeedsNewsController@feeds_save',
            'as' => 'front.feeds_news.save'
        ]);
        Route::get('/news_feeds_feed_type', [
            'uses' => 'FeedsNewsController@feed_type',
            'as' => 'front.feeds_news.feed_type'
        ]);
        Route::post('/news_feed_action_type', [
            'uses' => 'FeedsNewsController@newsFeedActionType',
            'as' => 'front.feeds_news.news_feed_action_type'
        ]);

        /******** || Bloom Reports Routes Start ||  ********/
        Route::any('/bloom_reports_test', [
            'uses' => 'BloomController@index',
            'as' => 'front.bloom_reports.bloom_reports_test'
        ]);
        /******** || Bloom Reports Routes End ||  ********/

    /******** || Shubham Code End ||  ********/

    Route::get('/pop-classified', [
        'uses' => 'PageController@getClassifiedList',
        'as' => 'front.pages.classifieds'
    ]);

     Route::get('/pop-classified/{type_id}', [
        'uses' => 'PageController@getClassifiedDetail',
        'as' => 'front.pages.classified.detail'
    ]);

    Route::get('/pop-classified-details/{slug}', [
        'uses' => 'PageController@getClassifiedSingleDetail',
        'as' => 'front.pages.classifiedDetails.details'
    ]);

    Route::get('/brand/{slug}', [
        'uses' => 'PageController@getBrand',
        'as' => 'front.pages.brand.detail'
    ]);

    Route::get('/3-truths-and-a-lie', [
        'uses' => 'PageController@getQuizDetail',
        'as' => 'front.pages.quiz.detail'
    ]);

    /******** || PR event Code Start ||  ********/

    Route::get('/marketing-pr-event', [
        'uses' => 'MarketingPrController@getCast',
        'as' => 'front.prEvent'
    ]);

    Route::get('/marketing-pr-event/{id}', [
        'uses' => 'MarketingPrController@getCastList',
        'as' => 'front.prEvent.{id}'
    ]);

    // Route::get('/marketing-pr-event/{slug}', [
    //     'uses' => 'MarketingPrController@getClassifiedSingleDetail',
    //     'as' => 'front.pages.prEvent.details'
    // ]);

    /******** || PR event Code End ||  ********/



/******** || Shubham Code Start ||  ********/
    Route::get('/3-truths-and-a-lie/{slug}', [
        'uses' => 'PageController@getSlugQuizDetail',
        'as' => 'front.pages.quiz.detail.{slug}'
    ]);
/******** || Shubham Code End ||  ********/

    Route::get('/quiz/', [
        'uses' => 'PageController@getQuiz',
        'as' => 'front.pages.quiz'
    ]);

     Route::get('/quiz/{id}', [
        'uses' => 'PageController@getQuizQuestion',
        'as' => 'front.pages.quiz.question'
    ]);

    Route::post('/quizquestion/save', [
        'uses' => 'PageController@postQuizQuestion',
        'as' => 'front.user.quizquestion.save'
    ]);

    Route::post('/quiz/save', [
        'uses' => 'PageController@postQuizApplication',
        'as' => 'front.user.quiz.save'
    ]);

    Route::get('/pop-dictionary/{slug}', [
        'uses' => 'PageController@getWordDetail',
        'as' => 'front.pages.word.detail'
    ]);

    Route::get('/pop-dictionary-word-of-day/{slug}', [
        'uses' => 'PageController@getWordofDay',
        'as' => 'front.pages.word.day'
    ]);

     /** Pages */
    Route::get('/email_template_dropdown/{type_id}', [
        'uses' => 'MailingListController@send_mail_template',
        'as' => 'front.auth.email.template.dropdown'
    ]);

    Route::get('/update-subscription', [
        'uses' => 'PlanController@get_subscription',
        'as' => 'front.user.update-subscription'
    ]);

    Route::get('/reminder-email', [
        'uses' => 'PlanController@email_reminder',
        'as' => 'front.user.reminder-email'
    ]);

    Route::get('/user/event/nominee', [
        'uses' => 'EventController@getNominee',
        'as' => 'front.user.event.nominee'
    ]);

    Route::get('/test-data-check', [
        'uses' => 'EventController@test_data_check',
        'as' => 'front.test-data-check'
    ]);

    Route::get('/pub', [
        'uses' => 'PagesController@getPubPage',
        'as' => 'front.pub'
    ]);

    Route::get('/modal-youtube', [
        'uses' => 'PagesController@youtubeGalleryHomePage',
        'as' => 'front.modal-youtube'
    ]);


    Route::get('/coming-soon', [
        'uses' => 'PageController@getComingSoonPage',
        'as' => 'front.page.coming-soon'
    ]);

    /** Auth Routes */
    // Route::get('/', [
    //     'uses' => 'PagesController@getHomePage',
    //     'as' => 'front.home'
    // ]);

    /******** || Shubham Code Start ||  ********/

        Route::get('/stripe_customers_test', [
            'uses' => 'PagesController@getstripeCustomersTest',
            'as' => 'front.stripe_customers_test'
        ]);
    /******** || Shubham Code End ||  ********/

    Route::post('/home-page-award/modal', [
        'uses' => 'PagesController@getHomePageAwardModal',
        'as' => 'front.home-page-award.modal'
    ]);

    Route::get('/login', [
        'uses' => 'AuthenticationController@getLogin',
        'as' => 'front.login'
    ]);

    Route::get('/sign-up', [
        'uses' => 'AuthenticationController@getSign_up',
        'as' => 'front.sign-up'
    ]);

    Route::post('/login', [
        'uses' => 'AuthenticationController@postLogin',
        'as' => 'front.login'
    ]);

    Route::post('/register', [
        'uses' => 'AuthenticationController@postRegister',
        'as' => 'front.register'
    ]);

    Route::get('/register', [
        'uses' => 'AuthenticationController@getRegister',
        'as' => 'front.register'
    ]);

    Route::get('/TermsAndConditions', [
        'uses' => 'AuthenticationController@Terms_Conditions',
        'as' => 'front.TermsAndConditions'
    ]);

    Route::get('/register/{type}/{plan_id_encrypt}', [
        'uses' => 'AuthenticationController@getRegister',
        'as' => 'front.register_screen'
    ]);

    Route::get('/logout', [
        'uses' => 'AuthenticationController@getLogout',
        'as' => 'front.logout'
    ]);

    Route::get('/delete_account', [
        'uses' => 'AuthenticationController@delete_account',
        'as' => 'front.delete_account'
    ]);

    Route::get('/reset-password/{user_id?}', [
        'uses' => 'AuthenticationController@getResetPassword',
        'as' => 'front.reset_password'
    ]);

    Route::post('/reset-password', [
        'uses' => 'AuthenticationController@postResetPassword',
        'as' => 'front.reset_password'
    ]);


    Route::get('/forgot-password', [
        'uses' => 'AuthenticationController@getForgotPassword',
        'as' => 'front.forgot_password'
    ]);

    Route::post('/forgot-password', [
        'uses' => 'AuthenticationController@postForgotPassword',
        'as' => 'front.forgot_password'
    ]);

    Route::get('/contact-us', [
        'uses' => 'ContactController@getContactUs',
        'as' => 'front.contact-us'
    ]);

    Route::post('/contact-us/save', [
        'uses' => 'ContactController@postContactUs',
        'as' => 'front.contact-us.save'
    ]);

    /** End Auth Routes */

    Route::get('/user/getAgent', [
        'uses' => 'EventController@getAgent',
        'as' => 'front.user.getAgent'
    ]);

    Route::get('/user/getBrandListDropDown', [
        'uses' => 'BrandListController@getBrandList',
        'as' => 'front.user.getBrandList'
    ]);

    /** Pages */
    Route::get('/event/{slug}', [
        'uses' => 'PageController@getEvent',
        'as' => 'front.pages.event.detail'
    ]);

    Route::get('/inventor/{username}', [
        'uses' => 'PageController@getInventor',
        'as' => 'front.pages.inventor.detail'
    ]);

     Route::get('/company/{slug}', [
        'uses' => 'PageController@getCompany',
        'as' => 'front.pages.company.detail'
    ]);


    Route::get('/people/{slug}', [
        'uses' => 'PageController@getPeople',
        'as' => 'front.pages.people.detail'
    ]);

    // Route::get('{slug}', [
    //     'uses' => 'PageController@getCompany_test',
    //     'as' => 'front.pages.people.detail.test'
    // ]);



    Route::get('/tester/social', [
        'uses' => 'PageController@test_social',
        'as' => 'front.pages.company.test-social'
    ]);

    Route::get('/product/{slug}', [
        'uses' => 'PageController@getProduct',
        'as' => 'front.pages.product.detail'
    ]);

    Route::post('/page/ajax-gallery-video-image-data', [
        'uses' => 'HomeAjaxController@getAjaxGalleryImageData',
        'as' => 'front.home.video.knownfor.image.ajax'
    ]);

     Route::post('/page/ajax-award-image-data', [
        'uses' => 'HomeAjaxController@getAjaxHomeImageAwardData',
        'as' => 'front.home.award.image.ajax'
    ]);


    Route::get('/blog', [
        'uses' => 'BlogController@getAllBlogs',
        'as' => 'front.pages.blogs'
    ]);

    Route::get('/blog_pedia', [
        'uses' => 'BlogController@getAllBlogPedias',
        'as' => 'front.pages.blog_pedias'
    ]);

    Route::get('/blog_pedia/{id}', [
        'uses' => 'BlogController@getAllBlogPediasFilter',
        'as' => 'front.pages.blog_pedias.id'
    ]);

    Route::get('/blog/{slug}', [
        'uses' => 'BlogController@getBlogDetail',
        'as' => 'front.pages.blog.detail'
    ]);

    Route::get('/news', [
        'uses' => 'NewsController@getAllNews',
        'as' => 'front.pages.news'
    ]);

    Route::get('/news/{slug}', [
        'uses' => 'NewsController@getNewsDetail',
        'as' => 'front.pages.news.detail'
    ]);

    Route::get('/did-you-know-list/{slug}', [
        'uses' => 'NewsController@getUserNewsList',
        'as' => 'front.pages.user.news'
    ]);

    Route::get('/blog-list/{slug}/', [
        'uses' => 'BlogController@getUserBlogList',
        'as' => 'front.pages.user.blog'
    ]);

    Route::get('/featured-article', [
        'uses' => 'BlogController@getAdminBlogList',
        'as' => 'front.pop_blogs'
    ]);
    Route::get('/featured-article/{slug}/', [
        'uses' => 'BlogController@getAdminBlogDetail',
        'as' => 'front.pop_blogs.slug'
    ]);

    Route::get('/featured-article/search/{id}', [
        'uses' => 'BlogController@getAllInterviewFilter',
        'as' => 'front.pages.featured-article.search.id'
    ]);


    Route::get('/did-you-know/{slug}', [
        'uses' => 'NewsController@getDidYouKnowDetail',
        'as' => 'front.pages.did-you-know.detail'
    ]);
    /** End Pages */

    Route::get('/pages/{type?}', [
        'uses' => 'PageController@getDropMenu',
        'as' => 'front.pages.drop_menu'
    ]);


      Route::get('/columnists', [
        'uses' => 'ColumnistsController@index',
        'as' => 'front.columnists'
    ]);
    /* user gallery urls */

    Route::get('/user/{slug}/image-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.user.imagegallery.index'
    ]);

    Route::get('/report/{type}/{url}/{profile_url}', [
        'uses' => 'ImageVideoGalleryController@report',
        'as' => 'front.report'
    ]);

    Route::get('/user/{slug}/video-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.user.videogallery.index'
    ]);

    Route::get('/user/{slug}/known-for-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.user.knownforgallery.index'
    ]);

    /* product gallery urls */

    Route::get('/product/{slug}/image-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.product.imagegallery.index'
    ]);

    Route::get('/product/{slug}/video-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.product.videogallery.index'
    ]);

    Route::get('/product/{slug}/known-for-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.product.knownforgallery.index'
    ]);

    /* brand gallery urls */

    Route::get('/brand/{slug}/image-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.brand.imagegallery.index'
    ]);

    Route::get('/brand/{slug}/video-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.brand.videogallery.index'
    ]);

    Route::get('/brand/{slug}/known-for-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.brand.knownforgallery.index'
    ]);

    /* event gallery urls */
    Route::get('/event/{slug}/image-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.event.imagegallery.index'
    ]);

    Route::get('/event/{slug}/video-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.event.videogallery.index'
    ]);

    Route::get('/event/{slug}/known-for-gallery', [
        'uses' => 'ImageVideoGalleryController@showGalleryByFilter',
        'as' => 'front.event.knownforgallery.index'
    ]);

    /* for top header search */

    Route::post('/home/get-ajax-site-search-data', [
        'uses' => 'SearchPageController@getSearchAjaxData',
        'as' => 'front.home.site.ajaxsearch.data'
    ]);

    Route::post('/home/get-site-search-data', [
        'uses' => 'SearchPageController@getHomeSearchPage',
        'as' => 'front.home.site.search.data'
    ]);

    /* for top header search */

    /* for word dictioanry search */

    Route::post('/home/get-ajax-site-dictionary-data', [
        'uses' => 'SearchPageController@getWordSearchAjaxData',
        'as' => 'front.home.site.word.ajaxsearch.data'
    ]);

    //Route::get('/home/get-site-search-data', function(){
      //return redirect('/', 301);
    //});

    Route::get('/home/get-site-search-data', [
        'uses' => 'SearchPageController@getHomeSearchPage',
        'as' => 'front.home.site.search.data'
    ]);


    Route::post('/polls/submit', [
        'uses' => 'PageController@postPollsSubmit',
        'as' => 'front.polls.submit'
    ]);

    Route::post('/ads/ajax-get-ads-data', [
        'uses' => 'HomeAjaxController@getAjaxAdvertisementData',
        'as' => 'front.home.ads.image.ajax'
    ]);

    Route::get('/ads/get-no-clicks/{ad_id}', [
        'uses' => 'PagesController@getAdsNoOfClicks',
        'as' => 'front.home.ads.no.clicks.ajax'
    ]);

    Route::get('/knowledge-base/faqs', [
        'uses' => 'KnowledgeBaseController@getFaqs',
        'as' => 'front.pages.knowledge.base.faqs'
    ]);

    Route::get('/knowledge-base/article-categories', [
        'uses' => 'KnowledgeBaseController@getArticleCategories',
        'as' => 'front.pages.knowledge.base.article.categories'
    ]);

    Route::get('/knowledge-base/article-by-category/{category_id}', [
        'uses' => 'KnowledgeBaseController@getArticleByCategory',
        'as' => 'front.pages.knowledge.base.article.by.category'
    ]);

    Route::get('/knowledge-base/article-show/{article_id}', [
        'uses' => 'KnowledgeBaseController@showArticle',
        'as' => 'front.pages.knowledge.base.article.by.id'
    ]);

    Route::get('/payment/cancel/{id}', [
        'uses' => 'PlanController@payment_cancel',
        'as' => 'front.pages.payment.cancel'
    ]);

    Route::get('/payment/pay', ['uses' => 'PlanController@payment_pay']);

    Route::get('/payment/failed/{id}', [
        'uses' => 'PlanController@payment_failed',
        'as' => 'front.pages.payment.failed'
    ]);
    Route::get('/payment/success', [
        'uses' => 'PlanController@payment_success',
        'as' => 'front.pages.payment.success'
    ]);

    //Route::get('/{slug}', [
    //    'uses' => 'PageController@getPeople',
    //    'as' => 'front.pages.user.profile.detail'
    //]);
});

Route::group(['namespace' => 'Front'], function () {
    Route::get('/sales',"SalesController@index")->name("sales");
    Route::post('/sales/login',"SalesController@sales_login")->name("saleslogin");
    Route::get('/sales/reports',"SalesController@sales_reports")->name("SalesReports");
    Route::post('/sales/reset/pin',"SalesController@reset_pin")->name("SalesResetPin");
    Route::get('/sales/reset/change_pin',"SalesController@change_pin")->name("change_pin");
    Route::post('/sales/reset/pin_update',"SalesController@pin_update")->name("SalePinUpdate");
     /********* || Meme ||  *********/
     Route::post('/pages/meme', [
        'uses' => 'MemeController@memeModel',
        'as' => 'front.pages.meme'
     ]);
     Route::get('/pages/meme/{id}', [
        'uses' => 'MemeController@memeDetails',
        'as' => 'front.pages.meme.{id}'
     ]);
   /********* || Meme ||  *********/
});

Route::group(['namespace' => 'Front', 'middleware' => ['user.auth']], function () {
    /** Plans Routes */
    // Route::get('/plans', [
    //     'uses' => 'PlanController@getPlans',
    //     'as' => 'front.plans'
    // ]);
    Route::post('/plan/create-checkout-session', [
        'uses' => 'PlanController@create_checkout_session',
        'as' => 'front.plan.create.checkout.session'
    ]);

Route::post('/plan/save-subscription-data', [
        'uses' => 'PlanController@saveSubscriptionData',
        'as' => 'front.plan.save.subscriptiondata'
    ]);

    Route::post('/plan/couponcode', [
        'uses' => 'PlanController@get_coupon_id_by_code_ajax',
        'as' => 'front.plan.coupon.code'
    ]);

    Route::post('/plan/subscribe', [
        'uses' => 'PlanController@postPlanSubscribe',
        'as' => 'front.plan.subscribe'
    ]);

    Route::get('/plan/renew', [
        'uses' => 'PlanController@plan_renew',
        'as' => 'front.plan.renew'
    ]);

    Route::get('/card/update', [
        'uses' => 'PlanController@card_update',
        'as' => 'front.card.update'
    ]);

    Route::get('/cancel/subscription', [
        'uses' => 'PlanController@cancel_subscription',
        'as' => 'front.cancel.subscription'
    ]);



    Route::get('/plan/purchase/{role_id}/{encrypt_plan_id}/{change_plan}', [
        'uses' => 'PlanController@createStripePaymentIntent',
        'as' => 'front.plan.purchase'
    ]);

    /** Profile Route */
    Route::get('/user/free/profile', [
        'uses' => 'ProfileController@getFreeUserProfile',
        'as' => 'front.user.free.edit.profile'
    ]);

    Route::get('/user/free/profile/edit', [
        'uses' => 'ProfileController@getFreeUserEditProfile',
        'as' => 'front.user.free.edit.profile.edit'
    ]);

     Route::post('/user/free/profile/uploads', [
        'uses' => 'ProfileController@getUserProfileUploads',
        'as' => 'front.user.free.edit.profile.uploads'
    ]);

     Route::post('/user/profile/edit', [
        'uses' => 'ProfileController@postProfileEdit',
        'as' => 'front.user.profile.edit'
    ]);

    Route::get('/user/profile/getTags', [
        'uses' => 'ProfileController@get_tags',
        'as' => 'front.user.profile.edit.getTags'
    ]);
    Route::get('/user/profile/getTagsDropdown', [
        'uses' => 'ProfileController@get_tags_dropdown',
        'as' => 'front.user.profile.edit.getTagsDropdown'
    ]);


    Route::get('/user/blog/getBlogTagsDropdown', [
        'uses' => 'ModuleTwoController@get_blog_tags_dropdown',
        'as' => 'front.user.blog.edit.getBlogTagsDropdown'
    ]);



    /** End Plans Routes */
});

Route::group(['namespace' => 'Front', 'middleware' => ['user.auth', 'check.subscription']], function () {

     Route::post('/save-classified-applicant', [
        'uses' => 'ClassifiedController@postClassifiedApplicant',
        'as' => 'front.classified.save.applicant'
    ]);


    Route::post('/user/ajax-account-info', [
        'uses' => 'AccountAjaxController@getAjaxAccountData',
        'as' => 'front.user.site.ajax.account.data'
    ]);

    Route::post('/user/ajax-invoice-subscription-info', [
        'uses' => 'AccountAjaxController@getInvoicesBySubscriptionAjaxData',
        'as' => 'front.user.site.ajax.invoices.data'
    ]);

    Route::post('/user/getInvoiceId', [
        'uses' => 'AccountAjaxController@getInvoiceId',
        'as' => 'front.user.site.ajax.invoices.getInvoiceId'
    ]);

    Route::get('/search', [
        'uses' => 'SearchPageController@advance_search',
        'as' => 'front.home.site.advance.search.data'
    ]);

    Route::post('/search', [
        'uses' => 'SearchPageController@get_advance_search',
        'as' => 'front.home.site.advance.search.data'
    ]);

    /* Skills List */

     Route::get('/skills', [
        'uses' => 'SkillsControllers@index',
        'as' => 'front.home.search.skills'
    ]);

     Route::get('/skill/{slug}', [
        'uses' => 'SkillsControllers@getSkillData',
        'as' => 'front.home.search.skill.{slug}'
    ]);

     Route::get('/roles', [
        'uses' => 'SkillsControllers@indexRole',
        'as' => 'front.home.search.roles'
    ]);

    Route::get('/role/{id}', [
        'uses' => 'SkillsControllers@getRoleData',
        'as' => 'front.home.search.role.{id}'
    ]);

    /*Skills List  */
    /*Add new route that work after payment start */
    Route::get('/change-plan/{role_id}', [
        'uses' => 'PlanController@getPlans',
        'as' => 'front.plans'
    ]);

    Route::get('/add-to-watch-list', [
        'uses' => 'WatchListController@getAddToWatchList',
        'as' => 'front.pages.add_to_watch_list'
    ]);

    Route::get('/watch-list', [
        'uses' => 'WatchListController@getWatchList',
        'as' => 'front.pages.watch_list'
    ]);

    Route::get('/remove-from-watch-list/{id}', [
        'uses' => 'WatchListController@getRemoveWatchlist',
        'as' => 'front.pages.remove_from_watch_list'
    ]);

     Route::post('/user_image_update_sequance', [
        'uses' => 'ProfileController@getUpdateSequance',
        'as' => 'front.pages.user_image_update_sequance'
    ]);




    /*Add new route that work after payment end */

    Route::post('/user/profile/role-get-people-data', [
        'uses' => 'ProfileController@getPeopleData',
        'as' => 'front.pages.user_image_update_sequance'
    ]);

    Route::post('/user/profile/role-get-people-data', [
        'uses' => 'ProfileController@getPeopleData',
        'as' => 'front.user.role.search.people'
    ]);

    Route::post('/user/profile/role-get-company-data', [
        'uses' => 'ProfileController@getCompanyData',
        'as' => 'front.user.role.search.company'
    ]);

    Route::post('/user/profile/role-get-product-data', [
        'uses' => 'ProfileController@getProductData',
        'as' => 'front.user.role.search.product'
    ]);

    Route::post('/user/profile/role-get-brand-list-data', [
        'uses' => 'ProfileController@getBrandListData',
        'as' => 'front.user.role.search.brand_list'
    ]);

    Route::post('/user/profile/role-get-dictionary-list-data', [
        'uses' => 'ProfileController@getDictionaryListData',
        'as' => 'front.user.role.search.dictionary_list'
    ]);

    Route::get('/user/company/profile', [
        'uses' => 'ProfileController@getCompanyProfile',
        'as' => 'front.user.company.profile'
    ]);

    Route::get('/user/company/profile/edit', [
        'uses' => 'ProfileController@getCompanyProfileEdit',
        'as' => 'front.user.company.edit.profile'
    ]);

    Route::get('/user/profile', [
        'uses' => 'ProfileController@getProfile',
        'as' => 'front.user.profile'
    ]);

    Route::get('/user/get-user-role-data-ajax', [
        'uses' => 'ProfileController@getUserRoleData',
        'as' => 'front.user.profile.role.data.ajax'
    ]);

    Route::get('/user/profile/edit', [
        'uses' => 'ProfileController@getProfileEdit',
        'as' => 'front.user.profile.edit'
    ]);

    Route::post('/user/role-profile-data/edit', [
        'uses' => 'ProfileController@postUserProfileRoleEdit',
        'as' => 'front.user.profile.role.edit'
    ]);

    /*Route::get('/user/role-profile-data/delete/{id}', [
        'uses' => 'ProfileController@deleteRoleData',
        'as' => 'front.user.profile.role.delete'
    ]);*/

    Route::get('/user/delete-user-role-data-ajax/{id}', [
        'uses' => 'ProfileController@deleteRoleData',
        'as' => 'front.user.profile.role.delete'
    ]);
    /** End Profile Route */

    /** Product Route */
    Route::get('/user/product', [
        'uses' => 'ProductController@getIndex',
        'as' => 'front.user.product.index'
    ]);

    Route::get('/user/product/create', [
        'uses' => 'ProductController@getProductCreate',
        'as' => 'front.user.product.create'
    ]);

    Route::post('/user/product/create', [
        'uses' => 'ProductController@postProductCreate',
        'as' => 'front.user.product.create'
    ]);

    Route::get('/user/product/update/{slug}', [
        'uses' => 'ProductController@getUpdate',
        'as' => 'front.user.product.update'
    ]);

    Route::get('/user/product/delete/{slug}', [
        'uses' => 'ProductController@getDelete',
        'as' => 'front.user.product.delete'
    ]);

    Route::post('/user/product/collaborator/AddEdit', [
        'uses' => 'ProductController@collaborator_AddEdit',
        'as' => 'front.user.product.collaborator.AddEdit'
    ]);
    Route::get('/user/product/collaborator/delete/{id}', [
        'uses' => 'ProductController@collaborator_delete',
        'as' => 'front.user.product.collaborator.delete'
    ]);
    Route::get('/user/product/collaborator/edit_modal/{id}', [
        'uses' => 'ProductController@collaborator_edit_modal',
        'as' => 'front.user.product.collaborator.edit_modal'
    ]);
    Route::get('/user/product/update_sequence', [
        'uses' => 'ProductController@update_sequence',
        'as' => 'front.user.product.update_sequence'
    ]);

    Route::get('/user/product/get_sub_category', [
        'uses' => 'ProductController@get_sub_category',
        'as' => 'front.user.product.get_sub_category'
    ]);

    Route::get('/user/product/get_category_BYGroup', [
        'uses' => 'ProductController@get_category_BYGroup',
        'as' => 'admin.product.get_category_BYGroup'
    ]);

    /* end Product Route */


    /** Brand Route */
    Route::get('/user/brand', [
        'uses' => 'BrandListController@getIndex',
        'as' => 'front.user.brand.index'
    ]);

      Route::post('/user/brand/post_upload', [
        'uses' => 'BrandListController@postBrandImageUpload',
        'as' => 'front.user.brand.upload'
    ]);

    Route::get('/user/brand/create', [
        'uses' => 'BrandListController@getBrandListCreate',
        'as' => 'front.user.brand.create'
    ]);

    Route::post('/user/brand/create', [
        'uses' => 'BrandListController@postBrandListCreate',
        'as' => 'front.user.brand.create'
    ]);

    Route::get('/user/brand/update/{slug}', [
        'uses' => 'BrandListController@getUpdate',
        'as' => 'front.user.brand.update'
    ]);

    Route::get('/user/brand/delete/{slug}', [
        'uses' => 'BrandListController@getDelete',
        'as' => 'front.user.brand.delete'
    ]);

    Route::post('/user/brand/collaborator/AddEdit', [
        'uses' => 'BrandListController@collaborator_AddEdit',
        'as' => 'front.user.brand.collaborator.AddEdit'
    ]);
    Route::get('/user/brand/collaborator/delete/{id}', [
        'uses' => 'BrandListController@collaborator_delete',
        'as' => 'front.user.brand.collaborator.delete'
    ]);
    Route::get('/user/brand/update_sequence', [
        'uses' => 'BrandListController@update_sequence',
        'as' => 'front.user.brand.update_sequence'
    ]);

    Route::get('/user/brand/get_sub_category', [
        'uses' => 'BrandListController@get_sub_category',
        'as' => 'front.user.brand.get_sub_category'
    ]);

    Route::get('/user/brand/get_category_BYGroup', [
        'uses' => 'BrandListController@get_category_BYGroup',
        'as' => 'admin.brand.get_category_BYGroup'
    ]);



    /* end Brand Route */


    Route::get('/change-password', [
        'uses' => 'ProfileController@getChangePassword',
        'as' => 'front.user.profile.change_password'
    ]);

    Route::post('/change-password', [
        'uses' => 'ProfileController@postChangePassword',
        'as' => 'front.user.profile.change_password'
    ]);
    /** End Product Route */

    /** Profile Event Route  */
    Route::get('/user/event', [
        'uses' => 'EventController@getEvents',
        'as' => 'front.user.event.index'
    ]);

    Route::get('/user/event/create', [
        'uses' => 'EventController@getCreateEvent',
        'as' => 'front.user.event.create'
    ]);

    Route::post('/user/event/create', [
        'uses' => 'EventController@postCreateEvent',
        'as' => 'front.user.event.create'
    ]);

    Route::get('/user/event/update/{slug}', [
        'uses' => 'EventController@getUpdateEvent',
        'as' => 'front.user.event.update'
    ]);

    Route::get('/user/event/delete/{slug}', [
        'uses' => 'EventController@getDeleteEvent',
        'as' => 'front.user.event.delete'
    ]);

    Route::post('/user/event/award/create', [
        'uses' => 'EventController@postAwardCreate',
        'as' => 'front.user.event.award.create'
    ]);



    Route::get('/user/event/{slug}', [
        'uses' => 'EventController@getEventView',
        'as' => 'front.user.event.view'
    ]);
    /**End Profile Event Route  */

    /** Event Awards */
    Route::get('/user/event/award/{event_id?}', [
        'uses' => 'AwardController@getAwards',
        'as' => 'front.user.event.award.index'
    ]);

    Route::get('/user/event/award/create/{event_id?}', [
        'uses' => 'AwardController@getCreateAward',
        'as' => 'front.user.event.award.create'
    ]);

    Route::post('/user/event/award/create', [
        'uses' => 'AwardController@postCreateAward',
        'as' => 'front.user.event.award.create'
    ]);

    Route::get('/user/event/award/update/{id?}', [
        'uses' => 'AwardController@getUpdateAward',
        'as' => 'front.user.event.award.update'
    ]);

    Route::get('/user/event/award/delete/{id?}', [
        'uses' => 'AwardController@getDeleteAward',
        'as' => 'front.user.event.award.delete'
    ]);
    /** End Event Awards */

    /** Profile Media Route */
    Route::get('/user/media', [
        'uses' => 'MediaController@getMediaList',
        'as' => 'front.user.media.index'
    ]);

    Route::get('/user/media/create', [
        'uses' => 'MediaController@getCreateMedia',
        'as' => 'front.user.media.create'
    ]);

    Route::post('/user/media/create', [
        'uses' => 'MediaController@postCreateMedia',
        'as' => 'front.user.media.create'
    ]);

    Route::get('/user/media/update/{slug}', [
        'uses' => 'MediaController@getUpdateMedia',
        'as' => 'front.user.media.update'
    ]);

    Route::get('/user/media-update/{slug}', [
        'uses' => 'MediaController@getWithOutProfileUpdateMedia',
        'as' => 'front.user.media-update'
    ]);

    Route::get('/user/media/delete/{slug}', [
        'uses' => 'MediaController@getDeleteMedia',
        'as' => 'front.user.media.delete'
    ]);
    /** End Profile Media Route */



    /** Profile Award Route */
    Route::get('/user/award', [
        'uses' => 'AwardUserController@getAwardList',
        'as' => 'front.user.award.index'
    ]);

    Route::get('/user/award/create', [
        'uses' => 'AwardUserController@getCreateAward',
        'as' => 'front.user.award.create'
    ]);

    Route::post('/user/award/create', [
        'uses' => 'AwardUserController@postCreateAward',
        'as' => 'front.user.award.create'
    ]);

    Route::get('/user/award/update/{slug}', [
        'uses' => 'AwardUserController@getUpdateAward',
        'as' => 'front.user.award.update'
    ]);

    Route::get('/user/award/delete/{slug}', [
        'uses' => 'AwardUserController@getDeleteAward',
        'as' => 'front.user.award.delete'
    ]);
    /** End Profile Award Route */


    /** Dictionary Route */
    Route::get('/user/dictionary', [
        'uses' => 'DictionaryController@getDictionaries',
        'as' => 'front.user.dictionary.index'
    ]);

    Route::get('/user/dictionary/create', [
        'uses' => 'DictionaryController@getCreateDictionary',
        'as' => 'front.user.dictionary.create'
    ]);

    Route::post('/user/dictionary/create', [
        'uses' => 'DictionaryController@postCreateDictionary',
        'as' => 'front.user.dictionary.create'
    ]);

    Route::get('/user/dictionary/update/{slug}', [
        'uses' => 'DictionaryController@getUpdateDictionary',
        'as' => 'front.user.dictionary.update'
    ]);

    Route::get('/user/dictionary/delete/{slug}', [
        'uses' => 'DictionaryController@getDeleteDictionary',
        'as' => 'front.user.dictionary.delete'
    ]);
    /** End Dictionary Route */

    /** Classified Route */
    Route::get('/user/classified', [
        'uses' => 'ClassifiedController@getClassifieds',
        'as' => 'front.user.classified.index'
    ]);

    Route::get('/user/classified/create', [
        'uses' => 'ClassifiedController@getCreateClassified',
        'as' => 'front.user.classified.create'
    ]);

    Route::post('/user/classified/create', [
        'uses' => 'ClassifiedController@postCreateClassified',
        'as' => 'front.user.classified.create'
    ]);

    Route::get('/user/classified/update/{slug}', [
        'uses' => 'ClassifiedController@getUpdateClassified',
        'as' => 'front.user.classified.update'
    ]);

    Route::get('/user/classified/delete/{slug}', [
        'uses' => 'ClassifiedController@getDeleteClassified',
        'as' => 'front.user.classified.delete'
    ]);
    /** End Classified Route */


    /** Profile Blog Route */
    Route::get('/user/blog', [
        'uses' => 'BlogController@getBlogs',
        'as' => 'front.user.blog.index'
    ]);

    Route::get('/user/blog/create', [
        'uses' => 'BlogController@getCreateBlog',
        'as' => 'front.user.blog.create'
    ]);

    Route::post('/user/blog/create', [
        'uses' => 'BlogController@postCreateBlog',
        'as' => 'front.user.blog.create'
    ]);

    Route::get('/user/blog/update/{slug}', [
        'uses' => 'BlogController@getUpdateBlog',
        'as' => 'front.user.blog.update'
    ]);

    Route::get('/user/blog/delete/{slug}', [
        'uses' => 'BlogController@getDeleteBlog',
        'as' => 'front.user.blog.delete'
    ]);


    Route::post('/user/blog/upload', [
        'uses' => 'BlogController@getBlogUploadImg',
        'as' => 'front.user.blog.upload'
    ]);

    /******** || Shubham Code Start ||  ********/
        Route::get('/user/blog/preview_detail/{slug}', [
            'uses' => 'BlogController@blogPreview',
            'as' => 'front.user.blog.preview_detail.{slug}'
        ]);

        Route::get('/user/blog/pre_view_detail/{slug}', [
            'uses' => 'BlogController@blogPre_View_Show',
            'as' => 'front.user.blog.pre_view_detail.{slug}'
        ]);

        Route::post('/user/blog/pre_preview_detail', [
            'uses' => 'BlogController@blog_Pre_Preview',
            'as' => 'front.user.blog.pre_preview_detail'
        ]);

        Route::post('/user/blog/publish_blog', [
            'uses' => 'BlogController@publish_blog',
            'as' => 'front.user.blog.publish_blog'
        ]);
    /******** || Shubham Code End ||  ********/

    /** End Profile Blog Route */

    /** Profile Blog Route */
    Route::get('/user/did-you-know', [
        'uses' => 'NewsController@getNewsData',
        'as' => 'front.user.news.index'
    ]);

    Route::get('/user/manage-subscription', [
        'uses' => 'NewsController@manage_subscription',
        'as' => 'front.user.manage-subscription'
    ]);

    Route::get('/user/manage-account-subscription', [
        'uses' => 'PlanController@manage_account_subscription',
        'as' => 'front.user.manage-account-subscription'
    ]);

    Route::get('/user/manage-payment-subscription', [
        'uses' => 'PaymentSubscriptionController@manage_payment_subscription',
        'as' => 'front.user.manage-payment-subscription'
    ]);

    Route::get('/user/newsletter-subscribe/{ids}', [
        'uses' => 'NewsController@newsletter_subscribe',
        'as' => 'front.user.newsletter-subscribe'
    ]);

    Route::get('/user/news/create', [
        'uses' => 'NewsController@getCreateBlog',
        'as' => 'front.user.news.create'
    ]);

    Route::post('/user/news/create', [
        'uses' => 'NewsController@postCreateBlog',
        'as' => 'front.user.news.create'
    ]);

    Route::get('/user/news/update/{slug}', [
        'uses' => 'NewsController@getUpdateBlog',
        'as' => 'front.user.news.update'
    ]);

    Route::get('/user/news/delete/{slug}', [
        'uses' => 'NewsController@getDeleteBlog',
        'as' => 'front.user.news.delete'
    ]);
    /** End Profile Blog Route */


    /** Gallery Route */

    Route::get('/{slug}/test-data', [
        'uses' => 'ImageVideoGalleryController@getTest',
        'as' => 'front.user.imagegallery.test'
    ]);

    Route::post('/gallery/image_update_sequance', [
        'uses' => 'ImageVideoGalleryController@getUpdateSequance',
        'as' => 'front.user.gallery.image_update_sequance'
    ]);

    Route::post('/gallery/update_sequance_image_data', [
        'uses' => 'ImageVideoGalleryController@updateSequenceImageData',
        'as' => 'front.user.gallery.update_sequance_image_data'
    ]);

    Route::post('/gallery/get_youtube_thumbnail', [
        'uses' => 'ImageVideoGalleryController@postYoutubeThumbnail',
        'as' => 'front.user.gallery.get_youtube_thumbnail'
    ]);
    /* user gallery urls */

    Route::post('/user/{slug}/image-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.user.imagegallery.create'
    ]);

    Route::post('/user/{slug}/image-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.user.imagegallery.delete'
    ]);

    Route::post('/user/{slug}/video-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.user.videogallery.create'
    ]);

    Route::post('/user/{slug}/video-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.user.videogallery.delete'
    ]);

    Route::post('/user/{slug}/known-for-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.user.knownforgallery.create'
    ]);

    Route::post('/user/{slug}/known-for-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.user.knownforgallery.delete'
    ]);

    /* product gallery urls */

    Route::post('/product/{slug}/image-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.product.imagegallery.create'
    ]);

    Route::post('/product/{slug}/image-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.product.imagegallery.delete'
    ]);

    Route::post('/product/{slug}/video-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.product.videogallery.create'
    ]);

    Route::post('/product/{slug}/video-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.product.videogallery.delete'
    ]);

    Route::post('/product/{slug}/known-for-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.product.knownforgallery.create'
    ]);

    Route::post('/product/{slug}/known-for-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.product.knownforgallery.delete'
    ]);

    Route::post('/gallery/images/modal_list', [
        'uses' => 'ImageVideoGalleryController@postGalleryList',
        'as' => 'front.gallery.images.modal_list'
    ]);

    Route::post('/gallery/images/edit_modal_list', [
        'uses' => 'ImageVideoGalleryController@addOrEditPostGalleryList',
        'as' => 'front.gallery.images.edit_modal_list'
    ]);

    Route::post('/gallery/images/test_searching', [
        'uses' => 'ImageVideoGalleryController@test_searching',
        'as' => 'front.gallery.images.test_searching'
    ]);

    /* brand gallery urls */

    Route::post('/brand/{slug}/image-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.brand.imagegallery.create'
    ]);

    Route::post('/brand/{slug}/image-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.brand.imagegallery.delete'
    ]);

    Route::post('/brand/{slug}/video-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.brand.videogallery.create'
    ]);

    Route::post('/brand/{slug}/video-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.brand.videogallery.delete'
    ]);

    Route::post('/brand/{slug}/known-for-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.brand.knownforgallery.create'
    ]);

    Route::post('/brand/{slug}/known-for-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.brand.knownforgallery.delete'
    ]);

    /* event gallery urls */

    Route::post('/event/{slug}/image-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.event.imagegallery.create'
    ]);

    Route::post('/event/{slug}/image-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.event.imagegallery.delete'
    ]);

    Route::post('/event/{slug}/video-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.event.videogallery.create'
    ]);

    Route::post('/event/{slug}/video-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.event.videogallery.delete'
    ]);

    Route::post('/event/{slug}/known-for-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.event.knownforgallery.create'
    ]);

    Route::post('/event/{slug}/known-for-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.event.knownforgallery.delete'
    ]);

    /* gallery urls */

    Route::get('/all/image-gallery', [
        'uses' => 'ImageVideoGalleryController@getIndex',
        'as' => 'front.all.imagegallery.index'
    ]);

 Route::post('/all/image-gallery/upload', [
        'uses' => 'ImageVideoGalleryController@postUploadImage',
        'as' => 'front.gallery.image.upload'
    ]);

    /*Route::get('/user/image-gallery/create', [
        'uses' => 'ImageVideoGalleryController@getProductCreate',
        'as' => 'front.user.imagegallery.create'
    ]); */

    Route::post('/all/image-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.all.imagegallery.create'
    ]);

    Route::post('/all/image-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.all.imagegallery.delete'
    ]);



    Route::get('/all/video-gallery', [
        'uses' => 'ImageVideoGalleryController@getIndex',
        'as' => 'front.all.videogallery.index'
    ]);

    /*Route::get('/user/video-gallery/create', [
        'uses' => 'ImageVideoGalleryController@getProductCreate',
        'as' => 'front.user.videogallery.create'
    ]); */

    Route::post('/all/video-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.all.videogallery.create'
    ]);

    Route::post('/all/video-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.all.videogallery.delete'
    ]);

    Route::get('/all/known-for-gallery', [
        'uses' => 'ImageVideoGalleryController@getIndex',
        'as' => 'front.all.knownforgallery.index'
    ]);


    /*Route::get('/user/image-gallery/create', [
        'uses' => 'ImageVideoGalleryController@getProductCreate',
        'as' => 'front.user.imagegallery.create'
    ]); */

    Route::post('/all/known-for-gallery/create', [
        'uses' => 'ImageVideoGalleryController@postGalleryCreate',
        'as' => 'front.all.knownforgallery.create'
    ]);

    Route::post('/all/known-for-gallery/delete', [
        'uses' => 'ImageVideoGalleryController@deleteGallery',
        'as' => 'front.all.knownforgallery.delete'
    ]);

    Route::get('/user/award-nominee', [
        'uses' => 'AwardNomineeController@getIndex',
        'as' => 'front.user.awardnominee.index'
    ]);

    Route::get('/user/main-list', [
        'uses' => 'MainListPageController@getIndex',
        'as' => 'front.user.mainlist.index'
    ]);

    Route::post('/tinyimage/upload', [
        'uses' => 'TinyImageController@store',
        'as' => 'front.tinyimage.upload'
    ]);


    Route::get('/user/message/', [
        'uses' => 'MessageController@getMassageBox',
        'as' => 'front.user.message'
    ]);

    Route::get('/user/message/{id}', [
        'uses' => 'MessageController@getMassageBox',
        'as' => 'front.user.message/{id}'
    ]);

    Route::get('/user/messagetext/', [
        'uses' => 'MessageController@postConvertionUser',
        'as' => 'front.user.messagetext'
    ]);

    Route::post('/user/message/message_sidebar', [
        'uses' => 'MessageController@messageSidebar',
        'as' => 'front.user.message.message_sidebar'
    ]);

    Route::match(['get','post'],'/user/message/send', [
        'uses' => 'MessageController@SendMessage',
        'as' => 'front.user.message.send'
    ]);

    Route::match(['get','post'],'/user/message/read', [
        'uses' => 'MessageController@ReadMessage',
        'as' => 'front.user.message.read'
    ]);

    /********* || Wiki Route||  *********/
    Route::get('/wiki', [
        'uses' => 'WikiController@getCategoryWiki',
        'as' => 'front.wiki'
    ]);

     Route::get('/wiki/{id}', [
        'uses' => 'WikiController@getWikiList',
        'as' => 'front.wiki.{id}'
    ]);


      Route::get('/wiki/test/test-mail', [
        'uses' => 'WikiController@test_mail',
        'as' => 'front.test.test-mail'
    ]);
    /********* || Wiki Route||  *********/
    /********* || Rest In Play Route||  *********/
    Route::get('/rest-in-play', [
        'uses' => 'RipController@getCategoryWiki',
        'as' => 'front.rest-in-play'
    ]);

    Route::get('/rest-in-play/{id}', [
        'uses' => 'RipController@getWikiList',
        'as' => 'front.rest-in-play.{id}'
    ]);
    /********* || Rest In Play Route||  *********/

    /********* || Youtube Premieres ||  *********/
    Route::get('/youtube-premieres', [
        'uses' => 'YoutubePremieresController@getIndex',
        'as' => 'front.youtube-premieres'
    ]);
    /********* || Youtube Premieres ||  *********/
    /********* || 2021-toy-game-innovation-awards ||  *********/
    Route::get('/2021-toy-game-innovation-awards', [
        'uses' => 'PagesController@toyGameInnovationAwards',
        'as' => 'front.2021-toy-game-innovation-awards'
    ]);
    /********* || 2021-toy-game-innovation-awardss ||  *********/


    /********* || POP Entertainment ||  *********/
    Route::get('/entertainment', [
        'uses' => 'EntertainmentController@getEntertainment',
        'as' => 'front.entertainment'
    ]);

    Route::get('/entertainment/{id}', [
        'uses' => 'EntertainmentController@getEntertainmentList',
        'as' => 'front.entertainment.{id}'
    ]);
   /********* || POP Entertainment ||  *********/

  /********* || POP Cast ||  *********/
    Route::get('/popcast', [
        'uses' => 'EntertainmentController@getCast',
        'as' => 'front.popcast'
    ]);

    Route::get('/popcast/{id}', [
        'uses' => 'EntertainmentController@getCastList',
        'as' => 'front.popcast.{id}'
    ]);
   /********* || POP Cast ||  *********/






});


Route::get('/service-providers', [
    'uses' => 'Front\PagesController@getOfficeHour',
    'as' => 'front.service-providers'
]);

Route::get('/about', [
    'uses' => 'Front\PagesController@aboutPop',
    'as' => 'front.about'
]);

/******** || Shubham Code Start ||  ********/

    Route::POST('/shareWikiToFeed', [
        'uses' => 'Front\PagesController@shareWikiToFeed',
        'as' => 'front.shareWikiToFeed'
    ]);
    /********* || Rest In Play Route||  *********/
    Route::get('/rest-in-play', [
        'uses' => 'Front\RipController@getCategoryWiki',
        'as' => 'front.rest-in-play'
    ]);

    Route::get('/rest-in-play/{id}', [
        'uses' => 'Front\RipController@getWikiList',
        'as' => 'front.rest-in-play.{id}'
    ]);
    /********* || Rest In Play Route||  *********/
/******** || Shubham Code End ||  ********/


//Route::get('/user/image-gallery',"Front\PageController@getImageGallery")->name("imagegallery");
//Route::get('/tag/get-user-tags',"Front\TagController@getUserTags")->name("usertags");
//Route::get('/tag/get-product-tags',"Front\TagController@getProductTags")->name("producttags");
//Route::get('/tag/get-award-tags',"Front\TagController@getAwardTags")->name("awardtags");
Route::get('/tag/test-gallery-data', "Front\TagController@index")->name("companytags");

Route::get('/tag/test-payment-gateway', "Front\TagController@getTestPaymentGateway")->name("test-payment-gateway");
Route::get('/tag/test-payment', "Front\TestTagController@checkout_session")->name("test-payment");


Route::get('/a/b/c/d/e/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
