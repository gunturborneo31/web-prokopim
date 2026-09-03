<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DocumentStatsController;
use App\Http\Controllers\FrontendPageController;

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

// Redirect root to admin panel
// Route::get('/', function () { return redirect('/site-admin'); });
// use Illuminate\Support\Facades\Artisan;

// Route::get('/link', function () {
//     Artisan::call('storage:link');
//     return 'Storage link berhasil dibuat!';
// });

Route::get('/', [LandingController::class, 'index'])->name('beranda');


// Language Switcher Route
Route::get('language/{locale}', function ($locale) {
    // Set locale and save to session
    app()->setLocale($locale);
    session()->put('locale', $locale);
    // Jika menggunakan package bezhansalleh, biasanya via cookie:
    cookie()->queue(cookie()->forever('filament_language_switch_locale', $locale));
    
    return redirect()->back();
})->name('language.switch');


Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/halaman/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/halaman/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');

Route::get('/halaman/{slug?}', [FrontendPageController::class, 'showDynamicPage'])->name('halaman.dynamic');

// Document Stats Routes
Route::prefix('dokumen-stats')->name('stats.')->group(function () {
    Route::get('/view', [DocumentStatsController::class, 'view'])->name('view');
    Route::get('/download', [DocumentStatsController::class, 'download'])->name('download');
    Route::get('/get', [DocumentStatsController::class, 'stats'])->name('get');
    Route::post('/batch', [DocumentStatsController::class, 'batch'])->name('batch');
});

Route::get('/e-gov', [LandingController::class, 'showEGovPage'])->name('egov');
Route::redirect('/portal', '/e-gov', 301)->name('portal');

// Profil Routes
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/visi-misi', [FrontendPageController::class, 'showProfilePage'])->defaults('slug', 'visi-misi')->name('visi-misi');
    Route::get('/tujuan-sasaran', [FrontendPageController::class, 'showProfilePage'])->defaults('slug', 'tujuan-sasaran')->name('tujuan-sasaran');
    Route::get('/tupoksi', [FrontendPageController::class, 'showProfilePage'])->defaults('slug', 'tupoksi')->name('tupoksi');
    Route::get('/pimpinan', [FrontendPageController::class, 'showLeaderProfile'])->name('pimpinan');
    Route::get('/aparatur', [FrontendPageController::class, 'showAparatur'])->name('aparatur');
    Route::get('/motto', [FrontendPageController::class, 'showProfilePage'])->defaults('slug', 'motto')->name('motto');
    Route::get('/kata-pengantar', [FrontendPageController::class, 'showProfilePage'])->defaults('slug', 'kata-pengantar')->name('kata-pengantar');
    Route::get('/penghargaan', [FrontendPageController::class, 'showAwards'])->name('penghargaan');
    Route::get('/struktur', [FrontendPageController::class, 'showProfilePage'])->defaults('slug', 'struktur')->name('struktur');
});

// Berita Routes
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

// Regulasi Routes
Route::prefix('regulasi')->name('regulasi.')->group(function () {
    Route::get('/undang-undang', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'regulasi')->defaults('slug', 'undang-undang')->name('undang-undang');
    Route::get('/peraturan-menteri', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'regulasi')->defaults('slug', 'peraturan-menteri')->name('peraturan-menteri');
    Route::get('/peraturan-daerah', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'regulasi')->defaults('slug', 'peraturan-daerah')->name('peraturan-daerah');
    Route::get('/peraturan-bupati', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'regulasi')->defaults('slug', 'peraturan-bupati')->name('peraturan-bupati');
    Route::get('/sk-bupati', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'regulasi')->defaults('slug', 'sk-bupati')->name('sk-bupati');
    Route::get('/sk-kepala', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'regulasi')->defaults('slug', 'sk-kepala')->name('sk-kepala');
    Route::get('/lain-lain', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'regulasi')->defaults('slug', 'lain-lain')->name('lain-lain');
});

// Dokumen Routes
Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::get('/renstra', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'renstra')->name('renstra');
    Route::get('/renja', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'renja')->name('renja');
    Route::get('/dpa', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'dpa')->name('dpa');
    Route::get('/iku', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'iku')->name('iku');
    Route::get('/sop', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'sop')->name('sop');
    Route::get('/sakip', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'sakip')->name('sakip');
    Route::get('/rkpd', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'rkpd')->name('rkpd');
    Route::get('/rpjpd', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'rpjpd')->name('rpjpd');
    Route::get('/rpjmd', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'dokumen')->defaults('slug', 'rpjmd')->name('rpjmd');
});

// PPID Routes
Route::prefix('ppid')->name('ppid.')->group(function () {
    Route::get('/', [FrontendPageController::class, 'showPpidHub'])->name('index');
    Route::get('/informasi', [FrontendPageController::class, 'showPpidInformationTypes'])->name('informasi');
    Route::get('/berkala', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'ppid')->defaults('slug', 'berkala')->name('berkala');
    Route::get('/serta-merta', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'ppid')->defaults('slug', 'serta-merta')->name('serta-merta');
    Route::get('/setiap-saat', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'ppid')->defaults('slug', 'setiap-saat')->name('setiap-saat');
    Route::get('/dikecualikan', [FrontendPageController::class, 'showLibraryPage'])->defaults('section', 'ppid')->defaults('slug', 'dikecualikan')->name('dikecualikan');
    Route::get('/permohonan', [FrontendPageController::class, 'showPpidRequestPage'])->name('permohonan');
    Route::post('/permohonan', [FrontendPageController::class, 'storePpidRequest'])->name('permohonan.store');
    Route::get('/permohonan/status', [FrontendPageController::class, 'lookupPpidRequest'])->name('permohonan.status');
});

// Layanan Routes
Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/pengaduan', [FrontendPageController::class, 'showComplaintPage'])->name('pengaduan');
    Route::post('/pengaduan', [FrontendPageController::class, 'storeComplaint'])->name('pengaduan.store');
    Route::get('/cek-status', [FrontendPageController::class, 'showComplaintStatusPage'])->name('cek-status');
    Route::get('/cek-status/search', [FrontendPageController::class, 'lookupComplaintStatus'])->name('cek-status.search');
    Route::get('/wbs', [FrontendPageController::class, 'showWbsPage'])->name('wbs');
    Route::post('/wbs', [FrontendPageController::class, 'storeWbs'])->name('wbs.store');
});
