<?php

class PelaajaController extends BaseController{
	
	public static function index(){
		$pelaajat = Pelaaja::all();
		View::make('pelaaja/index.html', array('pelaajat' =>$pelaajat));
	}

	public static function show($id){
		$pelaaja = Pelaaja::find($id);
		View::make('pelaaja/show.html', array('pelaaja' => $pelaaja));
	}

	public static function store(){	
    $params = $_POST;
    $pelaaja = new Pelaaja(array(
      'nimi' => $params['nimi'],
      'salasana' => $params['salasana']
    ));
    $pelaaja->save();
    Redirect::to('/pelaaja/' . $pelaaja->id, array('message' => 'Pelaaja luotu!'));
	}

	public static function create(){
		View::make('pelaaja/new.html');
	}

}