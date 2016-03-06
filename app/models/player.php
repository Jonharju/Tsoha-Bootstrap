<?php

class Player extends BaseModel{

public $id, $name, $password, $team_id;

public function __construct($attributes) {
	parent::__construct($attributes);
  $this->validators = array('validate_name', 'validate_password');
}

public function validate_name(){
  return $this->validate_string_length("Nimi", $this->name, 3, 30);
}

public function validate_password(){
  return $this->validate_string_length("Salasana", $this->password, 3, 30);
}

public static function all(){
 
    $query = DB::connection()->prepare('SELECT * FROM Player');
    $query->execute();
    $rows = $query->fetchAll();
    $Player = array();

    foreach($rows as $row){
      $Player[] = new Player(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
      ));
    }

    return $Player;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $Player = new Player(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
      ));

      return $Player;
    }

    return null;
  }


  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Player (name, password) VALUES (:name, :password) RETURNING id');
    $query->execute(array('name' => $this->name, 'password' => $this->password));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function update(){
    $query = DB::connection()->prepare('UPDATE Player SET name = :name, password = :password WHERE id = :id');
    $query->execute(array('id' => $this->id, 'name' => $this->name, 'password' => $this->password));
    $row = $query->fetch();
  }

  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Player WHERE id = :id');
    $query->execute(array('id' => $this->id));
  }

  public function authenticate($name, $password){
    $query = DB::connection()->prepare('SELECT * FROM Player WHERE name = :name AND password = :password LIMIT 1');
    $query->execute(array('name' => $name, 'password' => $password));
    $row = $query->fetch();
    if($row){
      $Player = new Player(array(
        'id' => $row['id'],
        'name' => $row['name'],
        'password' => $row['password']
      ));
      return $Player;
    }else{
      return null;
    }
  }
}