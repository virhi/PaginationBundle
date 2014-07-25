<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 10/04/2014
 * Time: 12:27
 */

namespace Virhi\Bundle\PaginationBundle\Pagination;

use \ArrayObject;
use Symfony\Component\Routing\Router;

class AdvancePagination extends Pagination
{

    /**
     * @var \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    protected $previous;

    /**
     * @var \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    protected $next;

    function __construct(Router $router, $route, ArrayObject $routeParam, $limit, $nbElement = 0, $offset = 0)
    {
        parent::__construct($router, $route, $routeParam, $limit, $nbElement, $offset);
        $this->buildPrevious();
        $this->buildNext();
    }

    public function buildPrevious()
    {
        if ($this->getCurrant() instanceof Page && $this->getCurrant()->getId() > 1) {
            $previousId = $this->getCurrant()->getId() - 1;
            $this->setPrevious($this->listPage->offsetGet($previousId));
        }
    }

    public function buildNext()
    {
        if ($this->getCurrant() instanceof Page && $this->getCurrant()->getId() < $this->listPage->count()) {
            $nextId = $this->getCurrant()->getId() + 1;
            $this->setNext($this->listPage->offsetGet($nextId));
        }
    }

    /**
     * @param \Virhi\Bundle\PaginationBundle\Pagination\Page $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @return \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param \Virhi\Bundle\PaginationBundle\Pagination\Page $previous
     */
    public function setPrevious($previous)
    {
        $this->previous = $previous;
    }

    /**
     * @return \Virhi\Bundle\PaginationBundle\Pagination\Page
     */
    public function getPrevious()
    {
        return $this->previous;
    }
} 