<?php

use App\FaqStudent;
use App\FaqInstructor;
use App\User;

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

Route::get('/offline','GuestController@offlineview');
Route::get('/install/proceed/Eula','InstallerController@eula')->name('installer');
Route::post('/install/proceed/Eula','InstallerController@storeeula')->name('store.eula');
Route::get('/install/proceed/servercheck','InstallerController@serverCheck')->name('servercheck');
Route::post('/install/proceed/servercheck','InstallerController@storeserver')->name('store.server');

Route::get('verifylicense','InstallerController@verifylicense')->name('verifylicense');
Route::get('install/proceed/verifyapp','InstallerController@verify')->name('verifyApp');
Route::post('verifycode','InitializeController@verify');

Route::get('/install/proceed/step1','InstallerController@index')->name('installApp');

Route::post('store/step1','InstallerController@step1')->name('store.step1');
Route::get('get/step2','InstallerController@getstep2')->name('get.step2');
Route::post('store/step2','InstallerController@step2')->name('store.step2');
Route::get('get/step3','InstallerController@getstep3')->name('get.step3');
Route::post('store/step3','InstallerController@storeStep3')->name('store.step3');
Route::get('get/step4','InstallerController@getstep4')->name('get.step4');
Route::post('store/step4','InstallerController@storeStep4')->name('store.step4');
Route::get('get/step5','InstallerController@getstep5')->name('get.step5');
Route::post('store/step5','InstallerController@storeStep5')->name('store.step5');


  
Route::middleware(['IsInstalled', 'switch_languages' ])->group(function () {

  
      Route::get('/', function () {
        return view('home');
      });

      Auth::routes(['verify' => true]);

      Route::get('/home', 'HomeController@index')->name('home');
 

      Route::prefix('admins')->group(function (){
        Route::get('/', 'AdminController@index')->name('admin.index');
      });
  
  

  Route::middleware(['web', 'auth','is_admin', 'switch_languages', 'optimizeImages'])->group(function () {

    Route::post('/quickupdate/course/{id}','QuickUpdateController@courseQuick')->name('course.quick');
    Route::post('/quickupdate/user/{id}','QuickUpdateController@userQuick')->name('user.udemy');
    Route::post('/quickupdate/slider/{id}','QuickUpdateController@sliderQuick')->name('slider.udemy');
    Route::post('/quickudate/course/{id}','QuickUpdateController@courseabc')->name('course.udemy');
    Route::post('/quickupdate/category/{id}','QuickUpdateController@categoryQuick')->name('category.quick');
    Route::post('/quickupdate/language/{id}','QuickUpdateController@languageQuick')->name('language.quick');
    Route::post('/quickupdate/pag/{id}','QuickUpdateController@pageQuick')->name('page.quick');
    Route::post('/quickupdate/what/{id}','QuickUpdateController@whatQuick')->name('what.quick');
    Route::post('/quickupdate/ansr/{id}','QuickUpdateController@ansrQuick')->name('ansr.quick');
    Route::post('/quickupdate/Chapter/{id}','QuickUpdateController@ChapterQuick')->name('Chapter.quick');
    Route::post('/quickupdate/testimonial/{id}','QuickUpdateController@testimonialQuick')->name('testimonial.quick');
    Route::post('/quickupdate/subcategory/{id}','QuickUpdateController@subcategoryQuick')->name('subcategory.quick');
    Route::post('/quickupdate/childcategory/{id}','QuickUpdateController@childcategoryQuick')->name('childcategory.quick');
    Route::post('/quickupdate/y/{id}','QuickUpdateController@categoryfQuick')->name('categoryf.quick');
    Route::post('/quickupdate/blog_status/{id}','QuickUpdateController@blog_statusQuick')->name('blog.status.quick');
    Route::post('/quickupdate/blog_approved/{id}','QuickUpdateController@blog_approvedQuick')->name('blog.approved.quick');
    Route::post('/quickupdate/status/{id}','QuickUpdateController@reviewstatusQuick')->name('reviewstatus.quick');
    Route::post('/quickupdate/approved/{id}','QuickUpdateController@reviewapprovedQuick')->name('reviewapproved.quick');
    Route::post('/quickupdate/featured/{id}','QuickUpdateController@reviewfeaturedQuick')->name('reviewfeatured.quick');
    Route::post('/quickupdate/faq/{id}','QuickUpdateController@faqQuick')->name('faq.quick');
    Route::post('/quickupdate/faqinstructor/{id}','QuickUpdateController@faqInstructorQuick')->name('faqInstructor.quick');

    Route::post('/quickupdate/order/{id}','QuickUpdateController@orderQuick')->name('order.quick');

    Route::prefix('user')->group(function (){
    Route::get('/','UserController@viewAllUser')->name('user.index');
    Route::get('/adduser','UserController@create')->name('user.add');
    Route::post('/insertuser','UserController@store')->name('user.store');
    Route::get('edit/{id}','UserController@edit')->name('user.edit');
    Route::put('/edit/{id}','UserController@update')->name('user.update');   
    Route::delete('delete/{id}','UserController@destroy')->name('user.delete');
    });

    Route::resource("admin/country","CountryController");
    Route::resource("admin/state","StateController");
    Route::resource("admin/city","CityController");

    Route::resource('page','PageController');
    Route::resource('/testimonial','TestimonialController');
    Route::resource('slider','SliderController');
    Route::resource('trusted','TrustedController');
    

    Route::post('mailsetting/update','SettingController@updateMailSetting')->name('update.mail.set');
    Route::get('settings','SettingController@genreal')->name('gen.set');
    Route::post('setting/store','SettingController@store')->name('setting.store');
    Route::post('setting/seo','SettingController@updateSeo')->name('seo.set');
    Route::post('setting/addcss','SettingController@storeCSS')->name('css.store');
    Route::post('setting/addjs','SettingController@storeJS')->name('js.store');
    Route::post('setting/sociallogin/fb','SettingController@slfb')->name('sl.fb');
    Route::post('setting/sociallogin/gl','SettingController@slgl')->name('sl.gl');
    Route::post('setting/sociallogin/git','SettingController@slgit')->name('sl.git');

    Route::get('/admin/api','ApiController@setApiView')->name('api.setApiView');
    Route::post('admin/api','ApiController@changeEnvKeys')->name('api.update');
    Route::put('/review/update/{id}','ReviewratingController@update')
    ->name('review.update');

    Route::resource('facts', 'SliderfactsController');
    Route::get('coursetext', 'CoursetextController@show');
    Route::put('coursetext/update', 'CoursetextController@update');
    Route::get('getstarted', 'GetstartedController@show');
    Route::put('getstarted/update', 'GetstartedController@update');
    Route::resource('hometext', 'HomeTextController');
    Route::get('terms', 'TermsController@show')->name('termscondition');
    Route::put('termscondition', 'TermsController@update');
    Route::get('policy', 'TermsController@showpolicy')->name('policy');
    Route::put('privacypolicy', 'TermsController@updatepolicy');

    Route::resource('reports','ReportReviewController');
    Route::resource('blog', 'BlogController');
    Route::get('aboutpage', 'AboutController@show')->name('about.page');
    Route::put('aboutupdate', 'AboutController@update');
    Route::get('comingsoon', 'ComingSoonController@show')->name('comingsoon.page');
    Route::put('comingsoonupdate', 'ComingSoonController@update');
    Route::get('careers', 'CareersController@show')->name('careers.page');
    Route::put('careers/update', 'CareersController@update');
    Route::resource('faq','FaqController');
    Route::resource('faqinstructor','FaqInstructorController');
    Route::resource('carts', 'CartController');

    Route::get('currency', 'CurrencyController@show');
    Route::put('currency/update', 'CurrencyController@update');
    
    Route::resource('order', 'OrderController');

    Route::get('widget', 'WidgetController@edit')->name('widget.setting');
    Route::put('widget/update', 'WidgetController@update');
    Route::post('admin/class/{id}/addsubtitle','SubtitleController@post')->name('add.subtitle');
    Route::post('admin/class/{id}/delete/subtitle','SubtitleController@delete')->name('del.subtitle');

    Route::get('frontslider', 'CategorySliderController@show')->name('category.slider');
    Route::put('frontslider/update', 'CategorySliderController@update');

    Route::resource('requestinstructor', 'InstructorRequestController');

    Route::resource('coupon','CouponController');
    Route::get('all/instructor', 'InstructorRequestController@allinstructor')->name('all.instructor');
    Route::get('view/order/admin/{id}', 'OrderController@vieworder')->name('view.order');

    Route::resource('user/course/report','CourseReportController');

    Route::resource('languages', 'LanguageController');
    Route::resource('usermessage', 'ContactUsController');

    Route::get('banktransfer', 'BankTransferController@show');
    Route::put('banktransfer/update', 'BankTransferController@update');

  });

  Route::middleware(['web', 'auth','admin_instructor', 'switch_languages'])->group(function () {

    Route::prefix('user')->group(function (){
      Route::get('edit/{id}','UserController@edit')->name('user.edit');
      Route::put('/edit/{id}','UserController@update')->name('user.update');
    });

    Route::resource('category','CategoriesController');
    Route::get('/category/{slug}','CategoriesController@show')->name('category.show'); 
    Route::resource('subcategory','SubcategoryController');
    Route::resource('childcategory','ChildcategoryController');
    Route::resource('course','CourseController');
    Route::resource('courseinclude','CourseincludeController');
    Route::resource('coursechapter','CoursechapterController');
    Route::resource('whatlearns','WhatlearnsController');
    Route::resource('relatedcourse','RelatedcourseController');
    Route::resource('questionanswer','QuestionanswerController');
    Route::resource('courseanswer', 'AnswerController');
    Route::resource('viewprocess','ViewProcessController');
    Route::resource('courseclass','CourseclassController');
    Route::resource('reviewrating','ReviewratingController');
    Route::resource('announsment','AnnounsmentController');
    Route::get('/course/create/{id}','CourseController@showCourse')->name('course.show');
    Route::post('/category/insert','CategoriesController@categoryStore')->name('cat.store');
    Route::post('/subcategory/insert','SubcategoryController@SubcategoryStore')->name('child.store');
    Route::put('/course/include/{id}','CourseController@testup')->name('corinc.update');
    Route::put('/course/whatlearns/{id}','CourseController@test')->name('what.update');
    Route::put('/course/coursechapter/{id}','CourseController@tes')->name('chapter.update');
    Route::get('send', 'CourseclassController@store')->name('notification');
    Route::resource('courselang','CourseLanguageController');
    Route::get("admin/dropdown","CourseController@upload_info");
    Route::get("admin/gcat","CourseController@gcato");


    Route::get('instructor', 'InstructorController@index')->name('instructor.index');
    Route::resource('userenroll', 'InstructorEnrollController');
    Route::resource('instructorquestion', 'InstructorQuestionController');
    Route::resource('instructoranswer', 'InstructorAnswerController');
    Route::get('coursereview', 'CourseReviewController@index');

  });

  
  
  Route::middleware(['switch_languages'])->group(function () {

    Route::post('rating/show/{id}','ReviewratingController@rating')->name('course.rating');
    Route::post('reports/insert/{id}','ReportReviewController@store')->name('report.review');
    Route::get('/course/show/{id}','CourseController@CourseDetailPage')->name('user.course.show');
    Route::get('all/blog','BlogController@blogpage')->name('blog.all');
    Route::get('about/show','AboutController@aboutpage')->name('about.show');
    Route::get('show/comingsoon','ComingSoonController@comingsoonpage')
    ->name('comingsoon.show');
    Route::get('show/careers','CareersController@careerpage')->name('careers.show');
    Route::get('detail/blog/{id}','BlogController@blogdetailpage')->name('blog.detail');
    Route::get('gotomycourse', 'CourseController@mycoursepage')->name('mycourse.show');

    Route::get('show/help', function(){
    $data = FaqStudent::first();
    $item = FaqInstructor::first();
    return view('front.help.faq',compact('data', 'item')); 
    })->name('help.show');

    Route::post('show/wishlist/{id}','WishlistController@wishlist');
    Route::post('remove/wishlist/{id}','WishlistController@removewishlist');

    Route::get('enroll/show/{id}', 'EnrollmentController@enroll')->name('show.enroll');

    Route::get('show/coursecontent/{id}', 'CourseController@CourseContentPage');

    Route::post('addquestion/{id}','QuestionanswerController@question');
    Route::post('addanswer/{id}','AnswerController@answer');

    Route::get('all/wishlist', 'WishlistController@wishlistpage')->name('wishlist.show');
    Route::post('delete/wishlist/{id}', 'WishlistController@deletewishlist');

    Route::post('addtocart', 'CartController@addtocart')->name('addtocart');

    Route::post('removefromcart/{id}','CartController@removefromcart')
      ->name('remove.item.cart');

    Route::get('all/cart', 'CartController@cartpage')->name('cart.show');

    Route::post('gotocheckout', 'CheckoutController@checkoutpage');
    
    Route::get('notifications/{id}', 'NotificationController@markAsRead')
    ->name('markAsRead');
    Route::get('delete/notifications', 'NotificationController@delete')
    ->name('deleteNotification');

    Route::get('/view', 'DownloadController@getDownload');

    Route::get('/download/{id}', 'DownloadController@getDownload')->name('downloadPdf')->middleware('auth');

    Route::post('review/helpful/{id}', 'ReviewHelpfulController@store')->name('helpful');
    Route::post('review/delete/{id}', 'ReviewHelpfulController@destroy')
    ->name('helpful.delete');

    Route::get('gotocategory/page/{id}', 'CategoriesController@categorypage')->name('category.page');
    Route::get('gotosubcategory/page/{id}', 'CategoriesController@subcategorypage')->name('subcategory.page');
    Route::get('gotochildcategory/page/{id}', 'CategoriesController@childcategorypage')->name('childcategory.page');

    Route::post('apply/instructor', 'InstructorRequestController@instructor')
    ->name('apply.instructor');

    Route::get('search', 'SearchController@index')->name('search');

    Route::get('/user/movie/time/{endtime}/{movie_id}/{user_id}','TimeHistoryController@movie_time');

    Route::get('all/purchase', 'OrderController@purchasehistory')->name('purchase.show');
    Route::get('invoice/show/{id}', 'OrderController@invoice')->name('invoice.show');

    
    Route::get('profile/show/{id}', 'UserProfileController@userprofilepage')->name('profile.show');
    Route::put('/edit/{id}','UserProfileController@userprofile')->name('user.profile');

    Route::post('course/reports/{id}','CourseReportController@store')->name('course.report');

    Route::get('watch/course/{id}', 'WatchController@watch')->name('watchcourse');
    Route::get('watch/courseclass/{id}', 'WatchController@watchclass')->name('watchcourseclass');

    Route::get('language-switch/{local}', 'LanguageSwitchController@languageSwitch')->name('languageSwitch');

    Route::get("country/dropdown","CountryController@upload_info");
    Route::get("country/gcity","CountryController@gcity");

    Route::view('terms_condition', 'terms_condition');
    Route::view('privacy_policy', 'privacy_policy');

    Route::get('detail/faq/{id}','HelpController@faqstudentpage')->name('faq.detail');
    Route::get('faqinstructor/detail/{id}','HelpController@faqinstructorpage')->name('faqinstructor.detail');

    Route::view('user_contact', 'front.contact');
    Route::post('contact/user', 'ContactUsController@usermessage')
    ->name('contact.user');

    Route::get('tabcontent/{id}','TabController@show');

    Route::post('paywithpaypal', 'PaypalController@payWithpaypal')->name('payWithpaypal');
    Route::get('getpaymentstatus', 'PaypalController@getPaymentStatus')->name('status');

    Route::get('event', 'InstaMojoController@index');
    Route::post('pay', 'InstaMojoController@pay');
    Route::get('pay-success', 'InstaMojoController@success');

    Route::get('stripe', 'StripePaymentController@stripe');
    Route::post('paytostripe', 'StripePaymentController@payStripe')->name('stripe.pay');

    Route::get('payment/braintree', 'BraintreeController@get_bt');
    Route::post('payment/braintree', 'BraintreeController@payment');

    Route::get('razorpay', 'RazorpayController@pay')->name('pay');
    Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');

    Route::post('/paywithpaystack', 'PayStackController@redirectToGateway')->name('paywithpaystack');
    Route::get('callback', 'PayStackController@handleGatewayCallback'); 

    Route::post('apply/coupon', 'ApplyCouponController@applycoupon');

    Route::post('removecoupon/{id}','ApplyCouponController@remove')
      ->name('remove.coupon');

    Route::post('/paywithpayment', 'PaytmController@order')->name('paywithpayment');
    Route::post('/payment/status', 'PaytmController@paymentCallback');

    Route::post('process/banktransfer', 'BankTransferController@banktransfer');
    
    Route::get('watchcourse/in/frame/{url}/{course_id}', 'WatchController@view')->name('watchinframe');

  });

});


Route::get("allcountry/dropdown","AllCountryController@upload_info");
Route::get("allcountry/gcity","AllCountryController@gcity");

// Auth Routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

