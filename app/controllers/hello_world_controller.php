<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
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
  }
