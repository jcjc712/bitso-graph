<?php
    class Calls
    {
        private $ws = "";
        function __construct(){
            $this->ws = new WS();
        }

        public function getBalance(){
            return $this->ws->call(true, "POST", "/v3/balance/");
        }

        public function getTicker(){
            return $this->ws->call(false, "POST", "/v3/ticker/");
        }


    }
