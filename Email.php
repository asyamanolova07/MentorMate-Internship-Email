<?php

class Email{

  public $name;
  public $email;
  public $message;
  public $nameErr;
  public $emailErr;
  public $headers;
  public $fromHeaders;

  public function __construct($email, $name, $message, $fromHeaders)
  {
    $this->email = $email;
    $this->name = $name;
    $this->message = $message;
    $this->fromHeaders = $fromHeaders;
    
    //$this->validateData();
  }

  public function validateData()
  {
  	//var_dump($_POST);
  	//Making empty variables for the inputs and their errors
  	$this->nameErr = $this->emailErr = "";
  	//$this->name = $this->email = $this->message = "";
  
  	if ($_SERVER["REQUEST_METHOD"] == "POST")
  	{
  		//Validation for Name input
  		if (empty($this->name)) {
  			$this->nameErr = "Name is required";
  		}
  		else 
  		{
  			$this->name = $this->test_input($this->name);
  			// check if name only contains letters and whitespace
  			if (!preg_match("/^[a-zA-Z ]*$/",$this->name)) {
  				$this->nameErr = "Only letters and white space allowed";
  			}
  		}
  
  		//Validation for email
  		if (empty($this->email)) {
  			$this->emailErr = "Email is required";
  		} 
  		else 
  		{
  			$this->email = $this->test_input($this->email);
  			// Check if e-mail address is well-formed
  			if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
  				$this->emailErr = "Invalid email format";
  			}
  		}
  
  		//Validation for message
  		if (empty($this->message)) {
  			$message = "";
  		}
  		else 
  		{
	  		$this->message = $this->test_input($this->message);
	  		$this->handleHeaders($this->fromHeaders);
  		}
  	}
  
  	//var_dump($_POST);
  }
  
  public function handleHeaders($fromAddress)
  {
  	$this->headers = 'From: ' . $fromAddress . "\r\n" .
  			'Reply-To: webmaster@example.com' . "\r\n" .
  			'X-Mailer: PHP/' . phpversion();
  }
  
  public function sendEmail()
  {
  	if (mail($this->email, $this->name, $this->message, $this->headers)){
  		print_r('Email sent');
  	} else {
  		print_r('Something went wrong');
  	}
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
