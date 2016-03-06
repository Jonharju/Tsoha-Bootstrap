<?php

class Teammember extends BaseModel{

public $id, $player_id, $team_id;

public function __construct($attributes) {
	parent::__construct($attributes);
}
public static function findByBoth($player_id, $team_id){
	$query = DB::connection()->prepare('SELECT id FROM Teammember WHERE player_id = :player_id AND team_id = :team_id');
    $query->execute(array('player_id' => $player_id, 'team_id' => $team_id));
    $row = $query->fetch();
    if($row){
      $Teammember = new Teammember(array(
        'id' => $row['id']
      ));
      return $Teammember;
    }
    return null;
}

public static function findByPlayer($player_id){
	$query = DB::connection()->prepare('SELECT team_id FROM Teammember WHERE player_id = :player_id');
    $query->execute(array('player_id' => $player_id));
    $rows = $query->fetchAll();
    $Team = array();
    foreach($rows as $row){
      $Team[] = Team::find($row['team_id']);
    }
    return $Team;;
}

public static function findByTeam($team_id){
	$query = DB::connection()->prepare('SELECT player_id FROM Teammember WHERE team_id = :team_id');
    $query->execute(array('team_id' => $team_id));
    $rows = $query->fetchAll();
    $Player = array();
    foreach($rows as $row){
      $Player[] = Player::find($row['player_id']);
    }
    return $Player;;
}

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Teammember (player_id, team_id) VALUES (:player_id, :team_id) RETURNING id');
    $query->execute(array('player_id' => $this->player_id, 'team_id' => $this->team_id));
    $row = $query->fetch();
    $this->id = $row['id'];
  }


  public function destroy($player_id, $team_id){
    $query = DB::connection()->prepare('DELETE FROM Teammember WHERE player_id = :player_id, team_id = :team_id');
    $query->execute(array('player_id' => $this->player_id, 'team_id' => $this->team_id));
  }
}