<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


Breadcrumbs::for('categories_front', function ($trail,$type) {
    $trail->parent('home');
    if($type){
        $trail->push('Products', route('categories_front'));
        $trail->push(ucfirst($type), route('categories_front',$type));
    }else{
        $trail->push('Products', route('categories_front'));
    }
});

Breadcrumbs::for('single_product', function ($trail,$type,$name) {
    $trail->parent('categories_front',$type);
    $trail->push($name, route('product_single',[$type,$name]));
});


Breadcrumbs::for('blog_post', function ($trail,$name) {
    $trail->parent('home');
    $trail->push('News', route('blog'));
    $trail->push($name, route('blog_post',$name));
});