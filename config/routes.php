<?php
return [
    '/' => 'IndexController@renderIndex',
    '/users' => 'UserController@showUser',
    '/users/add' => 'UserController@addUser',
    '/users/update' => 'UserController@UserUpdate',
    '/users/delete' => 'UserController@UserDelete'
];