<?php

Model::include('Kim');

class DebugController extends Controller {

	public function index() {
		$request = $request->validate([
			'email' => ['required','email'],
			'text' => ['required']
		]);
	}
	
}