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

$router->get('/m', function () use ($router) {
    return 'validated';
});


$api = app('Dingo\Api\Routing\Router');



$api->version('v1', function ($api) {

    //var_export($api);

    /*$api->get('test', function () {
        return 'It is ok';
    });*/


    $api->get('validate/phone/{number}', ['uses' =>'App\Http\Controllers\Api\ValidatorController@phone']);


});


/*$router->get('profile', [
    'as' => 'profile', 'uses' => 'UserController@showProfile'
]);*/
