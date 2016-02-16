<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

$routes->get('/', function() {
    PlayerController::index();
  });

$routes->get('/login', function(){
  PlayerController::login();
});

$routes->post('/login', function(){
  PlayerController::handle_login();
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


