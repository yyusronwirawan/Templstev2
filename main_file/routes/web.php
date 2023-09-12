<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestDomainController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Features\UserImpersonation;

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

Route::get('/test-mail', [SettingsController::class, 'testMail'])->name('test.mail')->middleware(['auth','xss']);

Route::group(['middleware' => ['Setting', 'xss']], function () {
    Auth::routes();

    Route::get('/', [RequestDomainController::class, 'landingPage'])->name('landingpage');
    Route::get('contact-us', [RequestDomainController::class, 'contactus'])->name('contactus');
    Route::get('terms-conditions', [RequestDomainController::class, 'termsandconditions'])->name('termsandconditions');
    Route::get('privacy-policy', [RequestDomainController::class, 'privacypolicy'])->name('privacypolicy');
    Route::post('contact_mail', [RequestDomainController::class, 'contact_mail'])->name('contact.mail');
    Route::get('faq', [RequestDomainController::class, 'faq'])->name('faq');
    Route::get('/request-domain/create/{id}', [RequestDomainController::class, 'create'])->name('requestdomain.create');
    Route::post('/request-domain', [RequestDomainController::class, 'store'])->name('requestdomain.store');
    Route::get('/pre-payment-success/{id}', [RequestDomainController::class, 'prepaymentSuccess'])->name('pre.stripe.success.pay');
    Route::get('/pre-payment-cancel/{id}', [RequestDomainController::class, 'prepaymentCancel'])->name('pre.stripe.cancel.pay');

    Route::post('pre-stripe', [RequestDomainController::class, 'prestripeSession'])->name('pre.stripe.session');

    Route::post('get-category-blog', [RequestDomainController::class, 'get_category_post'])->name('get.category.post');
    Route::get('blog-detail/{slug}', [RequestDomainController::class, 'post_details'])->name('post.details');
    Route::get('view-blog', [PostsController::class, 'all_post'])->name('view.post');
});


Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::group(['middleware' => ['auth', 'Setting', 'xss', '2fa']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/chart', [HomeController::class, 'chart'])->name('get.chart.data');

    Route::resource('roles', RoleController::class);
    Route::post('/role-permission/{id}', [RoleController::class, 'assignPermission'])->name('roles_permit');
    Route::resource('users', UserController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('blogs', PostsController::class);
    Route::resource('category', CategoryController::class);
    Route::post('user/update', [RequestDomainController::class, 'update'])->name('create.user');


    Route::get('/request-domain', [RequestDomainController::class, 'index'])->name('requestdomain.index');
    Route::delete('/request-domain/{id}/delete', [RequestDomainController::class, 'destroy'])->name('requestdomain.destroy');
    Route::post('/request-domain/{id}/update', [RequestDomainController::class, 'data_update'])->name('requestdomain.update');
    Route::get('/request-domain/{id}/edit', [RequestDomainController::class, 'edit'])->name('requestdomain.edit');
    Route::get('/request-domain/approve/{id}', [RequestDomainController::class, 'approvestatus'])->name('approverequestdomain.status');
    Route::post('/request-domain/disapprove/{id}', [RequestDomainController::class, 'disapprove'])->name('requestdomain.disapprove');
    Route::get('/request-domain/disapprove/{id}', [RequestDomainController::class, 'disapprovestatus'])->name('requestdomain.disapprovestatus');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('settings/app-name/update', [SettingsController::class, 'appNameUpdate'])->name('settings/app-name/update');
    Route::post('settings/app-logo/update', [SettingsController::class, 'appNameUpdate'])->name('settings/app-name/update');
    Route::post('settings/pusher-setting/update', [SettingsController::class, 'pusherSettingUpdate'])->name('settings/pusher-setting/update');
    Route::post('settings/s3-setting/update', [SettingsController::class, 's3SettingUpdate'])->name('settings/s3-setting/update');
    Route::post('settings/email-setting/update', [SettingsController::class, 'emailSettingUpdate'])->name('settings/email-setting/update');
    Route::post('settings/stripe-setting/update', [SettingsController::class, 'paymentSettingUpdate'])->name('settings/stripe-setting/update');
    Route::post('settings/auth-settings/update', [SettingsController::class, 'authSettingsUpdate'])->name('settings/auth-settings/update');
    Route::post('test-mail', [SettingsController::class, 'testSendMail'])->name('test.send.mail');
    Route::post('approve-mail', [RequestDomainController::class, 'approveSendMail'])->name('approve.send.mail');
    Route::get('users/{id}/impersonate', [UserController::class, 'impersonate'])->name('users.impersonate');
    Route::get('landing-page', [SettingsController::class, 'landingPage'])->name('landing.page');

    Route::get('account-status/{id}', [UserController::class, 'accountStatus'])->name('account.status');
    Route::get('profile-status', [ProfileController::class, 'profileStatus'])->name('profile.status');
    Route::delete('/profile-destroy/{id}/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

    Route::post('ckeditor/upload', [SettingsController::class, 'upload'])->name('ckeditor.upload');
    Route::get('setting/{id}', [SettingsController::class, 'loadsetting'])->name('setting');

    Route::group(['prefix' => '2fa'], function () {
        Route::get('/', [LoginSecurityController::class, 'show2faForm']);
        Route::post('/generateSecret', [LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
        Route::post('/enable2fa', [LoginSecurityController::class, 'enable2fa'])->name('enable2fa');
        Route::post('/disable2fa', [LoginSecurityController::class, 'disable2fa'])->name('disable2fa');

        Route::post('/2faVerify', function () {
            return redirect(URL()->previous());
        })->name('2faVerify')->middleware('2fa');
    });

    Route::get('update-avatar/{id}', [ProfileController::class, 'showAvatar'])->name('update-avatar');
    Route::get('design/{id}', [ProfileController::class, 'design'])->name('forms.design');
    Route::post('update-profile-login/{id}', [ProfileController::class, 'updateLogin'])->name('update-login');
    Route::post('/verify-2fa', [ProfileController::class, 'verify'])->name('verify-2fa');
    Route::post('/activate-2fa', [ProfileController::class, 'activate'])->name('activate-2fa');
    Route::post('/enable-2fa', [ProfileController::class, 'enable'])->name('enable-2fa');
    Route::post('/disable-2fa', [ProfileController::class, 'disable'])->name('disable-2fa');
    Route::get('/2fa/instruction', [ProfileController::class, 'instruction']);

    Route::get('change-language/{lang}', [LanguageController::class, 'changeLanquage'])->name('change.language');
    Route::get('manage-language/{lang}', [LanguageController::class, 'manageLanguage'])->name('manage.language');
    Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->name('store.language.data');
    Route::get('create-language', [LanguageController::class, 'createLanguage'])->name('create.language');
    Route::post('store-language', [LanguageController::class, 'storeLanguage'])->name('store.language');
    Route::delete('/lang/{lang}', [LanguageController::class, 'destroyLang'])->name('lang.destroy');
    Route::get('language', [LanguageController::class, 'index'])->name('index');
    Route::get('stripe', [PaymentController::class, 'stripe'])->name('stripe.pay');
    // Route::post('stripe', [PaymentController::class, 'stripePost'])->name('stripe.post');
    Route::post('stripe', [PaymentController::class, 'stripeSession'])->name('stripe.session');
    Route::post('/payment-pedning', [PaymentController::class, 'paymentPending'])->name('stripe.pending.pay');
    Route::get('/payment-success/{id}', [PaymentController::class, 'paymentSuccess'])->name('stripe.success.pay');
    Route::get('/payment-cancel/{id}', [PaymentController::class, 'paymentCancel'])->name('stripe.cancel.pay');

    Route::get('sales', [HomeController::class, 'sales'])->name('sales.index');
});
Route::post('landing-page/store', [SettingsController::class, 'landingPagestore'])->name('landing.page.store')->middleware(['auth', 'Setting']);
Route::get('/impersonate/{token}', function ($token) {
    return UserImpersonation::makeResponse($token);
});
