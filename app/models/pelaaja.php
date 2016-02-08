<?php

class Pelaaja extends BaseModel{

public $id, $nimi, $salasana, $joukkue_id;

public function _construct($attributes) {
	parent::_construct($attributes);
}

public static function all(){
 
    $query = DB::connection()->prepare('SELECT * FROM Pelaaja');
    $query->execute();
    // Haetaan kyselyn tuottamat rivit
    $rows = $query->fetchAll();
    $games = array();

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $pelaaja[] = new Pelaaja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'salasana' => $row['salasana'],
        'joukkue_id' => $row['joukkue_id']
      ));
    }

    return $pelaaja;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Pelaaja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $pelaaja = new Pelaaja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'salasana' => $row['salasana'],
        'joukkue_id' => $row['joukkue_id']
      ));

      return $pelaaja;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Pelaaja (nimi, salasana) VALUES (:nimi, :salasana) RETURNING id');
    $query->execute(array('nimi' => $this->nimi, 'salasana' => $this->salasana));
    $row = $query->fetch();
    $this->id = $row['id'];
  }
}