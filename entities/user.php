<?php
class User
{
    public $username = null;
    public $password = null;

    public function __construct($data = [])
    {
        if (isset($data['username']) && $data['username'] !== '') {
            $this->username = $data['username'];
        }
        if (isset($data['password']) && $data['password'] !== '') {
            $this->password = $data['password'];
        }
    }
}
