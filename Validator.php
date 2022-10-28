<?php

class Validator{
    private $formErrors = [];

    public function empty($name, $input){
        if(empty($input)){
            $this->formErrors[] = "$name can not be empty";
        }
    }

    public function username($name, $input){
        if(!preg_match('/^[a-z0-9 ]+$/', $input)){
            $this->formErrors[] = "Invalid $name";
        }
    }

    public function email($name, $input){
        if(!filter_var($input, FILTER_VALIDATE_EMAIL)){
            $this->formErrors[] = "Invalid $name";
        }
    }

    public function min($name, $input, $min){
        if($input < $min){
            $this->formErrors[] = "$name can not be shorter than $min";
        }
    }

    public function max($name, $input, $max){
        if($input > $max){
            $this->formErrors[] = "$name can not be greater than $max";
        }
    }

    public function match($name, $input, $matchName, $match){
        if($input != $match){
            $this->formErrors[] = "$name does not equal $matchName";
        }
    }

    public function integer($name, $input){
        if(!filter_var($input, FILTER_VALIDATE_INT)){
            $this->formErrors[] = "$name shoube be a number";
        }
    }

    public function getErrors(){
        return $this->formErrors;
    }
}