<?php
if (session_status() == PHP_SESSION_NONE) session_start();

class Server
{
    private $id;
    private $name;
    private $creationTime;
    private $image;
    public function __construct($id, $n, $ct, $i)
    {
        $this->id = $id;
        $this->name = $n;
        $this->creationTime = $ct;
        $this->image = $i;
    }
}
