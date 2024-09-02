<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;



// Home
Breadcrumbs::for('beranda', function (BreadcrumbTrail $trail) {
    $trail->push('beranda', route('beranda'));
});


Breadcrumbs::for('berita', function (BreadcrumbTrail $trail) {
    $trail->push('berita', route('berita_lengkap'));
});


Breadcrumbs::for('halaman', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('beranda');
    $trail->push($slug, route('halaman', $slug));
});

//detail
Breadcrumbs::for('detail', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('beranda');
    $trail->parent('berita');
    $trail->push($slug, route('detail', $slug));
});

//kategori
Breadcrumbs::for('kategori', function (BreadcrumbTrail $trail, $kategori) {
    $trail->parent('beranda');
    $trail->parent('berita');

    $trail->push($kategori, route('kategori_tampil', $kategori));
});

Breadcrumbs::for('tag', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('beranda');
    $trail->parent('berita');
    $trail->push($tag, route('tag_tampil', $tag));
});
// Home > Blog > [Category]
// Breadcrumbs::for('kategori_tag', function (BreadcrumbTrail $trail) {
//     $trail->parent('beranda');
//     $trail->push($category->title, route('detail', $));
// });

//layanan
Breadcrumbs::for('layanan', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('beranda');
    $trail->push($slug, route('layanan', $slug));
});

