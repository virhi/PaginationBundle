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
    protected $needToAddRangeToEnd;
    protected $needToAddRangeToStart;


    function __construct(Router $router, $route, ArrayObject $routeParam, $limit, $nbElement = 0, $offset = 0, $range = 0)
    {
        $this->range = $range;
        $this->needToAddRangeToEnd = 0;
        $this->needToAddRangeToStart = 0;
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

        if ($this->needToAddRangeToStart !== 0) {
            $startRange = $this->getStartRange($range + $this->needToAddRangeToStart);
        }

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
        $result = $this->getCurrant()->getId() - $range;
        if ($result < 1) {
            $this->needToAddRangeToEnd = abs($result) + 1;
        }
        return $result;
    }

    protected function getEndRange($range)
    {
        $result = $this->getCurrant()->getId() + $range + $this->needToAddRangeToEnd;

        if (($this->getLastPage()->getId() - $result ) < 0) {
           $this->needToAddRangeToStart = abs($this->getLastPage()->getId() - $result );
        }

        return $result;
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