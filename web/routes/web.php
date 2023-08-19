<?php

use App\Http\Controllers\admin\AnggPengawasController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\KegiatanController;
use App\Http\Controllers\admin\KordPengawasController;
use App\Http\Controllers\admin\MenuActionController;
use App\Http\Controllers\admin\MenuBodyController;
use App\Http\Controllers\admin\MenuHeadController;
use App\Http\Controllers\admin\PaketController;
use App\Http\Controllers\admin\PerusahaanController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\RoleMenuController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// begin:: auth
Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/check', [AuthController::class, 'check'])->name('auth.check');
// end:: auth

Route::group(['middleware' => ['session.auth', 'prevent.back.history']], function () {
    // begin:: admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/profil')->group(function () {
            Route::get('/', [ProfilController::class, 'index'])->name('profil');
            Route::post('/save_picture', [ProfilController::class, 'save_picture'])->name('profil.save_picture');
            Route::post('/save_account', [ProfilController::class, 'save_account'])->name('profil.save_account');
            Route::post('/save_security', [ProfilController::class, 'save_security'])->name('profil.save_security');
        });

        // begin:: menu
        Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
            Route::prefix('/head')->group(function () {
                Route::get('/', [MenuHeadController::class, 'index'])->name('head');
                Route::get('/get_data_dt', [MenuHeadController::class, 'get_data_dt'])->name('head.get_data_dt');
                Route::get('/get_all', [MenuHeadController::class, 'get_all'])->name('head.get_all');
                Route::post('/show', [MenuHeadController::class, 'show'])->name('head.show');
                Route::post('/save', [MenuHeadController::class, 'save'])->name('head.save');
                Route::post('/del', [MenuHeadController::class, 'del'])->name('head.del');
            });

            Route::prefix('/body')->group(function () {
                Route::get('/', [MenuBodyController::class, 'index'])->name('body');
                Route::get('/get_data_dt', [MenuBodyController::class, 'get_data_dt'])->name('body.get_data_dt');
                Route::post('/show', [MenuBodyController::class, 'show'])->name('body.show');
                Route::post('/save', [MenuBodyController::class, 'save'])->name('body.save');
                Route::post('/del', [MenuBodyController::class, 'del'])->name('body.del');
            });

            Route::prefix('/action')->group(function () {
                Route::get('/', [MenuActionController::class, 'index'])->name('action');
                Route::get('/get_data_dt', [MenuActionController::class, 'get_data_dt'])->name('action.get_data_dt');
                Route::post('/show', [MenuActionController::class, 'show'])->name('action.show');
                Route::post('/save', [MenuActionController::class, 'save'])->name('action.save');
                Route::post('/del', [MenuActionController::class, 'del'])->name('action.del');
            });
        });
        // end:: menu

        // begin:: role
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role');
            Route::get('/get_data_dt', [RoleController::class, 'get_data_dt'])->name('role.get_data_dt');
            Route::get('/get_all', [RoleController::class, 'get_all'])->name('role.get_all');
            Route::post('/show', [RoleController::class, 'show'])->name('role.show');
            Route::post('/save', [RoleController::class, 'save'])->name('role.save');
            Route::post('/del', [RoleController::class, 'del'])->name('role.del');

            Route::prefix('/menu')->group(function () {
                Route::get('/', [RoleMenuController::class, 'index'])->name('menu');
                Route::get('/create', [RoleMenuController::class, 'create'])->name('menu.create');
                Route::get('/update/{any}', [RoleMenuController::class, 'update'])->name('menu.update');
                Route::get('/get_data_dt', [RoleMenuController::class, 'get_data_dt'])->name('menu.get_data_dt');
                Route::post('/save', [RoleMenuController::class, 'save'])->name('menu.save');
                Route::post('/del', [RoleMenuController::class, 'del'])->name('menu.del');
            });
        });
        // end:: role

        // begin:: users
        Route::prefix('/users')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('users');
            Route::get('/get_data_dt', [UsersController::class, 'get_data_dt'])->name('users.get_data_dt');
            Route::post('/save', [UsersController::class, 'save'])->name('users.save');
            Route::post('/active', [UsersController::class, 'active'])->name('users.active');
            Route::post('/reset_password', [UsersController::class, 'reset_password'])->name('users.reset_password');
        });
        // end:: users

        // begin:: pengawas & anggota
        Route::group(['prefix' => 'pengawas', 'as' => 'pengawas.'], function () {
            Route::prefix('/kordinator')->group(function () {
                Route::get('/', [KordPengawasController::class, 'index'])->name('kordinator');
                Route::get('/detail/{any}', [KordPengawasController::class, 'detail'])->name('kordinator.detail');
                Route::get('/get_data_dt', [KordPengawasController::class, 'get_data_dt'])->name('kordinator.get_data_dt');
                Route::get('/get_all', [KordPengawasController::class, 'get_all'])->name('kordinator.get_all');
                Route::post('/show', [KordPengawasController::class, 'show'])->name('kordinator.show');
                Route::post('/save', [KordPengawasController::class, 'save'])->name('kordinator.save');
                Route::post('/del', [KordPengawasController::class, 'del'])->name('kordinator.del');
            });

            Route::prefix('/anggota')->group(function () {
                Route::get('/', [AnggPengawasController::class, 'index'])->name('anggota');
                Route::get('/get_data_dt', [AnggPengawasController::class, 'get_data_dt'])->name('anggota.get_data_dt');
                Route::post('/show', [AnggPengawasController::class, 'show'])->name('anggota.show');
                Route::post('/save', [AnggPengawasController::class, 'save'])->name('anggota.save');
                Route::post('/del', [AnggPengawasController::class, 'del'])->name('anggota.del');
            });
        });
        // end:: pengawas & anggota

        // begin:: perusahaan
        Route::prefix('/perusahaan')->group(function () {
            Route::get('/', [PerusahaanController::class, 'index'])->name('perusahaan');
            Route::get('/get_data_dt', [PerusahaanController::class, 'get_data_dt'])->name('perusahaan.get_data_dt');
            Route::get('/get_all', [PerusahaanController::class, 'get_all'])->name('perusahaan.get_all');
            Route::post('/show', [PerusahaanController::class, 'show'])->name('perusahaan.show');
            Route::post('/save', [PerusahaanController::class, 'save'])->name('perusahaan.save');
            Route::post('/del', [PerusahaanController::class, 'del'])->name('perusahaan.del');
        });
        // end:: perusahaan

        // begin:: kegiatan
        Route::prefix('/kegiatan')->group(function () {
            Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan');
            Route::get('/detail/{any}', [KegiatanController::class, 'detail'])->name('kegiatan.detail');
            Route::get('/get_data_dt', [KegiatanController::class, 'get_data_dt'])->name('kegiatan.get_data_dt');
            Route::post('/show', [KegiatanController::class, 'show'])->name('kegiatan.show');
            Route::post('/save', [KegiatanController::class, 'save'])->name('kegiatan.save');
            Route::post('/del', [KegiatanController::class, 'del'])->name('kegiatan.del');
        });
        // end:: kegiatan

        // begin:: paket
        Route::prefix('/paket')->group(function () {
            Route::get('/', [PaketController::class, 'index'])->name('paket');
            Route::get('/get_data_dt', [PaketController::class, 'get_data_dt'])->name('paket.get_data_dt');
            Route::post('/save', [PaketController::class, 'save'])->name('paket.save');
            Route::post('/del', [PaketController::class, 'del'])->name('paket.del');
        });
        // end:: paket
    });
    // end:: admin
});
