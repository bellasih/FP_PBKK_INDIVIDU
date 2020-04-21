<?php

$container['router'] = function() use ($defaultModule, $modules) {

	$router = new \Phalcon\Mvc\Router(false);
	$router->clear();

	/**
	 * Default Routing
	 */
	$router->add('/', [
	    'namespace' 	=> $modules[$defaultModule]['webControllerNamespace'],
		'module' 		=> $defaultModule,
	    'controller' 	=> isset($modules[$defaultModule]['defaultController']) ? $modules[$defaultModule]['defaultController'] : 'index',
	    'action' 		=> isset($modules[$defaultModule]['defaultAction']) ? $modules[$defaultModule]['defaultAction'] : 'index'
	]);
	
	/**
	 * Not Found Routing
	 */
	$router->notFound(
		[
			'namespace' 	=> 'ServiceLaundry\Common\Controllers',
			'controller' 	=> 'Error',
			'action'     	=> 'route404',
		]
	);

	/**
	 * Error Routing
	 */
	// $router->addGet('/dashboard', [
	// 	'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
	// 	'module'		=> 'dashboard',
	// 	'controller' 	=> "Index",
	// 	'action' 		=> "index"
	// ]);

	$router->addGet('/forbidden', [
		'namespace' 	=> 'ServiceLaundry\Common\Controllers',
		'controller' 	=> "Error",
		'action' 		=> "route403"
	]);
	
	$router->addGet('/error', [
		'namespace' 	=> 'ServiceLaundry\Common\Controllers',
		'controller' 	=> "Error",
		'action' 		=> "routeErrorCommon"
	]);

	/*
	* Cek routing module dashboard
	*/
	$router->addGet('/login', [
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller' 	=> "Authentication",
		'action' 		=> "createLogin"
	]);

	$router->addPost('/login', [
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller' 	=> "Authentication",
		'action' 		=> "storeLogin"
	]);

	$router->addPost('/add/admin',[
		'namespace'		=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller'	=> 'Index',
		'action'		=> 'storeAdmin'
	]);

	/*
	* Cek routing module expense
	*/
	$router->addGet('/expense',[
		'namespace'		=> 'ServiceLaundry\Expense\Controllers\Web',
		'module'		=> 'expense',
		'controller'	=> 'Expense',
		'action'		=> 'index'
	]);

	$router->addPost('/add/expense',[
		'namespace'		=> 'ServiceLaundry\Expense\Controllers\Web',
		'module'		=> 'expense',
		'controller'	=> 'Expense',
		'action'		=> 'storeExpense'
	]);

	$router->addPost('/expense',[
		'namespace'		=> 'ServiceLaundry\Expense\Controllers\Web',
		'module'		=> 'expense',
		'controller'	=> 'Expense',
		'action'		=> 'deleteExpense'
	]);

	$router->addGet('/edit/expense',[
		'namespace'		=> 'ServiceLaundry\Expense\Controllers\Web',
		'module'		=> 'expense',
		'controller'	=> 'Expense',
		'action'		=> 'editExpense'
	]);

	$router->addPost('/edit/expense',[
		'namespace'		=> 'ServiceLaundry\Expense\Controllers\Web',
		'module'		=> 'expense',
		'controller'	=> 'Expense',
		'action'		=> 'updateExpense'
	]);

	/*
	* Cek routing module goods
	*/
	$router->addGet('/goods',[
		'namespace'		=> 'ServiceLaundry\Goods\Controllers\Web',
		'module'		=> 'goods',
		'controller'	=> 'Goods',
		'action'		=> 'index'
	]);

	$router->addPost('/add/goods',[
		'namespace'		=> 'ServiceLaundry\Goods\Controllers\Web',
		'module'		=> 'goods',
		'controller'	=> 'Goods',
		'action'		=> 'storeGoods'
	]);

	$router->addPost('/goods',[
		'namespace'		=> 'ServiceLaundry\Goods\Controllers\Web',
		'module'		=> 'goods',
		'controller'	=> 'Goods',
		'action'		=> 'deleteGoods'
	]);

	$router->addGet('/edit/goods',[
		'namespace'		=> 'ServiceLaundry\Goods\Controllers\Web',
		'module'		=> 'goods',
		'controller'	=> 'Goods',
		'action'		=> 'editGoods'
	]);

	$router->addPost('/edit/goods',[
		'namespace'		=> 'ServiceLaundry\Goods\Controllers\Web',
		'module'		=> 'goods',
		'controller'	=> 'Goods',
		'action'		=> 'updateGoods'
	]);

	/*
	* Cek routing module order
	*/
	$router->addGet('/order',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Order',
		'action'		=> 'index'
	]);


	$router->addGet('/detail/order',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Order',
		'action'		=> 'detailItem'
	]);

	/*
	* Cek routing module 
	*/
	$router->addGet('/pickup_delivery',[
		'namespace'		=> 'ServiceLaundry\PickupDelivery\Controllers\Web',
		'module'		=> 'pickup_delivery',
		'controller'	=> 'PickupDelivery',
		'action'		=> 'index'
	]);

	$router->addPost('/add/pickup_delivery',[
		'namespace'		=> 'ServiceLaundry\PickupDelivery\Controllers\Web',
		'module'		=> 'pickup_delivery',
		'controller'	=> 'PickupDelivery',
		'action'		=> 'storePickupDelivery'
	]);

	$router->addPost('/pickup_delivery',[
		'namespace'		=> 'ServiceLaundry\PickupDelivery\Controllers\Web',
		'module'		=> 'pickup_delivery',
		'controller'	=> 'PickupDelivery',
		'action'		=> 'deletePickupDelivery'
	]);

	$router->addGet('/edit/pickup_delivery',[
		'namespace'		=> 'ServiceLaundry\PickupDelivery\Controllers\Web',
		'module'		=> 'pickup_delivery',
		'controller'	=> 'PickupDelivery',
		'action'		=> 'editPickupDelivery'
	]);

	$router->addPost('/edit/pickup_delivery',[
		'namespace'		=> 'ServiceLaundry\PickupDelivery\Controllers\Web',
		'module'		=> 'pickup_delivery',
		'controller'	=> 'PickupDelivery',
		'action'		=> 'updatePickupDelivery'
	]);


	/**
	 * Module Routing
	 */
	// foreach ($modules as $moduleName => $module) {

	// 	if ($module['defaultRouting'] == true) {
	// 		/**
	// 		 * Default Module routing
	// 		 */
	// 		$router->add('/'. $moduleName . '/:params', array(
	// 			'namespace' => $module['webControllerNamespace'],
	// 			'module' => $moduleName,
	// 			'controller' => isset($module['defaultController']) ? $module['defaultController'] : 'index',
	// 			'action' => isset($module['defaultAction']) ? $module['defaultAction'] : 'index',
	// 			'params'=> 1
	// 		));
			
	// 		$router->add('/'. $moduleName . '/:controller/:params', array(
	// 			'namespace' => $module['webControllerNamespace'],
	// 			'module' => $moduleName,
	// 			'controller' => 1,
	// 			'action' => isset($module['defaultAction']) ? $module['defaultAction'] : 'index',
	// 			'params' => 2
	// 		));

	// 		$router->add('/'. $moduleName . '/:controller/:action/:params', array(
	// 			'namespace' => $module['webControllerNamespace'],
	// 			'module' => $moduleName,
	// 			'controller' => 1,
	// 			'action' => 2,
	// 			'params' => 3
	// 		));	
	// 	} else {
			
	// 		$webModuleRouting = APP_PATH . '/modules/'. $moduleName .'/config/routes/web.php';
			
	// 		if (file_exists($webModuleRouting) && is_file($webModuleRouting)) {
	// 			include $webModuleRouting;
	// 		}
	// 	}
	// }
	
    $router->removeExtraSlashes(true);
    
	return $router;
};