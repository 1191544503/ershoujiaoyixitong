<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE'=>'Home',
//	'SHOW_PAGE_TRACE' =>FALSE,
	'URL_ROUTE_RULES'=>array(
	'register'=>'Usermin/index',
	'land'=>'Usermin/Landing',
	'list'=>'Store/storelist',
	'admin'=>'index/admin',
	'addgood'=>'Store/addGoodhtml',
	'logout'=>'Usermin/logout',
	'alterpwd'=>'Usermin/alterpwdhtml',
	'peoplelist'=>'Store/peoplestoreList',
	'main'=>'index/index',
	'add'=>'Store/addGood',
	'adminstorelist'=>'Store/adminstorelist',
	'booksearch'=>'store/storelistByBookname',
	'active'=>'Usermin/active',
    'addshopcart'=>'Shopcart/addshopcart',
    'Shopcart'=>'Shopcart/showShopcart',
    'deletecart'=>'Shopcart/Deletecart'
	),
);