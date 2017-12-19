<?php
    class WS
    {
        private $nonce;
        public function call($signature, $httpmethod, $requestPath){
            if($signature){
                $authHeader = $this->createSignature($httpmethod, $requestPath, "");
            } else{
                $authHeader = "";
            }
            $uri      = BITSO_BASE_URL.$requestPath;
            try{
              $response = \Httpful\Request::post($uri)
                  ->addHeader('Authorization', $authHeader)
                  ->sendsJson()
                  ->expectsJson()
                  ->sendIt();
              if($response->body->success){
                return $response;
              }else{
                if(isset($response->body->error)){
                  $code =  $response->body->error->code;
                  $msg  = $response->body->error->message;
                  $json = $response->raw_body;
                  Historic::apiError($code, $msg, $json);
                }
                return false;
              }
            } catch(Exception $e){
              $code = 0;
              $msg  = $e->getMessage();
              $json = 0;
              Historic::apiError($code, $msg, $json);

            }

        }

        public function createSignature($httpmethod, $requestPath, $JSONPayload){
            $nonce = round(microtime(true) * 1000);
            $JSONPayload = "";
            // Create signature
            $message   = $nonce . $httpmethod . $requestPath . $JSONPayload;
            $signature = hash_hmac('sha256', $message, BITSO_SECRET);
            // Build the auth header
            $format     = 'Bitso %s:%s:%s';
            $authHeader =  sprintf($format, BITSO_KEY, $nonce, $signature);
            return $authHeader;
        }
    }
