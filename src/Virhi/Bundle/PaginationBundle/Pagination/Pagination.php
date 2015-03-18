<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 26/03/2014
 * Time: 10:49
 */

namespace Virhi\Bundle\PaginationBundle\Pagination;

use \ArrayObject;
use Virhi\Bundle\PaginationBundle\Pagination\Page;
use Symfony\Component\Routing\Router;

class Pagination
{
    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var int
     */
    protected $nbElement;

    /**
     * @var \ArrayObject
     */
    protected $listPage;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    protected $currant;

    /**
     * @var \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    protected $firstPage;

    /**
     * @var \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    protected $lastPage;

    /**
     * @var \Symfony\Component\Routing\Router;
     */
    protected $router;

    /**
     * @var \ArrayObject
     */
    protected $routeParam;

    function __construct(Router $router, $route, ArrayObject $routeParam, $limit, $nbElement = 0, $offset = 0)
    {
        $this->setLimit($limit);
        $this->setNbElement($nbElement);
        $this->setOffset($offset);

        $this->route      = $route;
        $this->router     = $router;
        $this->routeParam = $routeParam;
        $this->listPage   = new \ArrayObject();

        $this->buildListPage();
    }

    public function buildListPage()
    {
        if ($this->nbElement > $this->limit) {
            for ($pas = 1, $index = 1; $pas <= $this->nbElement; $pas += $this->limit, $index++) {
                $page = new Page($index, $this->router, $this->route, $this->routeParam);
                if ((int)$this->offset === (int)$page->getId()) {
                    $page->setCurrent(true);
                    $this->setCurrant($page);
                }

                $this->listPage->offsetSet($page->getId(), $page);
            }
        }

        $this->buildFristPage();
        $this->buildLastPage();
    }

    public function buildFristPage()
    {
        $page = null;
        if ($this->listPage->count() > 0) {
            $page = $this->listPage->offsetGet(1);
        }
        $this->firstPage = $page;
    }

    public function buildLastPage()
    {
        $page = null;
        if ($this->listPage->count() > 0) {
            $page = $this->listPage->offsetGet($this->listPage->count());
        }
        $this->lastPage = $page;
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
     * @param mixed $listPage
     */
    public function setListPage($listPage)
    {
        $this->listPage = $listPage;
    }

    /**
     * @return \ArrayObject
     */
    public function getListPage()
    {
        return $this->listPage;
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
     * @param mixed $offset
     */
    public function setOffset($offset)
    {
        $this->offset = (int)$offset;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
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
     * @return mixed
     */
    public function getFirstPage()
    {
        return $this->firstPage;
    }

    /**
     * @return mixed
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }

    /**
     * @param \Virhi\Bundle\PaginationBundle\Pagination\Page $currant
     */
    public function setCurrant($currant)
    {
        $this->currant = $currant;
    }

    /**
     * @return \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    public function getCurrant()
    {
        return $this->currant;
    }
}