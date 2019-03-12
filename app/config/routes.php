<?php

return array(
	
	'taskManager/sort/(id|name|email|done)/(asc|desc)'	=>	'task/sort/$1/$2',		//Sorting
	'taskManager/login'			=>	'user/login',		//login
	'taskManager/logout'		=>	'user/logout',		//logout
	'taskManager/new'			=>	'task/new',			//Create
	'taskManager/edit/([0-9]+)'	=>	'task/edit/$1',		//Edit
	'taskManager/update'		=>	'task/update',		//Update
	'taskManager/([0-9]+)'		=>	'task/index/$1',	//Page
	'taskManager'				=>	'task/index/1',		//Default

	);