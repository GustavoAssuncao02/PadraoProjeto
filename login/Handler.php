<?php

require_once "conect.php";

abstract class Handler {
    protected $successor;

    public function setSuccessor(Handler $successor) {
        $this->successor = $successor;
    }

    public abstract function handleRequest($email, $senha);
}

