<?php

    namespace Castels\Middleware;


    class Auth 
    {
        public function __construct()
        {
           $this -> isLoged(); 
        }


        public function isLoged() {
            if( @!$_COOKIE['logged']  )
                header('Location: /login');
        }
    }