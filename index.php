<?php
    class Facade
    {
        private $requestPath;

        public function __construct()
        {
            $this->requestPath = $_SERVER['PATH_INFO'] ?? '/';
        }

        public function connectApi(string $actionName)
        {
            if(in_array($this->requestPath, 'api')) {
                $classNamespace = 'Routes\\Api';
                $this->classObj = new $classNamespace;
                call_user_func(array($this->classObj, $actionName));
            }
        }
    }
?>