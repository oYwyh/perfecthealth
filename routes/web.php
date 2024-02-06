<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthConroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\User\UserController;

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\SocialMediaShareController;
use App\Http\Controllers\Admin\Manage\AdminMailController;
use App\Http\Controllers\Admin\Manage\AdminUserController;
use App\Http\Controllers\Admin\Manage\AdminAdminController;
use App\Http\Controllers\Admin\Manage\AdminDoctorController;
use App\Http\Controllers\Admin\Manage\AdminReviewController;
use App\Http\Controllers\Admin\Manage\AdminArticleController;
use App\Http\Controllers\Admin\Manage\AdminPatientController;
use App\Http\Controllers\Admin\Manage\AdminServiceController;
use App\Http\Controllers\Receptionist\ReceptionistController;
use App\Http\Controllers\Admin\Manage\AdminInsuranceController;
use App\Http\Controllers\Doctor\Manage\DoctorArticleController;
use App\Http\Controllers\User\Manage\UserAppointmentController;
use App\Http\Controllers\Admin\Manage\AdminNewsletterController;
use App\Http\Controllers\Admin\Manage\AdminAppointmentController;
use App\Http\Controllers\Admin\Manage\AdminReceptionistController;
use App\Http\Controllers\Doctor\Manage\DoctorAppointmentController;
use App\Http\Controllers\Receptionist\Manage\ReceptionistPatientController;

// use App\Http\Controllers\Admin\Manage\AdminServiceController;


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

Route::middleware(['splade'])->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();
    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();
    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();
    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'homeRed'])->name('homeRed');
    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::get('/test', [HomeController::class, 'test'])->name('test');
    Route::get('/send-code', [MailController::class, 'verify'])->name('send-code');
    Route::view('/code-checker', 'auth.verify')->name('code-checker');
    Route::post('/verify', [AuthConroller::class, 'verify'])->name('verify');
    Route::get('/reset/password', [MailController::class, 'reset_pwd'])->name('reset.password');
    Route::post('/reset/password', [AuthConroller::class, 'reset_pwd'])->name('reset.password.reset');
    Route::view('/reset/password/email', 'auth.password.index')->name('reset.password.email');
    Route::post('/reset/password/email',  [AuthConroller::class, 'get_email'])->name('reset.password.email.post');
    Route::get('/reset/password/{token}', [AuthConroller::class, 'get_token'])->name('reset.password.req');
    Route::get('social-share', [SocialMediaShareController::class, 'index']);
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::post('/back', [GlobalController::class, 'back'])->name('back');


    // Localization Routes
    Route::get('locale/{lang}',[LocalizationController::class,'setLang'])->name('setLang');
    Route::middleware(['guest:web','PreventBackHistory'])->group(function() {
        Route::prefix('auth')->name('auth.')->group(function() {
            Route::post('/', [AuthConroller::class, 'auth'])->name('index');
            Route::post('/need', [AuthConroller::class, 'need'])->name('need');
            Route::post('/logout', [AuthConroller::class, 'logout'])->name('logout');
                Route::prefix('google')->name('google.')->group(function() {
                    Route::get('/', [AuthConroller::class, 'google'])->name('index');
                    Route::get('/redirect', [AuthConroller::class, 'googleRedirect'])->name('redirect');
                });
                Route::prefix('facebook')->name('facebook.')->group(function() {
                    Route::get('/', [AuthConroller::class, 'facebook'])->name('index');
                    Route::get('/redirect', [AuthConroller::class, 'facebookRedirect'])->name('redirect');
                });
        });
    });
    Route::prefix('newsletter')->name('newsletter.')->group(function(){
        Route::post('/subscribe',[NewsletterController::class,'subscribe'])->name('subscribe');
    });
    Route::prefix('reviews')->name('reviews.')->group(function(){
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::post('/post', [ReviewController::class, 'post'])->name('post');
    });
    Route::prefix('articles')->name('articles.')->group(function(){
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::get('/{article}',[ArticleController::class,'show'])->name('show');
    });
    Route::prefix('info')->name('info.')->group(function(){
        Route::get('/', [InfoController::class, 'index'])->name('index');
    });
    Route::prefix('patient')->name('patient.')->group(function(){
        Route::middleware(['auth:receptionist,admin','PreventBackHistory'])->group(function(){
            Route::post('/createIn',[PatientController::class,'createIn'])->name('createIn');
            Route::post('/createOut',[PatientController::class,'createOut'])->name('createOut');
            Route::post('/update',[PatientController::class,'update'])->name('update');
            Route::post('/delete',[PatientController::class,'delete'])->name('delete');
        });
    });
    Route::prefix('user')->name('user.')->group(function(){
        Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
                Route::view('/login','dashboard.user.auth.login')->name('login');
                Route::view('/register','dashboard.user.auth.register')->name('register');
                Route::post('/create',[UserController::class,'create'])->name('create');
                Route::post('/check',[UserController::class,'check'])->name('check');
        });

        Route::middleware(['auth:web','PreventBackHistory'])->group(function(){
                Route::get('/home',[UserController::class,'index'])->name('home');
                Route::post('/logout',[UserController::class,'logout'])->name('logout');
                Route::get('/file',[UserController::class,'file'])->name('file');
                Route::post('/investigation',[UserController::class,'investigation'])->name('investigation');
                Route::post('/insurance',[UserController::class,'insurance'])->name('insurance');
                // Route::get('/add-new',[UserController::class,'add'])->name('add');
                Route::prefix('profile')->name('profile.')->group(function() {
                    Route::get('/',[UserController::class,'profile'])->name('index');
                    Route::post('/profile-update',[UserController::class,'profile_update'])->name('profile-update');
                    Route::post('/personal-update',[UserController::class,'personal_update'])->name('personal-update');
                    Route::post('/medical-update',[UserController::class,'medical_update'])->name('medical-update');
                    Route::post('/pwd-update',[UserController::class,'pwd_update'])->name('pwd-update');
                    Route::post('/delete-profile',[UserController::class,'delete_profile'])->name('delete-profile');
                });
                Route::prefix('manage')->name('manage.')->group(function() {
                    Route::prefix('appointments')->name('appointments.')->group(function() {
                        Route::get('/',[UserAppointmentController::class,'index'])->name('index');
                        Route::get('/search',[UserAppointmentController::class,'search'])->name('search');
                        Route::post('/getSpecialty',[UserAppointmentController::class,'getSpecialty'])->name('getSpecialty');
                        Route::post('/getDoctors',[UserAppointmentController::class,'getDoctors'])->name('getDoctors');
                        Route::get('/doctors',[UserAppointmentController::class,'doctors'])->name('doctors');
                        Route::get('/doctor',[UserAppointmentController::class,'doctor'])->name('doctor');
                        Route::post('/book',[UserAppointmentController::class,'book'])->name('book');
                        Route::post('/cancle',[UserAppointmentController::class,'cancle'])->name('cancle');
                        Route::get('/results',[UserAppointmentController::class,'results'])->name('results');
                        Route::get('/externalBook',[UserAppointmentController::class,'externalBook'])->name('externalBook');
                        // Route::get('/timeChecker',[UserAppointmentController::class,'timeChecker'])->name('timeChecker');
                        // Route::post('/create',[UserAppointmentController::class,'createAppointment'])->name('create');
                        // Route::post('/getTime',[UserAppointmentController::class,'getTime'])->name('getTime');
                    });
                });
        });
    });
    Route::prefix('receptionist')->name('receptionist.')->group(function(){
        Route::middleware(['auth:receptionist','PreventBackHistory'])->group(function(){
            Route::get('/home',[ReceptionistController::class,'home'])->name('home');
            Route::prefix('profile')->name('profile.')->group(function() {
                Route::get('/',[ReceptionistController::class,'profile'])->name('index');
                Route::post('/profile-update',[ReceptionistController::class,'profile_update'])->name('profile-update');
                Route::post('/personal-update',[ReceptionistController::class,'personal_update'])->name('personal-update');
                Route::post('/work-update',[ReceptionistController::class,'work_update'])->name('work-update');
                Route::post('/medical-update',[ReceptionistController::class,'medical_update'])->name('medical-update');
                Route::post('/pwd-update',[ReceptionistController::class,'pwd_update'])->name('pwd-update');
                Route::post('/delete-profile',[ReceptionistController::class,'delete_profile'])->name('delete-profile');
            });
            Route::prefix('manage')->name('manage.')->group(function() {
                Route::prefix('patients')->name('patients.')->group(function() {
                    Route::get('/',[ReceptionistPatientController::class,'index'])->name('index');
                    Route::get('/add',[ReceptionistPatientController::class,'add'])->name('add');
                    Route::get('/edit',[ReceptionistPatientController::class,'edit'])->name('edit');
                    Route::get('/form',[ReceptionistPatientController::class,'form'])->name('form');
                    Route::get('/info',[ReceptionistPatientController::class,'info'])->name('info');
                });
            });
        });
    });
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
            Route::view('/login','dashboard.admin.login')->name('login');
            Route::post('/check',[AdminController::class,'check'])->name('check');
        });
        Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
            Route::get('/chart',[AdminController::class,'chart'])->name('chart');
            Route::post('/total_date',[AdminController::class,'total_date'])->name('total_date');
            Route::post('/doctors_date',[AdminController::class,'doctors_date'])->name('doctors_date');
            Route::post('/doctors_reset',[AdminController::class,'doctors_reset'])->name('doctors_reset');
            Route::post('/receptionists_date',[AdminController::class,'receptionists_date'])->name('receptionists_date');
            Route::post('/receptionists_reset',[AdminController::class,'receptionists_reset'])->name('receptionists_reset');
            Route::post('/total_reset',[AdminController::class,'total_reset'])->name('total_reset');
            Route::get('/home',[AdminController::class,'home'])->name('home');
            Route::post('/logout',[AdminController::class,'logout'])->name('logout');
            Route::get('/doctors',[AdminController::class,'doctors'])->name('doctors');
            Route::get('/patients',[AdminController::class,'patients'])->name('patients');
            Route::prefix('manage')->name('manage.')->group(function() {
                Route::prefix('admins')->name('admins.')->group(function() {
                    Route::get('/',[AdminAdminController::class,'index'])->name('index');
                    Route::post('/delete',[AdminAdminController::class,'delete'])->name('delete');
                    Route::post('/update',[AdminAdminController::class,'update'])->name('update');
                    Route::get('/edit',[AdminAdminController::class,'edit'])->name('edit');
                    Route::get('/add',[AdminAdminController::class,'add'])->name('add');
                    Route::post('/register',[AdminAdminController::class,'register'])->name('register');
                    Route::get('/control',[AdminAdminController::class,'control'])->name('control');
                    Route::post('/super',[AdminAdminController::class,'super'])->name('super');
                    Route::post('/profile-update',[AdminAdminController::class,'profile_update'])->name('profile-update');
                    Route::post('/personal-update',[AdminAdminController::class,'personal_update'])->name('personal-update');
                    Route::post('/social-update',[AdminAdminController::class,'social_update'])->name('social-update');
                    Route::post('/pwd-update',[AdminAdminController::class,'pwd_update'])->name('pwd-update');
                    Route::post('/job-update',[AdminAdminController::class,'job_update'])->name('job-update');
                    Route::post('/delete-profile',[AdminAdminController::class,'delete_profile'])->name('delete-profile');
                });
                Route::prefix('doctors')->name('doctors.')->group(function() {
                    Route::get('/',[AdminDoctorController::class,'index'])->name('index');
                    Route::get('/control',[AdminDoctorController::class,'control'])->name('control');
                    Route::post('/delete',[AdminDoctorController::class,'delete'])->name('delete');
                    Route::post('/update',[AdminDoctorController::class,'update'])->name('update');
                    Route::get('/edit',[AdminDoctorController::class,'edit'])->name('edit');
                    Route::get('/add',[AdminDoctorController::class,'add'])->name('add');
                    Route::post('/register',[AdminDoctorController::class,'register'])->name('register');
                    Route::post('/profile-update',[AdminDoctorController::class,'profile_update'])->name('profile-update');
                    Route::post('/personal-update',[AdminDoctorController::class,'personal_update'])->name('personal-update');
                    Route::post('/social-update',[AdminDoctorController::class,'social_update'])->name('social-update');
                    Route::post('/pwd-update',[AdminDoctorController::class,'pwd_update'])->name('pwd-update');
                    Route::post('/job-update',[AdminDoctorController::class,'job_update'])->name('job-update');
                    Route::post('/delete-profile',[AdminDoctorController::class,'delete_profile'])->name('delete-profile');
                });
                Route::prefix('users')->name('users.')->group(function() {
                    Route::get('/',[AdminUserController::class,'index'])->name('index');
                    Route::post('/delete',[AdminUserController::class,'delete'])->name('delete');
                    Route::post('/update',[AdminUserController::class,'update'])->name('update');
                    Route::get('/edit',[AdminUserController::class,'edit'])->name('edit');
                    Route::get('/add',[AdminUserController::class,'add'])->name('add');
                    Route::post('/register',[AdminUserController::class,'register'])->name('register');
                    Route::get('/control',[AdminUserController::class,'control'])->name('control');
                    Route::post('/profile-update',[AdminUserController::class,'profile_update'])->name('profile-update');
                    Route::post('/personal-update',[AdminUserController::class,'personal_update'])->name('personal-update');
                    Route::post('/social-update',[AdminUserController::class,'social_update'])->name('social-update');
                    Route::post('/medical-update',[AdminUserController::class,'medical_update'])->name('medical-update');
                    Route::post('/pwd-update',[AdminUserController::class,'pwd_update'])->name('pwd-update');
                    Route::post('/job-update',[AdminUserController::class,'job_update'])->name('job-update');
                    Route::post('/delete-profile',[AdminUserController::class,'delete_profile'])->name('delete-profile');
                });
                Route::prefix('patients')->name('patients.')->group(function() {
                    Route::get('/',[AdminPatientController::class,'index'])->name('index');
                    Route::get('/add',[AdminPatientController::class,'add'])->name('add');
                    Route::get('/edit',[AdminPatientController::class,'edit'])->name('edit');
                    Route::get('/form',[AdminPatientController::class,'form'])->name('form');
                    Route::get('/info',[AdminPatientController::class,'info'])->name('info');
                });

                Route::prefix('receptionists')->name('receptionists.')->group(function() {
                    Route::get('/',[AdminReceptionistController::class,'index'])->name('index');
                    Route::get('/control',[AdminReceptionistController::class,'control'])->name('control');
                    Route::get('/edit',[AdminReceptionistController::class,'edit'])->name('edit');
                    Route::get('/add',[AdminReceptionistController::class,'add'])->name('add');
                    Route::post('/register',[AdminReceptionistController::class,'register'])->name('register');
                    Route::post('/delete',[AdminReceptionistController::class,'delete'])->name('delete');
                    Route::post('/update',[AdminReceptionistController::class,'update'])->name('update');
                    Route::post('/profile-update',[AdminReceptionistController::class,'profile_update'])->name('profile-update');
                    Route::post('/personal-update',[AdminReceptionistController::class,'personal_update'])->name('personal-update');
                    Route::post('/social-update',[AdminReceptionistController::class,'social_update'])->name('social-update');
                    Route::post('/pwd-update',[AdminReceptionistController::class,'pwd_update'])->name('pwd-update');
                    Route::post('/job-update',[AdminReceptionistController::class,'job_update'])->name('job-update');
                    Route::post('/delete-profile',[AdminReceptionistController::class,'delete_profile'])->name('delete-profile');
                });
                Route::prefix('articles')->name('articles.')->group(function() {
                    Route::get('/',[AdminArticleController::class,'index'])->name('index');
                    Route::post('/delete',[AdminArticleController::class,'delete'])->name('delete');
                    Route::post('/update',[AdminArticleController::class,'update'])->name('update');
                    Route::get('/edit',[AdminArticleController::class,'edit'])->name('edit');
                    Route::get('/add',[AdminArticleController::class,'add'])->name('add');
                    Route::get('/translator',[AdminArticleController::class,'translator'])->name('translator');
                    Route::post('/translate',[AdminArticleController::class,'translate'])->name('translate');
                    Route::post('/create',[AdminArticleController::class,'create'])->name('create');
                    Route::post('/verify',[AdminArticleController::class,'verify'])->name('verify');
                    Route::post('/disprove',[AdminArticleController::class,'disprove'])->name('disprove');
                });
                Route::prefix('services')->name('services.')->group(function() {
                    Route::get('/',[AdminServiceController::class,'index'])->name('index');
                    Route::post('/delete',[AdminServiceController::class,'delete'])->name('delete');
                    Route::post('/update',[AdminServiceController::class,'update'])->name('update');
                    Route::get('/edit',[AdminServiceController::class,'edit'])->name('edit');
                    Route::get('/add',[AdminServiceController::class,'add'])->name('add');
                    Route::get('/translator',[AdminServiceController::class,'translator'])->name('translator');
                    Route::post('/translate',[AdminServiceController::class,'translate'])->name('translate');
                    Route::post('/create',[AdminServiceController::class,'create'])->name('create');
                    Route::post('/verify',[AdminServiceController::class,'verify'])->name('verify');
                    Route::post('/disprove',[AdminServiceController::class,'disprove'])->name('disprove');
                });
                Route::prefix('insurances')->name('insurances.')->group(function() {
                    Route::get('/',[AdminInsuranceController::class,'index'])->name('index');
                    Route::post('/delete',[AdminInsuranceController::class,'delete'])->name('delete');
                    Route::post('/update',[AdminInsuranceController::class,'update'])->name('update');
                    Route::get('/edit',[AdminInsuranceController::class,'edit'])->name('edit');
                    Route::get('/add',[AdminInsuranceController::class,'add'])->name('add');
                    Route::get('/translator',[AdminInsuranceController::class,'translator'])->name('translator');
                    Route::post('/translate',[AdminInsuranceController::class,'translate'])->name('translate');
                    Route::post('/create',[AdminInsuranceController::class,'create'])->name('create');
                    Route::post('/verify',[AdminInsuranceController::class,'verify'])->name('verify');
                    Route::post('/disprove',[AdminInsuranceController::class,'disprove'])->name('disprove');
                });
                Route::prefix('newsletter')->name('newsletter.')->group(function() {
                    Route::get('/',[AdminNewsletterController::class,'index'])->name('index');
                    Route::post('/remove',[AdminNewsletterController::class,'remove'])->name('remove');
                });
                Route::prefix('reviews')->name('reviews.')->group(function() {
                    Route::get('/',[AdminReviewController::class,'index'])->name('index');
                    Route::get('/add',[AdminReviewController::class,'add'])->name('add');
                    Route::post('/create',[AdminReviewController::class,'create'])->name('create');
                    Route::get('verify-form',[AdminReviewController::class,'verify_form'])->name('verify-form');
                    Route::get('verify',[AdminReviewController::class,'verify'])->name('verify');
                    Route::post('/delete',[AdminReviewController::class,'delete'])->name('delete');
                    Route::post('/disprove',[AdminReviewController::class,'disprove'])->name('disprove');
                });
                Route::prefix('appointments')->name('appointments.')->group(function() {
                    Route::get('/',[AdminAppointmentController::class,'index'])->name('index');
                    Route::get('/delete',[AdminAppointmentController::class,'delete'])->name('delete');
                    Route::get('/results',[AdminAppointmentController::class,'results'])->name('results');
                });
                Route::prefix('mails')->name('mails.')->group(function() {
                    Route::get('/',[AdminMailController::class,'index'])->name('index');
                    Route::get('/confirm',[AdminMailController::class,'confirm'])->name('confirm');
                    Route::get('/remove',[AdminMailController::class,'remove'])->name('remove');
                    Route::get('/add',[AdminMailController::class,'add'])->name('add');
                    Route::get('/send',[MailController::class,'mail_send'])->name('send');
                    Route::post('/create',[AdminMailController::class,'create'])->name('create');
                    Route::post('/send_mail',[AdminMailController::class,'send'])->name('send_mail');
                });
            });
            Route::prefix('profile')->name('profile.')->group(function() {
                Route::get('/',[AdminController::class,'profile'])->name('index');
                Route::post('/profile-update',[AdminController::class,'profile_update'])->name('profile-update');
                Route::post('/personal-update',[AdminController::class,'personal_update'])->name('personal-update');
                Route::post('/social-update',[AdminController::class,'social_update'])->name('social-update');
                Route::post('/pwd-update',[AdminController::class,'pwd_update'])->name('pwd-update');
                Route::post('/delete-profile',[AdminController::class,'delete_profile'])->name('delete-profile');
            });
        });
    });
    Route::prefix('doctor')->name('doctor.')->group(function(){
        Route::middleware(['guest:doctor','PreventBackHistory'])->group(function(){
            Route::view('/login','dashboard.doctor.auth.login')->name('login');
            // Route::view('/register','dashboard.doctor.auth.register')->name('register');
            Route::get('/register',[DoctorController::class,'register'])->name('register');
            Route::post('/create',[DoctorController::class,'create'])->name('create');
            Route::post('/check',[DoctorController::class,'check'])->name('check');
        });
        Route::middleware(['auth:doctor','PreventBackHistory'])->group(function(){
            Route::get('/home',[DoctorController::class, 'index'])->name('home');
            Route::post('logout',[DoctorController::class,'logout'])->name('logout');
            Route::post('/chart_date', [DoctorController::class,'chart_date'])->name('chart_date');
            Route::post('/chart_reset', [DoctorController::class,'chart_reset'])->name('chart_reset');
            Route::prefix('profile')->name('profile.')->group(function() {
                Route::get('/',[DoctorController::class,'profile'])->name('index');
                Route::post('/profile-update',[DoctorController::class,'profile_update'])->name('profile-update');
                Route::post('/personal-update',[DoctorController::class,'personal_update'])->name('personal-update');
                Route::post('/social-update',[DoctorController::class,'social_update'])->name('social-update');
                Route::post('/job-update',[DoctorController::class,'job_update'])->name('job-update');
                Route::post('/pwd-update',[DoctorController::class,'pwd_update'])->name('pwd-update');
                Route::post('/delete-profile',[DoctorController::class,'delete_profile'])->name('delete-profile');
            });
            Route::prefix('manage')->name('manage.')->group(function() {
                Route::prefix('patient')->name('patient.')->group(function() {
                    Route::get('/info',[DoctorAppointmentController::class,'patient_info'])->name('info');
                });
                Route::prefix('appointments')->name('appointments.')->group(function() {
                    Route::get('/',[DoctorAppointmentController::class,'index'])->name('index');
                    Route::get('/info',[DoctorAppointmentController::class,'info'])->name('info');
                    Route::get('/results',[DoctorAppointmentController::class,'results'])->name('results');
                    Route::post('/saveinfo',[DoctorAppointmentController::class,'saveInfo'])->name('saveInfo');
                    Route::get('/laboratory',[DoctorAppointmentController::class,'laboratory'])->name('laboratory');
                    Route::get('/radiology',[DoctorAppointmentController::class,'radiology'])->name('radiology');
                    Route::get('/medicine',[DoctorAppointmentController::class,'medicine'])->name('medicine');
                    Route::get('/prescription',[DoctorAppointmentController::class,'prescription'])->name('prescription');
                    Route::post('/cancle',[DoctorAppointmentController::class,'cancle'])->name('cancle');
                    Route::post('/save-image', [DoctorAppointmentController::class,'saveImage'])->name('save-image');
                    Route::get('/save', [DoctorAppointmentController::class,'save'])->name('save');
                    Route::post('/app_box_date', [DoctorAppointmentController::class,'app_box_date'])->name('app_box_date');
                    Route::post('/app_box_reset', [DoctorAppointmentController::class,'app_box_reset'])->name('app_box_reset');
                    Route::post('/back', [DoctorAppointmentController::class,'back'])->name('back');
                });
                Route::prefix('articles')->name('articles.')->group(function() {
                    Route::get('/',[DoctorArticleController::class,'index'])->name('index');
                    Route::post('/delete',[DoctorArticleController::class,'delete'])->name('delete');
                    Route::post('/update',[DoctorArticleController::class,'update'])->name('update');
                    Route::get('/edit',[DoctorArticleController::class,'edit'])->name('edit');
                    Route::get('/add',[DoctorArticleController::class,'add'])->name('add');
                    Route::post('/create',[DoctorArticleController::class,'create'])->name('create');
                });
            });
        });
    });
});
Route::get('chart',[AdminController::class, 'chart']);
