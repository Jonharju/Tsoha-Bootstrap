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

$routes->post('/logout', function(){
  PlayerController::logout();
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

$routes->get('/team', function() {
  TeamController::index();
});

$routes->post('/team', function(){
  TeamController::store();
});

$routes->get('/team/new', function(){
  TeamController::create();
});

$routes->get('/team/:id', function($id) {
    TeamController::show($id);
});

$routes->get('/team/:id/edit', function($id){
  TeamController::edit($id);
});

$routes->post('/team/:id/edit', function($id){
  TeamController::update($id);
});

$routes->post('/team/:id/destroy', function($id){
  TeamController::destroy($id);
});

$routes->post('/team/:id/join', function($id){
  TeamController::join($id);
});

$routes->get('/event', function() {
  EventController::index();
});

$routes->post('/event', function(){
  EventController::store();
});

$routes->get('/event/new', function(){
  EventController::create();
});

$routes->get('/event/:id', function($id) {
    EventController::show($id);
});

$routes->get('/event/:id/edit', function($id){
  EventController::edit($id);
});

$routes->post('/event/:id/edit', function($id){
  EventController::update($id);
});

$routes->post('/event/:id/destroy', function($id){
  EventController::destroy($id);
});


