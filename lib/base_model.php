<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $errors = array();
      foreach ($this->validators as $validator) {
        $errors = array_merge($errors, $this->{$validator}());
      }
      return $errors;
    }

    public function validate_string_length($field, $string, $min, $max){
      $errors = array();
      if(!is_string($string)) {
        $errors[] = $field . " pitää olla merkkijono";
      }
      if(strlen($string) < $min && $min != 0) {
        $errors[] = $field . " pitää olla vähintään " . $min . " merkkiä";
      }
      if(strlen($string) > $max && $max != 0) {
        $errors[] = $field . " saa olla enintään " . $min . " merkkiä";
      }
      return $errors;
    }

    public function validate_int_length($field, $string, $min, $max){
      $errors = array();
      if(!ctype_digit($string)) {
        $errors[] = $field . " pitää olla vuosiluku";
      }
      if(strlen($string) < $min && $min != 0) {
        $errors[] = $field . " pitää olla " . $min . " merkkiä";
      }
      if(strlen($string) > $max && $max != 0) {
        $errors[] = $field . " pitää olla " . $min . " merkkiä";
      }
      return $errors;
    }
    //public function validate_date($date){
      //$v = new Valitron\Validator(array('date' => $date));
      //$v->rule('date', 'date');
      //if(!$v->validate()){
        //return 'Päivämää väärää muotoa, tulee olla yyyy-mm-dd';
      //}
    //}
  }
