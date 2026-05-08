<?php
class User {
    public $id;
    public $name;
    public $email;

    public function __construct($name=null, $email=null) {
        $this->name = $name;
        $this->email = $email;
    }
}
echo "user class loaded";