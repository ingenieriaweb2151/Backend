<?php

class AlumController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	*/


	public function getIndex()
    {
        return View::make('index');
    }

    
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}

	public function getRegister() {
		$this->layout->content = View::make('users.register');
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), User::$rules);
		if ($validator->passes()) {
			$user = new User;
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::to('users/login')->with('message', 'Thanks for registering!');
		} else {
			return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}

	public function getLogin() {
		$this->layout->content = View::make('users.login');
	}

	public function postSignin() {


		$user = DB::select('select * from dalums where aluctr = ? and alucll = ?', array(Input::get('aluctr'),Input::get('alucll')));

	
		if ($user != null) {
			return "Encontrado";
		} else {
			return "no encontrado";
		}
		
	}


	public function getDashboard() {
		$this->layout->content = View::make('users.dashboard');
	}
	public function getLogout() {
		Auth::logout();
		return Redirect::to('users/login')->with('message', 'Your are now logged out!');
	}


	


}
