<?php
require_once "facade.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $authFacade = new Facade();
    $authFacade->login($email, $senha);
}
