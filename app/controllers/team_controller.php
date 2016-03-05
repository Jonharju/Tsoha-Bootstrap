<?php

class TeamController extends BaseController{
	
	public static function index(){
		self::check_logged_in();
		$teams = Team::all();
		View::make('Team/index.html', array('teams' =>$teams));
	}

	public static function show($id){
		self::check_logged_in();
		$team = Team::find($id);
		$players = Player::findByTeam($id);
		$events = Event::findByTeam($id);
		View::make('Team/show.html', array('team' => $team, 'players' => $players, 'events' => $events));
	}

	public static function store(){	
    $params = $_POST;
    $Team = new Team(array(
      'name' => $params['name'],
      'year' => $params['year'],
      'city' => $params['city']
    ));
    $errors = $Team->errors();
    if(count($errors) != 0) {
    	View::make('/Team/new.html', array('errors' => $errors, 'team' => $Team));
    } else {
    	$Team->save();
    	Redirect::to('/team/' . $Team->id, array('message' => 'Joukkue luotu!'));
	}
	}

	public static function create(){
		self::check_logged_in();
		View::make('Team/new.html');
	}

	public static function edit($id){
		self::check_logged_in();
		$Team = Team::find($id);
		View::make('Team/edit.html', array('attributes' => $Team));
	}

	public static function update($id){
		$params = $_POST;

		$attributes = array(
			'id' => $id,
			'name' => $params['name'],
      		'year' => $params['year'],
      		'city' => $params['city']
		);

		$Team = new Team($attributes);
		$errors = $Team->errors();

		if(count($errors) != 0){
			View::make('/Team/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		} else{
			$Team->update();
			Redirect::to('/team/' . $Team->id, array('message' => 'Joukkuetta on muokattu onnistuneesti!'));
		}
	}

	public static function destroy($id){
    $Team = new Team(array('id' => $id));
    $Team->destroy();
    Redirect::to('/team', array('message' => 'Joukkue on poistettu onnistuneesti!'));
  }

  public static function join($id){
  	$player = self::get_user_logged_in();
  	$Team = Team::find($id);
  	$player->updateTeam($Team->id);
  	Redirect::to('/team', array('message' => 'Sinut on lisätty joukkueseen'));
  }
}