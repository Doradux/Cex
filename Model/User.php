<?php
if (session_status() == PHP_SESSION_NONE) session_start();

class User
{
    private $id;
    private $username;
    private $displayname;
    private $email;
    private $image;
    public function __construct($id, $e, $u, $dn, $i)
    {
        $this->id = $id;
        $this->email = $e;
        $this->username = $u;
        $this->displayname = $dn;
        $this->image = $i;
    }
}
