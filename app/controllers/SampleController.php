<?php

Model::include('Sample');

class SampleController extends Controller {
	

	function index() {
		echo 'SampleController -> index()';
	}

	function sample() {
		echo 'SampleController -> sample()';
	}
	
}