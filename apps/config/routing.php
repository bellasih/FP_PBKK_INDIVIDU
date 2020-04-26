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
			'action'     	=> 'error404',
		]
	);

	/*
	* Cek routing module dashboard
	*/
	$router->addGet('/home', [
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller' 	=> 'Authentication',
		'action' 		=> 'home'
	]);

	$router->addGet('/login', [
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller' 	=> 'Authentication',
		'action' 		=> 'createLogin'
	]);

	$router->addPost('/login', [
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller' 	=> 'Authentication',
		'action' 		=> 'storeLogin'
	]);

	$router->addGet('/logout', [
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller' 	=> 'Authentication',
		'action' 		=> 'logout'
	]);

	$router->addPost('/add/admin',[
		'namespace'		=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller'	=> 'Index',
		'action'		=> 'storeAdmin'
	]);

	$router->addGet('/profile',[
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller'	=> 'Authentication',
		'action'		=> 'showAccount'
	]);

	$router->addPost('/update/user',[
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller'	=> 'Authentication',
		'action'		=> 'updateProfile'
	]);

	$router->addPost('/update/password',[
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller'	=> 'Authentication',
		'action'		=> 'changePassword'
	]);

	$router->addPost('/update/image',[
		'namespace' 	=> 'ServiceLaundry\Dashboard\Controllers\Web',
		'module'		=> 'dashboard',
		'controller'	=> 'Authentication',
		'action'		=> 'changeProfilImage'
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

	$router->addPost('/update/expense',[
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

	$router->addPost('/update/goods',[
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

	$router->addPost('/update/order',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Order',
		'action'		=> 'updateOrder'
	]);

	$router->addGet('/order/users',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'UserOrder',
		'action'		=> 'createOrder'
	]);

	$router->addPost('/order/users',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'UserOrder',
		'action'		=> 'storeOrder'
	]);

	/*
	* Cek routing module order : payment
	*/
	$router->addGet('/payment',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Payment',
		'action'		=> 'index'
	]);

	$router->addPost('/add/payment',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Payment',
		'action'		=> 'storePayment'
	]);

	$router->addPost('/payment',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Payment',
		'action'		=> 'deletePayment'
	]);

	$router->addPost('/update/payment',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Payment',
		'action'		=> 'updatePayment'
	]);

	/*
	* Cek routing module order : service
	*/
	$router->addGet('/service',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Service',
		'action'		=> 'index'
	]);

	$router->addPost('/add/service',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Service',
		'action'		=> 'storeService'
	]);

	$router->addPost('/service',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Service',
		'action'		=> 'deleteService'
	]);

	$router->addPost('/update/service',[
		'namespace'		=> 'ServiceLaundry\Order\Controllers\Web',
		'module'		=> 'order',
		'controller'	=> 'Service',
		'action'		=> 'updateService'
	]);

	/*
	* Cek routing module delivery
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

	$router->addPost('/edit/pickup_delivery',[
		'namespace'		=> 'ServiceLaundry\PickupDelivery\Controllers\Web',
		'module'		=> 'pickup_delivery',
		'controller'	=> 'PickupDelivery',
		'action'		=> 'updatePickupDelivery'
	]);
	
    $router->removeExtraSlashes(true);
    
	return $router;
};