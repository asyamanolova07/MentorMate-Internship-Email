<?php

class Email{

  public $name;
  public $email;
  public $message;
  public $nameErr;
  public $emailErr;

  public function __constructor($email, $name, $message)
  {
    $this->email = $email;
    $this->name = $name;
    $this->message = $message;
  }


  
  public function sendEmail(){
  	mail($this->email, $this->name, $this->message);
  }

    //Function for manipulating the input data
   public function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

}

?>
