<?php


namespace App\View;


class Redirect
{
    private $route;

    /**
     * Redirect constructor.
     * @param string $route
     */
    public function __construct(string $route = 'e404')
    {
        $this->setRoute($route);
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route)
    {
        $this->route = $route;
    }

    public function go()
    {
        return redirect($this->route);
    }
}