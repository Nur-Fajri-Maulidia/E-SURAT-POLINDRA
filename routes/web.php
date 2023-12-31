<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\CekSuratController;
use App\Http\Controllers\DocumentAttachmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentDisposisiController;
use App\Http\Controllers\DocumentDisposisiUnitController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LetterAttachmentController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterDisposisiController;
use App\Http\Controllers\LetterDisposisiUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OutboxController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TTEController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\Penerima\DisposisiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/auth', 301);
Route::get('/auth', [AuthController::class, 'showLoginForm'])->name('auth');
Route::post('/auth-login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/surat-umum/{uuid}', [CekSuratController::class, 'umum'])->name('cek-letter');
Route::get('/surat-khusus/{uuid}', [CekSuratController::class, 'khusus'])->name('cek-document');
Route::get('/visum-umum/{uuid}', [CekSuratController::class, 'visum'])->name('cek-visum-umum');
Route::get('/spd/{uuid}', [CekSuratController::class, 'visum'])->name('cek-spd');

Auth::routes(['register' => false]);

// admin
Route::middleware('auth')->prefix('surat')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // categories
    Route::get('categories/data', [CategoryController::class, 'data'])->name('categories.data');
    Route::resource('categories', CategoryController::class);

    // unit-kerjas
    Route::get('unit-kerjas/data', [UnitKerjaController::class, 'data'])->name('unit-kerjas.data');
    Route::get('unit-kerjas/get', [UnitKerjaController::class, 'get'])->name('unit-kerjas.get-json');
    Route::post('unit-kerjas/set-role', [UnitKerjaController::class, 'set_role'])->name('unit-kerjas.set-role');
    Route::resource('unit-kerjas', UnitKerjaController::class);


    // jabatans
    Route::get('jabatans/data', [JabatanController::class, 'data'])->name('jabatans.data');
    Route::get('jabatans/getbyunitkerja', [JabatanController::class, 'get_by_unitkerja'])->name('jabatans.get-byunitkerja');
    Route::resource('jabatans', JabatanController::class);

    // Pangkat
    Route::get('pangkat/data', [PangkatController::class, 'data'])->name('pangkat.data');
    Route::get('pangkat/get-name', [PangkatController::class, 'getByName'])->name('pangkat.getByName');
    Route::resource('pangkat', PangkatController::class);

    // roles
    Route::get('roles/data', [RoleController::class, 'data'])->name('roles.data');
    Route::get('roles/get', [RoleController::class, 'get'])->name('roles.get-json');
    Route::get('roles/getbyunitkerja', [RoleController::class, 'get_by_unitkerja'])->name('roles.get-byunitkerja');
    Route::resource('roles', RoleController::class);

    // role permission
    Route::get('role-permissions', [RoleController::class, 'edit_role_permission'])->name('role-permissions.edit');
    Route::post('role-permissions', [RoleController::class, 'update_role_permission'])->name('role-permissions.update');

    // permissions
    Route::get('permissions/data', [PermissionController::class, 'data'])->name('permissions.data');
    Route::resource('permissions', PermissionController::class);


    // users
    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::get('users/get', [UserController::class, 'get'])->name('users.get');
    Route::resource('users', UserController::class);

    // create letter
    // surat umum
    Route::get('/letter/create', [LetterController::class, 'create'])->name('letters.create');
    Route::post('/letter/create', [LetterController::class, 'store'])->name('letters.store');
    Route::get('outbox/letter/{uuid}/edit', [LetterController::class, 'edit'])->name('letters.edit');
    Route::post('outbox/letter/{uuid}/edit', [LetterController::class, 'update'])->name('letters.update');
    Route::delete('outbox/letter/{uuid}', [LetterController::class, 'destroy'])->name('letters.destroy');
    Route::get('outbox/letter/{uuid}', [LetterController::class, 'show'])->name('letters.show');
    Route::get('inbox/letter/{uuid}', [LetterController::class, 'show_inbox'])->name('letters.inbox.show');

    // surat khusus
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents/create', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/get/user', [DocumentController::class, 'getUser'])->name('getUser');
    Route::get('/get/category', [DocumentController::class, 'getCategory'])->name('getCategory');
    Route::get('outbox/documents/{uuid}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::post('outbox/documents/{uuid}/edit', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('outbox/documents/{uuid}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('outbox/documents/{uuid}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('inbox/documents/{uuid}', [DocumentController::class, 'show_inbox'])->name('documents.inbox.show');

    // surat masuk
    Route::get('inbox/data', [InboxController::class, 'data'])->name('inbox.data');
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');

    // surat keluar
    Route::get('outbox/data', [OutboxController::class, 'data'])->name('outbox.data');
    Route::get('/outbox', [OutboxController::class, 'index'])->name('outbox.index');


    // attachmentd download
    Route::get('letter-attachment/{id}/download', [LetterAttachmentController::class, 'download'])->name('letter-attachments.download');

    // attachmentd download
    Route::get('document-attachment/{id}/download', [DocumentAttachmentController::class, 'download'])->name('document-attachments.download');

    // notifikasi
    Route::get('/notifications/data', [NotificationController::class, 'data'])->name('notifications.data');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');


    // tte letter
    Route::get('tte/letters/{uuid}', [LetterController::class, 'tte'])->name('letters.tte.index');
    Route::post('tte/letters/{uuid}', [LetterController::class, 'tte_create'])->name('letters.tte.create');
    Route::get('tte/letters/{uuid}/download', [LetterController::class, 'tte_download'])->name('letters.tte-download');

    // tte documents
    Route::get('tte/documents/{uuid}', [DocumentController::class, 'tte'])->name('documents.tte.index');
    Route::post('tte/documents/{uuid}', [DocumentController::class, 'tte_create'])->name('documents.tte.create');
    Route::get('tte/documents/{uuid}/download', [DocumentController::class, 'tte_download'])->name('documents.tte-download');


    // tte visum umum
    Route::get('tte/documents/visum-umum/{uuid}', [TTEController::class, 'tte_visum_umum'])->name('documents.tte.visum-umum.index');
    Route::post('tte/documents/visum-umum/{uuid}', [TTEController::class, 'tte_visum_umum_create'])->name('documents.tte.visum-umum.create');
    Route::get('tte/documents/visum-umum/{uuid}/download', [TTEController::class, 'tte_visum_umum_download'])->name('documents.tte.visum-umum.download');
    Route::get('tte/documents/visum-umum/{uuid}/get', [TTEController::class, 'getPdf'])->name('documents.tte.vu.get');
    Route::get('tte/documents/visum-umum/{uuid}/download-before-tte', [TTEController::class, 'tte_visum_umum_download_before_tte'])->name('documents.tte.visum-umum.download-before-tte');


    // tte spd
    Route::get('tte/documents/spd/{uuid}', [TTEController::class, 'tte_spd'])->name('documents.tte.spd.index');
    Route::post('tte/documents/spd/{uuid}', [TTEController::class, 'tte_spd_create'])->name('documents.tte.spd.create');
    Route::get('tte/documents/spd/{uuid}/download', [TTEController::class, 'tte_spd_download'])->name('documents.tte.spd.download');
    Route::get('tte/documents/spd/{uuid}/download-before-tte', [TTEController::class, 'tte_spd_download_before_tte'])->name('documents.tte.spd.download-before-tte');


    // letter disposisi
    Route::get('disposisi/letter/{uuid}', [LetterDisposisiController::class, 'index'])->name('letters.disposisi.index');
    Route::post('disposisi/letter/{uuid}', [LetterDisposisiController::class, 'update'])->name('letters.disposisi.update');

    // letter disposisi user
    Route::post('disposisi/letter-penerima', [LetterDisposisiUserController::class, 'store'])->name('letters.disposisi.user.store');
    // letter disposisi user
    Route::delete('disposisi/letter-penerima/{id}', [LetterDisposisiUserController::class, 'destroy'])->name('letters.disposisi.user.destroy');



    // document disposisi
    Route::get('disposisi/document/{uuid}', [DocumentDisposisiController::class, 'index'])->name('documents.disposisi.index');
    Route::post('disposisi/document/{uuid}', [DocumentDisposisiController::class, 'update'])->name('documents.disposisi.update');

    // document disposisi unit
    Route::post('disposisi/document-penerima', [DocumentDisposisiUnitController::class, 'store'])->name('documents.disposisi.user.store');
    // document disposisi unit
    Route::delete('disposisi/document-penerima/{id}', [DocumentDisposisiUnitController::class, 'destroy'])->name('documents.disposisi.user.destroy');

    Route::post('signout', [UserController::class, 'logout'])->name('signout');
    Route::prefix("penerima")->group(function () {
        Route::controller(DisposisiController::class)->group(function () {
            Route::get('/disposisi', 'getDisposisi')->name('disposisi.index');
            Route::get('/request-disposisi', 'requestDisposisi')->name('disposisi.table');
            Route::get('/view-disposisi', 'viewDisposisi')->name('disposisi.view');
            Route::get('/download-disposisi/{uuid}', 'tteDownload')->name('disposisi.download');
        });
    });
});
