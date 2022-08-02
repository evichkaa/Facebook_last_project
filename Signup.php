<?php

//include ("classes/connect.php");
//include ("Signup.php");
class SignUp{
    private $error = "";

    public function  evaluate_date($data)
    {

        foreach ($data as $key => $value) {
            if (empty($value)) {

                $this->error = $this->error . $key . " is empty <br>";

            }
            if ($key == "email") {
                if (!preg_match("/([\w\-]+@[\w\-]+[\w\-]+)/", $value)) {
                    $this->error = $this->error . " please enter valid email adress! <br>";
                }
            }
            if ($key == "first_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error . " First name can`t be number  <br>";
                }
                if (strstr($value, " ")) {
                    $this->error = $this->error . " First name can`t have space  <br>";
                }
            }
            if ($key == "last_name") {
                if (is_numeric($value)) {
                    $this->error = $this->error . " Last name can`t be number <br>";
                }
                if (strstr($value, " ")) {
                    $this->error = $this->error . " Last name can`t have space  <br>";
                }

            }
        }
        if ($this->error == "") {
            //no error
            $this->create_user($data);
        } else {
            return $this->error;
        }
    }



    public function create_user($data){

        $first_name= ucfirst($data['first_name']);
        $last_name=ucfirst($data['last_name']);
        $gender=$data['gender'];
        $email=$data['email'];
        $password=$data['password'];

        $password = hash("sha1", $password);

//        create these
        $url_adress= strtolower($first_name) . "." . strtolower($last_name);
        $userid=$this->create_userid();


        $query = "insert into users
            (userid,first_name,last_name,gender,email,password,url) 
            values 
            ('$userid','$first_name','$last_name','$gender','$email','$password','$url_adress')";


        $DB= new Database();
        $DB -> save($query);
        echo $query;


    }

//    private function create_url(){
//
//
//    }
    private  function create_userid(){

        $length = rand(4,19);
        $number = "";
        for($i=0; $i < $length;$i++){
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }
        return $number;
    }


}