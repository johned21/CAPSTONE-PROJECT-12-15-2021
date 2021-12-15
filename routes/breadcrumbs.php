<?php 
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('enrollment', function ($trail) {
    $trail->parent('home');
    $trail->push('Enrollment', route('home'));
    $trail->push('Payment');
    $trail->push('Review');
});