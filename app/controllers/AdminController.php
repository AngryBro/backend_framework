<?php
include '../app/Controller.php';
include '../app/models/Admin.php';

class AdminController extends Controller {
	
	public function view() {
		$admin = new View('admin');
		$admin->render();
	}
	
	public function unregister() {
		$admin = new Admin('Users');
		$json = $_POST['json'];
		$users = json_decode($json,false);
		$admin->unregister($users);
		header('Location: /admin/unregister');
	}

	public function unregView() {
		$admin = new Admin('Users');
		$users = $admin->getUsers();
		$view = new View('unregister');
		$view->render([
			'users' => $users
		]);
	}

}