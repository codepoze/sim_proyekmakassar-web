<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard', session()->get('roles')));
});

Breadcrumbs::for('admin.profil', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Profil', route('admin.profil', session()->get('roles')));
});

Breadcrumbs::for('admin.menu.menu', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Menu', '#');
});

Breadcrumbs::for('admin.menu.head', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menu.menu');

    $trail->push('Head', route('admin.menu.head', session()->get('roles')));
});

Breadcrumbs::for('admin.menu.body', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menu.menu');

    $trail->push('Body', route('admin.menu.body', session()->get('roles')));
});

Breadcrumbs::for('admin.menu.action', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menu.menu');

    $trail->push('Action', route('admin.menu.action', session()->get('roles')));
});

Breadcrumbs::for('admin.role.role', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Role', route('admin.role.role', session()->get('roles')));
});

Breadcrumbs::for('admin.role.menu', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.role.role');

    $trail->push('Menu', route('admin.role.menu', session()->get('roles')));
});

Breadcrumbs::for('admin.role.menu.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.role.menu');

    $trail->push('Create', route('admin.role.menu.create', session()->get('roles')));
});

Breadcrumbs::for('admin.role.menu.update', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.role.menu');

    $trail->push('Update');
});

Breadcrumbs::for('admin.users', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Users', route('admin.users', session()->get('roles')));
});

// ========================================================================

Breadcrumbs::for('admin.fund.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Sumber Dana', route_role('admin.fund.index'));
});

Breadcrumbs::for('admin.holiday.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Hari Libur', route_role('admin.holiday.index'));
});

Breadcrumbs::for('admin.satuan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Satuan', route_role('admin.satuan.index'));
});

Breadcrumbs::for('admin.penyedia.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Penyedia', route_role('admin.penyedia.index'));
});

Breadcrumbs::for('admin.konsultan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Konsultan', route_role('admin.konsultan.index'));
});

Breadcrumbs::for('admin.pptk.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('PPTK', route_role('admin.pptk.index'));
});

Breadcrumbs::for('admin.teknislap', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Teknis Lapangan', '#');
});

Breadcrumbs::for('admin.teknislap.kordinator.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.teknislap');

    $trail->push('Kordinator', route_role('admin.teknislap.kordinator.index'));
});

Breadcrumbs::for('admin.teknislap.kordinator.detail', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.teknislap.kordinator.index');

    $trail->push('Detail');
});

Breadcrumbs::for('admin.teknislap.anggota.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.teknislap.kordinator.index');

    $trail->push('Anggota', route_role('admin.teknislap.anggota.index'));
});

Breadcrumbs::for('admin.kegiatan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Kegiatan', route_role('admin.kegiatan.index'));
});

Breadcrumbs::for('admin.paket.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Paket', route_role('admin.paket.index'));
});

Breadcrumbs::for('admin.paket.det', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.paket.index');

    $trail->push('Detail', '#');
});

Breadcrumbs::for('admin.kontrak.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Kontrak', route_role('admin.kontrak.index'));
});

Breadcrumbs::for('admin.kontrak.add', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Tambah', '#');
});

Breadcrumbs::for('admin.kontrak.det', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Detail', '#');
});

Breadcrumbs::for('admin.kontrak.rincian', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Rincian', '#');
});

Breadcrumbs::for('admin.kontrak.upd', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Ubah', '#');
});

Breadcrumbs::for('admin.kontrak.ruas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Kontrak Ruas', '#');
});

Breadcrumbs::for('admin.kontrak.progress.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Progress Ruas', '#');
});

Breadcrumbs::for('admin.kontrak.ph0.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Ph0 Ruas', '#');
});

Breadcrumbs::for('admin.kontrak.fh0.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kontrak.index');

    $trail->push('Fh0 Ruas', '#');
});