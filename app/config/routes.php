<?php
return array(
    'taskManager/sort/(id|name|email|done)/(asc|desc)' => 'task/sort/$1/$2',
    'taskManager/login'         =>    'user/login',
    'taskManager/logout'        =>    'user/logout',
    'taskManager/new'           =>    'task/new',
    'taskManager/edit/([0-9]+)' =>    'task/edit/$1',
    'taskManager/update'        =>    'task/update',
    'taskManager/([0-9]+)'      =>    'task/index/$1',
    'taskManager'               =>    'task/index/1',
);
