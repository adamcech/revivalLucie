<?php


class Routes {

    /** @var Routes $singleton */
    private static $singleton = null;

    /** @var array $routes contains parsed uri */
    public $routes;

    private function __construct($routes) {
        $this->routes = $routes;
    }

    /**
     * @return Routes
     */
    public static function getRoutes() {
        if (Routes::$singleton == null) {
            $uris = explode('/', parse_url((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", PHP_URL_PATH));
            $routes = [];
            for ($i = 1; $i < count($uris); $i++) {
                $routes[] = $uris[$i];
            }
            Routes::$singleton = new Routes($routes);
        }

        return Routes::$singleton;
    }

    /**
     * @param int $index of route
     * @return string
     */
    public static function getRouteByIndex($index) {
        return Routes::getRoutes()->routes[$index];
    }

    /**
     * @return int
     */
    public static function getRoutesLength() {
        return count(Routes::getRoutes()->routes);
    }
}
