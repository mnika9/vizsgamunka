<?php

    class Manager{

        private int     $id;
        private string  $lastname;
        private string  $firstname;
        private int     $title;
        private string  $username;
        private string  $password;
        private string  $email;
        private int     $phone_number;
        private bool    $status;


        public function __construct ( string $lastname,  string $firstname, int $title, string $username,  string $password, string $email, int $phone_number, bool $status){
            $this->lastname = $lastname;
            $this->firstname = $firstname;
            $this->title = $title;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->phone_number = $phone_number;
            $this->status = $status;
        }


        public function getlastName(){
            return $this->lastname;
        }

        public function getFirstName(){
            return $this->firstname;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getUsername(){
            return $this->username;
        }
    
        public function getPassword(){
            return $this->password;
        }

        public function getEmail(){
            return $this->email;
        }
        public function getPhoneNumber(){
            return $this->phone_number;
        }
        public function getSatus(){
            return $this->status;
        }


    }

?>