<?php

class PlayerController extends BaseController{
	
	public static function index(){
		$players = Player::all();
		View::make('Player/index.html', array('players' =>$players));
	}

	public static function show($id){
		$player = Player::find($id);
		View::make('Player/show.html', array('player' => $player));
	}

	public static function store(){	
    $params = $_POST;
    $Player = new Player(array(
      'name' => $params['name'],
      'password' => $params['password']
    ));
    $errors = $Player->errors();
    if(count($errors) != 0) {
    	View::make('/player/new.html', array('errors' => $errors, 'player' => $Player));
    } else {
    	$Player->save();
    	Redirect::to('/player/' . $Player->id, array('message' => 'Pelaaja luotu!'));
	}
	}

	public static function create(){
		View::make('Player/new.html');
	}

	public static function edit($id){
		$Player = Player::find($id);
		View::make('Player/edit.html', array('attributes' => $Player));
	}

	public static function update($id){
		$params = $_POST;

		$attributes = array(
			'id' => $id,
			'name' => $params['name'],
      		'password' => $params['password']
		);

		$Player = new Player($attributes);
		$errors = $Player->errors();

		if(count($errors) != 0){
			View::make('/player/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		} else{
			$Player->update();
			Redirect::to('/player/' . $Player->id, array('message' => 'Pelaajaa on muokattu onnistuneesti!'));
		}
	}

	public static function destroy($id){
    $Player = new Player(array('id' => $id));
    $Player->destroy();
    Redirect::to('/player', array('message' => 'Peli on poistettu onnistuneesti!'));
  }

  public static function login(){
  	View::make('/player/login.html');
  }

  public static function handle_login(){
  	$params = $_POST;
  	$Player = Player::authenticate($params['name'], $params['password']);
  	if(!$Player) {
  		View::make('/player/login.html', array('error' => 'väärä käyttäjätunnus tai salasana'));
  	} else {
  		$_SESSION['user'] = $Player->id; 
  		Redirect::to('/player', array('message' => 'Tervetuloa takaisin! ' .$Player->name));
  	}
  }
}