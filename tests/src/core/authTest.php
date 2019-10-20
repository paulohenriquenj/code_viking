<?php

use viking\core\auth;

class authTest extends PHPUnit\Framework\TestCase{
    
    public function testIfSessionIsCorrectSet()
    {
       auth::registerLoginSession(['user']);

       $this->assertNotEmpty($_SESSION['user']);

    }

    public function testIfLogoutInfoIsCorrectRemovedFromSession()
    {
       auth::clearLoginInfo();

       $this->assertArrayNotHasKey('user', $_SESSION);

    }

    public function testLoggedVerification()
    {
        $this->assertFalse(auth::isLogged());
    }

}