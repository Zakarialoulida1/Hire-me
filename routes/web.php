<?php
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\Formcontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Newslettercontroller;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/subscribe',[Newslettercontroller::class,'subscribe'])->name('subscribe');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home',[\App\Http\Controllers\Homecontroller::class,'index']);
Route::middleware('auth')->group(function () {
  
   

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  
  
  Route::post('/company/store', [\App\Http\Controllers\Companycontroller::class, 'store'])->name('store.company');
  Route::get('/company', [\App\Http\Controllers\Companycontroller::class, 'index'])->name('formcompany');
  Route::get('/company/show', [\App\Http\Controllers\Companycontroller::class, 'show'])->name('show.company');
  Route::get('/searchCompanies', [App\Http\Controllers\Companycontroller::class, 'searchCompanies'])->name('search.companies');

  Route::post('/offre/store', [\App\Http\Controllers\Offrecontroller::class,'store'])->name('store.offre');
  Route::get('/offre', [\App\Http\Controllers\Offrecontroller::class, 'index'])->name('formoffre');
  Route::get('/offres', [\App\Http\Controllers\Offrecontroller::class, 'show'])->name('offres');
  Route::get('/offers/search', [\App\Http\Controllers\Offrecontroller::class, 'search'])->name('offers.search');
  Route::get('/Postulants/{id}', [\App\Http\Controllers\Offrecontroller::class, 'Postulants'])->name('Postulants');
  
  Route::delete('/offers/{id}', [\App\Http\Controllers\Offrecontroller::class, 'delete'])->name('offers.delete');
Route::get('/statistique' ,[ProfileController::class, 'statistique'])->name('statistique');

  Route::post('postuler/{offreId}', [\App\Http\Controllers\Offrecontroller::class, 'postuler'])->name('postuler');

  
    Route::get('/cvform', [\App\Http\Controllers\Formcontroller::class, 'index'])->name('formCv');
    Route::post('/store', [\App\Http\Controllers\Formcontroller::class, 'store'])->name('cv.store');
    Route::get('/cv/cursus', [\App\Http\Controllers\Formcontroller::class, 'getUserCursus'])->name('getUserCursus');
    Route::delete('/cursus/{id}', [Formcontroller::class, 'destroy'])->name('cursus.destroy');


    Route::get('/user/experiences', [ExperienceController::class, 'getUserExperience'])->name('getUserExperience');
    Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
    Route::delete('/experience/{id}', [ExperienceController::class, 'destroy'])->name('experience.destroy');



Route::post('/language', [LanguageController::class, 'storeLanguage'])->name('language.store');
Route::get('/user/language', [LanguageController::class, 'getUserLanguage'])->name('getUserLanguage');
Route::delete('/language/{id}', [LanguageController::class, 'deleteLanguage'])->name('language.destroy');

Route::post('/competence', [CompetenceController::class, 'store'])->name('competence.store');
Route::get('/user/competence', [CompetenceController::class, 'getUserCompetence'])->name('getUserCompetence');
Route::delete('/competence/{id}', [CompetenceController::class, 'destroy'])->name('competence.destroy');


Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate.pdf');
Route::get('/cv', [PDFController::class, 'index'])->name('cv');

});

require __DIR__.'/auth.php';

