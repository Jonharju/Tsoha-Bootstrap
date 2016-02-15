<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/player_show', function() {
    HelloWorldController::player_show();
  });

  $routes->get('/player_mod', function() {
    HelloWorldController::player_mod();
  });

$routes->get('/team_show', function() {
    HelloWorldController::team_show();
  });

$routes->get('/team_players', function() {
    HelloWorldController::team_players();
  });

$routes->get('/team_events', function() {
    HelloWorldController::team_events();
  });

$routes->get('/event_show', function() {
    HelloWorldController::event_show();
  });

$routes->get('/', function() {
    PlayerController::index();
  });

$routes->get('/player', function() {
    PlayerController::index();
  });

$routes->post('/player', function(){
  PlayerController::store();
});

$routes->get('/player/new', function(){
  PlayerController::create();
});

$routes->get('/player/:id', function($id) {
    PlayerController::show($id);
  });

$routes->get('/player/:id/edit', function($id){
  PlayerController::edit($id);
});

$routes->post('/player/:id/edit', function($id){
  PlayerController::update($id);
});

$routes->post('/player/:id/destroy', function($id){
  PlayerController::destroy($id);
});

$routes->get('/login', function(){
  PlayerController::login();
});

$routes->post('/login', function(){
  PlayerController::handle_login();
});

