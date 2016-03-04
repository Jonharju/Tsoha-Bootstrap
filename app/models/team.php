<?php

class Team extends BaseModel{

public $id, $name, $year, $city;

public function __construct($attributes) {
	parent::__construct($attributes);
  $this->validators = array('validate_name', 'validate_city', 'validate_year');
}

public function validate_name(){
  return $this->validate_string_length("Nimi", $this->name, 3, 30);
}

public function validate_city(){
  return $this->validate_string_length("Kaupunki", $this->city, 3, 30);
}

public function validate_year(){
  return $this->validate_int_length("Vuosi", $this->year,4,4);
}

public static function all(){
 
    $query = DB::connection()->prepare('SELECT * FROM Team');
    $query->execute();
    $rows = $query->fetchAll();
    $Team = array();

    foreach($rows as $row){
      $Team[] = new Team(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'year' => $row['year'],
        'city' => $row['city']
      ));
    }

    return $Team;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Team WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $Team = new Team(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'year' => $row['year'],
        'city' => $row['city']
      ));

      return $Team;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Team (name, year, city) VALUES (:name, :year, :city) RETURNING id');
    $query->execute(array('name' => $this->name, 'year' => $this->year, 'city' => $this->city));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function update(){
    $query = DB::connection()->prepare('UPDATE Team SET name = :name, year = :year, city = :city WHERE id = :id');
    $query->execute(array('id' => $this->id, 'name' => $this->name, 'year' => $this->year, 'city' => $this->city));
    $row = $query->fetch();
  }

  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Team WHERE id = :id');
    $query->execute(array('id' => $this->id));
  }
}