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
    PelaajaController::index();
  });

$routes->get('/pelaaja', function() {
    PelaajaController::index();
  });

$routes->post('/pelaaja', function(){
  PelaajaController::store();
});

$routes->get('/pelaaja/new', function(){
  PelaajaController::create();
});

$routes->get('/pelaaja/:id', function($id) {
    PelaajaController::show($id);
  });

