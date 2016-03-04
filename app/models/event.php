<?php

class Event extends BaseModel{

public $id, $description, $time, $place, $team_id;

public function __construct($attributes) {
	parent::__construct($attributes);
  $this->validators = array('validate_description', 'validate_place');
}

public function validate_description(){
  return $this->validate_string_length("Kuvaus", $this->description, 3, 30);
}

public function validate_place(){
  return $this->validate_string_length("Paikka", $this->time, 3, 30);
}

//public function validate_date(){
  //return $this->validate_date("Aika",$this->place,8,8);
//}

public static function all(){
 
    $query = DB::connection()->prepare('SELECT * FROM Event');
    $query->execute();
    $rows = $query->fetchAll();
    $Event = array();

    foreach($rows as $row){
      $Event[] = new Event(array(
        'id' => $row['id'],
        'description' => $row['description'],
        'time' => $row['time'],
        'place' => $row['place'],
        'team_id' => $row['team_id']
      ));
    }

    return $Event;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Event WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $Event = new Event(array(
        'id' => $row['id'],
        'description' => $row['description'],
        'time' => $row['time'],
        'place' => $row['place'],
        'team_id' => $row['team_id']
      ));

      return $Event;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Event (description, time, place, team_id) VALUES (:description, :time, :place, :team_id) RETURNING id');
    $query->execute(array('description' => $this->description, 'time' => $this->time, 'place' => $this->place, 'team_id' => $this->team_id));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function update(){
    $query = DB::connection()->prepare('UPDATE Event SET description = :description, time = :time, place = :place WHERE id = :id');
    $query->execute(array('id' => $this->id, 'description' => $this->description, 'time' => $this->time, 'place' => $this->place));
    $row = $query->fetch();
  }

  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Event WHERE id = :id');
    $query->execute(array('id' => $this->id));
  }
}