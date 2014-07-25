<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 26/03/2014
 * Time: 10:47
 */

namespace Virhi\Bundle\PaginationBundle\Pagination;

use \ArrayObject;
use Symfony\Component\Routing\Router;

class Page
{

    protected $id;

    protected $route;

    /**
     * @var bool
     */
    protected $current;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var \ArrayObject
     */
    protected $routeParam;

    /**
     * @var bool
     */
    protected $display;

    /**
     * @var \Symfony\Component\Routing\Router;
     */
    protected $router;

    /**
     * @param $id
     * @param $route
     * @param ArrayObject $routeParam
     * @param bool $current
     */
    function __construct($id, Router $router, $route, ArrayObject $routeParam, $current = false, $display = true)
    {
        $this->id         = $id;
        $this->route      = $route;
        $this->current    = $current;
        $this->routeParam = $routeParam;
        $this->router     = $router;
        $this->display    = $display;

        $this->buildUrl();
    }

    public function buildUrl()
    {
        $this->getRouteParam()->offsetSet('page', $this->getId());
        $this->setUrl($this->getRouter()->generate($this->getRoute(), $this->getRouteParam()->getArrayCopy()));
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param boolean $curent
     */
    public function setCurrent($curent)
    {
        $this->current = $curent;
    }

    /**
     * @return boolean
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @param \ArrayObject $routeParam
     */
    public function setRouteParam($routeParam)
    {
        $this->routeParam = $routeParam;
    }

    /**
     * @return \ArrayObject
     */
    public function getRouteParam()
    {
        return $this->routeParam;
    }

    /**
     * @param \Symfony\Component\Routing\Router $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @return \Symfony\Component\Routing\Router
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param boolean $display
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }

    /**
     * @return boolean
     */
    public function getDisplay()
    {
        return $this->display;
    }
}