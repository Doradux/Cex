<?php
if (session_status() == PHP_SESSION_NONE) session_start();

class Server
{
    private $id;
    private $name;
    private $creationTime;
    private $image;
    private $grandImage;
    public function __construct($id, $n, $ct, $i, $gi)
    {
        $this->id = $id;
        $this->name = $n;
        $this->creationTime = $ct;
        $this->image = $i;
        $this->grandImage = $gi;
    }
}
