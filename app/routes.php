<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'indexController@index');
Route::post('user/add', 'userController@add');//添加用户

Route::get('/login', function()
{
  // echo function_exists('password_get_info');exit;

    $time=microtime(true);
    $password = password_hash('secret', PASSWORD_BCRYPT);
    if (password_verify('secret', $password))
    {
        echo 13213;
        // 密码匹配...
    }
    //     $password = md5('secret');
    // if (md5('secret')== $password)
    // {
    //     echo 13213;
    //     // 密码匹配...
    // }
    echo microtime(true)-$time;
//    var_dump(User::find(1)->toArray());exit;
//    return View::make('login');
});