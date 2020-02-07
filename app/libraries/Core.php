 <?php

    class Core
    {
        protected $currentControler = 'Pages';
        protected $currentMehtod = 'index';
        protected $params = [];
        public function __construct()
        {
            $url = ($this->getUrl());
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentControler = ucwords($url[0]);
                //unset 0 index : )
                unset($url[0]);
            }
            require_once '../app/controllers/' . $this->currentControler . '.php';

            $this->currentControler = new $this->currentControler;
            //second part of url
            if (isset($url[1])) {
                if (method_exists($this->currentControler, $url[1])) {
                    $this->currentMehtod = $url[1];
                    unset($url[1]);
                }
            }
            //echo $this->currentMehtod;
            //params
            $this->params = $url ? array_values($url) : [];
            //callback with arr of params
            call_user_func_array([$this->currentControler, $this->currentMehtod], $this->params);
        }
        public function getUrl()
        {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
