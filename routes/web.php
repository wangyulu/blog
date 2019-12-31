<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('users/save', ['uses' => 'UserController@save']);

$router->get('users/{id}', ['uses' => 'UserController@detail']);

$router->get('users/roles/{user_id}', ['uses' => 'UserController@roleDetail']);

$router->get('users/{user_id}/posts', ['uses' => 'UserController@detailPosts']);

$router->get('users/{user_id}/has/posts', ['uses' => 'UserController@detailHasPosts']);

$router->get('users/{user_id}/phone', ['uses' => 'UserController@detailWithPhone']);

$router->get('roles/{role_id}/users', ['uses' => 'RoleController@userDetail']);

$router->get('roles/users/{role_id}/with/pivot', ['uses' => 'RoleController@userDetailWithPivot']);

$router->get('roles/{role_id}/with/through/users/iphone', ['uses' => 'RoleController@detailWithThroughIphone']);

$router->get('author/{id}', ['uses' => 'AuthorController@detail']);

$router->get('author/{id}/with/books', ['uses' => 'AuthorController@detailWithBooks']);

$router->get('phone/{id}', ['uses' => 'PhoneController@detail']);

$router->get('posts/{id}', ['uses' => 'PostsController@detail']);

$router->get('posts/{id}/morph/to/image', ['uses' => 'PostsController@detailMorphToImage']);

$router->get('posts/{id}/morph/to/images', ['uses' => 'PostsController@detailMorphToImages']);

$router->get('posts/{id}/morph/to/tags', ['uses' => 'PostsController@detailMorphToTags']);

$router->get('comments/{id}', ['uses' => 'CommentsController@detail']);

$router->get('book/list', ['uses' => 'BookController@list']);

$router->get('book/chunks', ['uses' => 'BookController@chunks']);

$router->get('book/cursor', ['uses' => 'BookController@cursor']);

$router->get('book/non_cursor', ['uses' => 'BookController@non_cursor']);

$router->post('book/create', ['uses' => 'BookController@create']);

$router->post('book/save', ['uses' => 'BookController@save']);

$router->post('book/fill', ['uses' => 'BookController@fill']);

$router->get('book/{id}', ['uses' => 'BookController@detail']);

$router->get('category/detail/{id}', ['uses' => 'BookCategoryController@detail']);

$router->get('city/{city_id}/with/through/users/iphone', ['uses' => 'CityController@detailWithThroughIphone']);

$router->get('image/{id}/with/morph/to/ables', ['uses' => 'ImageController@detailMorphTo']);

$router->get('tags/{id}', ['uses' => 'TagController@detail']);
