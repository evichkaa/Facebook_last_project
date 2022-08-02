<?php
class Login{

    private $error = "";


    public function evaluate($data){

        $email=addslashes($data['email']);
        $password=addslashes($data['password']);


        $query = "select * from users where email = '$email' limit 1 ";


        $DB= new Database();
        $result = $DB -> read($query);

        if($result){

            $row = $result[0];
            if(hash("sha1", $password) == $row['password']){

                //create session data
                $_SESSION['facebook_userid'] = $row['userid'];


            }else {
                $this->error .="Wrong email or password <br>";
            }
        }else{
            $this->error .="Wrong email or password <br>";
        }
        return $error;

//        echo $query;


    }

// to delete, not working
//    public function hash_pass($text){
//
//        $text=hash("sha1",$text);
//        return $text;
//    }




    public  function  check_login($id){
        if(is_numeric($id)){
            $query = "select * from users where userid = '$id' limit 1 ";

            $DB= new Database();
            $result = $DB -> read($query);

            if($result){
                $user_data = $result[0];
                return $user_data;

            }else {
                header("Location: LoginPage.php");
                die;
            } return false;


        }else{
            header("Location: LoginPage.php");
            die;
        }
    }
}

