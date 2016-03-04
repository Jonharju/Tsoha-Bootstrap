<?php
  

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      $j = new Team(array(
        'name' => 'asi',
        'year' => '2015',
        'city' => 'stadi'));
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      $id = '7';
      $event = Event::find($id);
      $team = Team::find($event->team_id);
      Kint::dump($team);
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }

    public static function player_show(){
      View::make('suunnitelmat/player_show.html');
    }

    public static function player_mod(){
      View::make('suunnitelmat/player_mod.html');
    }

    public static function team_show(){
      View::make('suunnitelmat/team_show.html');
    }

    public static function team_players(){
      View::make('suunnitelmat/team_players.html');
    }

    public static function team_events(){
      View::make('suunnitelmat/team_events.html');
    }

    public static function event_show(){
      View::make('suunnitelmat/event_show.html');
    }
  }
