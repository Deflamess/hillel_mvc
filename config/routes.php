<?php
return [
    '/' => 'IndexController@renderIndex',
    '/users' => 'UserController@showUser',
    '/user/add' => 'UserController@addUser',
    '/user/update' => 'UserController@UserUpdate',
    '/user/delete' => 'UserController@UserDelete'
];