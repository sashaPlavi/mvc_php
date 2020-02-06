 <?php

    class Core
    {
        protected $currentControler = 'Pages';
        protected $currentMehtod = 'index';
        protected $params = [];
        public function __construct()
        {
            print_r($this->getUrl());
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
