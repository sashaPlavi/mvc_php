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
