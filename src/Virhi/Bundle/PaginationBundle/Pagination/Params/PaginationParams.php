<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/08/2014
 * Time: 14:06
 */

namespace Virhi\Bundle\PaginationBundle\Pagination\Params;


class PaginationParams
{
    protected $idPage;

    protected $route;

    protected $routeParam;

    protected $limit;

    protected $nbElement;

    protected $offset;

    function __construct($route, array $routeParam, $idPage = 0, $limit = 0, $nbElement = 0 )
    {
        $this->idPage     = $idPage;
        $this->limit      = $limit;
        $this->nbElement  = $nbElement;
        $this->route      = $route;
        $this->routeParam = new \ArrayObject($routeParam);
    }

    protected function loadOffset()
    {
        $realPage   = $this->idPage -1;
        if ($realPage < 0)
        {
            $realPage = 0;
        }
        $this->offset = $this->limit * $realPage;
    }

    /**
     * @param mixed $idPage
     */
    public function setIdPage($idPage)
    {
        $this->idPage = (int)$idPage;
    }

    /**
     * @return mixed
     */
    public function getIdPage()
    {
        return $this->idPage;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = (int)$limit;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $nbElement
     */
    public function setNbElement($nbElement)
    {
        $this->nbElement = (int)$nbElement;
    }

    /**
     * @return mixed
     */
    public function getNbElement()
    {
        return $this->nbElement;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        $this->loadOffset();
        return $this->offset;
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
     * @param mixed $routeParam
     */
    public function setRouteParam(\ArrayObject $routeParam)
    {
        $this->routeParam = $routeParam;
    }

    /**
     * @return mixed
     */
    public function getRouteParam()
    {
        return $this->routeParam;
    }
} 