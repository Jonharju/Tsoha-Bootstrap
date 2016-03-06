<?php

class EventController extends BaseController{
	
	public static function index(){
		self::check_logged_in();
		$events = Event::all();
		View::make('Event/index.html', array('events' =>$events));
	}

	public static function show($id){
		self::check_logged_in();
		$user = self::get_user_logged_in();
		$event = Event::find($id);
		$team = Team::find($event->team_id);
		$member = Teammember::findByBoth($user->id, $team->id);
		View::make('Event/show.html', array('event' => $event, 'team' => $team, 'member' => $member));
	}

	public static function store(){	
    $params = $_POST;
    $team = $params['team'];
    $Event = new Event(array(
      'description' => $params['description'],
      'time' => $params['time'],
      'place' => $params['place'],
      'team_id' => $team
    ));
    $errors = $Event->errors();
    if(count($errors) != 0) {
    	View::make('/Event/new.html', array('errors' => $errors, 'event' => $Event));
    } else {
    	$Event->save();
    	Redirect::to('/event/' . $Event->id, array('message' => 'Tapahtuma luotu!'));
	}
	}

	public static function create(){
		self::check_logged_in();
		$p = self::get_user_logged_in();
		$teams = Teammember::findByPlayer($p->id);
		View::make('Event/new.html', array('teams' => $teams));
	}

	public static function edit($id){
		self::check_logged_in();
		$Event = Event::find($id);
		View::make('Event/edit.html', array('attributes' => $Event));
	}

	public static function update($id){
		$params = $_POST;

		$attributes = array(
			'id' => $id,
			'description' => $params['description'],
      		'time' => $params['time'],
      		'place' => $params['place']
		);

		$Event = new Event($attributes);
		$errors = $Event->errors();

		if(count($errors) != 0){
			View::make('/Event/edit.html', array('errors' => $errors, 'attributes' => $attributes));
		} else{
			$Event->update();
			Redirect::to('/event/' . $Event->id, array('message' => 'Tapahtumaa on muokattu onnistuneesti!'));
		}
	}

	public static function destroy($id){
    $Event = new Event(array('id' => $id));
    $Event->destroy();
    Redirect::to('/event', array('message' => 'Tapahtuma on poistettu onnistuneesti!'));
  }
}