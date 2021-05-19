<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\SuperLoginController;
use App\Http\Controllers\BCMSController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CrashController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SeeNebController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SuperHomeController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index', ['title'=>'pfs-index']);
// });
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/about', [IndexController::class, 'aboutUs'])->name('about');
Route::get('/see', [IndexController::class, 'questions'])->name('see-neb-content');
Route::get('/crash/{id}', [IndexController::class, 'getCrash'])->name('getCrash');
Route::get('/course/{id}', [IndexController::class, 'getCrashCourse'])->name('getCrashCourse');
Route::get('/course/next/{crash_id}/{course_id}', [IndexController::class, 'nextPage'])->name('nextPage');
Route::get('/course/previous/{crash_id}/{course_id}', [IndexController::class, 'previousPage'])->name('previousPage');
Route::prefix('/questions')->group(function(){
	Route::get('/', [IndexController::class, 'getQuestionAnswer'])->name('user.question.index');
	Route::get('/ask', [QuestionController::class, 'create'])->name('user.ask');
	Route::post('/ask', [QuestionController::class, 'store'])->name('user.ask.post');
	Route::post('/answer', [AnswerController::class, 'store'])->name('user.answer.store');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('super')->group(function(){
	Route::resource('/admin', AdminController::class);
	Route::get('/admin/trash/list', [AdminController::class, 'trash'])->name('admin.trash');
	Route::post('/admin/trash/list/{admin}', [AdminController::class, 'restore'])->name('admin.restore');
	Route::delete('/admin/trash/{admin}', [AdminController::class, 'delete'])->name('admin.delete');
	Route::prefix('university')->group(function(){
		Route::get('/trash/list', [UniversityController::class, 'trash'])->name('university.trash');
	    Route::post('/trash/{university}', [UniversityController::class, 'restore'])->name('university.restore');
	    Route::delete('/trash/{university}', [UniversityController::class, 'delete'])->name('university.delete');
	});
	Route::resource('/level', LevelController::class);
	Route::get('{level}/program', [LevelController::class, 'getProgram'])->name('level.getProgram');
	Route::delete('{id}/program', [LevelController::class, 'destroyProgram'])->name('level.destroyProgram');
	Route::post('{level}/program', [LevelController::class, 'postProgram'])->name('level.postProgram');
	Route::prefix('level')->group(function(){
		Route::get('/subject/{id?}', [SubjectController::class, 'getSubProgram'])->name('level.getSubProgram');
		Route::post('/subject/{id?}', [SubjectController::class, 'postSubProgram'])->name('level.postSubProgram');
		Route::delete('/subject/{id?}', [SubjectController::class, 'deleteSubProgram'])->name('level.destroySubject');
		Route::post('/subject/see-neb/{id?}', [SubjectController::class, 'postNebOrSeeSubProgram'])->name('level.postNebOrSeeSubProgram');
		Route::delete('/subject/see-neb/{id?}', [SubjectController::class, 'deleteSubjectSeeorNeb'])->name('level.destroySeeOrNebSubject');
		Route::post('/subject/admin/assign', [SubjectController::class, 'postAssignSubject'])->name('level.postAssignSubject');
		Route::post('/subject/admin/assign/seeOrNeb', [SubjectController::class, 'postAssignSeeOrNebSubject'])->name('level.postAssignSeeOrNebSubject');
	});
	Route::resource('/crash', CrashController::class);
	Route::post('/crash/assign/crash', [CrashController::class, 'assign'])->name('crash.assign');
	// here must be created for search
	Route::resource('/faculty', FacultyController::class);
	// here must be created for trash as well as search
	Route::resource('/university', UniversityController::class);
		// here must be created for trash as well as search
	Route::resource('/subject', SubjectController::class);
		// here must be created for trash as well as search
	Route::resource('/program', ProgramController::class);
	Route::get('/', [SuperHomeController::class, 'index'])->name('super');
	Route::resource('/admin', AdminController::class);
	Route::get('/login', [SuperLoginController::class, 'showLoginForm'])->name('super.login');
    Route::post('/login', [SuperLoginController::class, 'login'])->name('super-login');
    Route::post('/logout', [SuperLoginController::class, 'logout'])->name('super.logout');   
});
Route::prefix('admin')->group(function(){
	Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin-login');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin');
    // Route::get('/SEEorNEB', [SeeNebController::class, 'index'])->name('SEEorNEB.index');
    Route::resource('/SEEorNEB', SeeNebController::class);
    Route::get('/SEEorNEB/search', [SeeNebController::class, 'show'])->name('live.search1');
    Route::get('/SEEorNEB/search/NEB/GuessPaper', [SeeNebController::class, 'search2'])->name('live.search2');
    Route::prefix('/content')->group(function(){
    	Route::get('/', [BCMSController::class, 'index'])->name('BCorMS.index');
    	Route::get('/upload/{id}', [BCMSController::class, 'show'])->name('BCorMS.upload');
    	Route::get('/upload/list/{mode}', [BCMSController::class, 'list'])->name('BCorMS.list');
    	Route::get('/upload/list/search/qu/no/gu', [BCMSController::class, 'searchContents'])->name('BCorMS.list.search');
    	Route::post('/', [BCMSController::class, 'store'])->name('BCorMS.store');
    	Route::delete('/{content}', [BCMSController::class, 'destroy'])->name('BCorMS.destroy');
    	Route::get('/search', [BCMSController::class, 'search'])->name('BCorMS.search');
    	Route::get('/course/{id}', [CourseController::class, 'index'])->name('admin.course');
    	Route::get('/course/add/{id}', [CourseController::class, 'getAdd'])->name('admin.course.getAdd');
    	Route::post('/course/add/{id}', [CourseController::class, 'postAdd'])->name('admin.course.postAdd');
    	Route::post('/course/publish/{id}', [CourseController::class, 'publish'])->name('admin.course.publish');
    	Route::post('/course/revert/{id}', [CourseController::class, 'revert'])->name('admin.course.revert');
    	Route::get('/course/read/{id}', [CourseController::class, 'read'])->name('admin.course.content.read');
    	Route::get('/course/edit/{id}', [CourseController::class, 'edit'])->name('admin.course.content.edit');
    	Route::patch('/course/edit/{id}', [CourseController::class, 'editPost'])->name('admin.course.content.editPost');
    	Route::get('/course/all/{id}', [CourseController::class, 'getAll'])->name('admin.course.getAll');
    });

});