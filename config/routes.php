<?php
return [
    '/' => 'IndexController@renderIndex',
    '/users' => 'UserController@showUser',
    '/user/add' => 'UserController@addUser',
    '/user/update' => 'UserController@updateUser',
    '/user/delete' => 'UserController@deleteUser'
];