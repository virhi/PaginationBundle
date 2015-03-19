<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 11/04/2014
 * Time: 10:14
 */

namespace Virhi\Bundle\PaginationBundle\Pagination;

use \ArrayObject;
use Symfony\Component\Routing\Router;

class FixedPagination extends AdvancePagination
{
    /**
     * @var int
     */
    protected $range;



    function __construct(Router $router, $route, ArrayObject $routeParam, $limit, $nbElement = 0, $offset = 0, $range = 0)
    {
        $this->range = $range;
        parent::__construct($router, $route, $routeParam, $limit, $nbElement, $offset);

    }

    public function buildListPage()
    {
        parent::buildListPage();
        if ($this->getCurrant() instanceof Page) {
            $this->filterRange($this->range);
        }
    }

    public function filterRange($range)
    {
        $startRange = $this->getStartRange($range);
        $endRange   = $this->getEndRange($range);

        if ($range > 0) {
            foreach ($this->getListPage() as $page) {
                if ($page instanceof Page &&  ($page->getId() < $startRange || $page->getId() > $endRange) ) {
                    $page->setDisplay(false);
                }
            }
        }
    }

    protected function getStartRange($range)
    {
        return $this->getCurrant()->getId() - $range;
    }

    protected function getEndRange($range)
    {
            return $this->getCurrant()->getId() + $range ;
    }

    /**
     * @param mixed $range
     */
    public function setRange($range)
    {
        $this->range = $range;
    }

    /**
     * @return mixed
     */
    public function getRange()
    {
        return $this->range;
    }
} 