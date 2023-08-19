<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.profil', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Profil', route('admin.profil'));
});

Breadcrumbs::for('admin.role.role', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Role', route('admin.role.role'));
});

Breadcrumbs::for('admin.role.menu', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.role.role');

    $trail->push('Menu', route('admin.role.menu'));
});

Breadcrumbs::for('admin.role.menu.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.role.menu');

    $trail->push('Create', route('admin.role.menu.create'));
});

Breadcrumbs::for('admin.role.menu.update', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.role.menu');

    $trail->push('Update');
});

Breadcrumbs::for('admin.menu.menu', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Menu', '#');
});

Breadcrumbs::for('admin.menu.head', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menu.menu');

    $trail->push('Head', route('admin.menu.head'));
});

Breadcrumbs::for('admin.menu.body', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menu.menu');

    $trail->push('Body', route('admin.menu.body'));
});

Breadcrumbs::for('admin.menu.action', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menu.menu');

    $trail->push('Action', route('admin.menu.action'));
});

Breadcrumbs::for('admin.users', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Users', route('admin.users'));
});

Breadcrumbs::for('admin.pengawas', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pengawas', '#');
});

Breadcrumbs::for('admin.pengawas.kordinator', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pengawas');

    $trail->push('Kordinator', route('admin.pengawas.kordinator'));
});

Breadcrumbs::for('admin.pengawas.kordinator.detail', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pengawas.kordinator');

    $trail->push('Detail Kordinator');
});

Breadcrumbs::for('admin.pengawas.anggota', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pengawas');

    $trail->push('Anggota', route('admin.pengawas.anggota'));
});

Breadcrumbs::for('admin.perusahaan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Perusahaan', route('admin.perusahaan'));
});

Breadcrumbs::for('admin.kegiatan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Kegiatan', route('admin.kegiatan'));
});

Breadcrumbs::for('admin.kegiatan.detail', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kegiatan');

    $trail->push('Detail Kegiatan');
});

Breadcrumbs::for('admin.paket', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Paket', route('admin.paket'));
});
