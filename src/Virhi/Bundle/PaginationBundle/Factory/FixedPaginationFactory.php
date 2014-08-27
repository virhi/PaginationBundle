<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/08/2014
 * Time: 13:58
 */

namespace Virhi\Bundle\PaginationBundle\Factory;

use Virhi\Bundle\PaginationBundle\Pagination\FixedPagination;
use Virhi\Bundle\PaginationBundle\Pagination\Params\RangePaginationParams;


class FixedPaginationFactory
{

    protected $router;

    function __construct($router)
    {
        $this->router = $router;
    }

    /**
     * @return FixedPagination
     */
    public function getPagination(RangePaginationParams $params)
    {
        $pagination = new FixedPagination(
            $this->router,
            $params->getRoute(),
            $params->getRouteParam(),
            $params->getLimit(),
            $params->getNbElement(),
            $params->getOffset(),
            $params->getRange()
        );

        return $pagination;
    }
} 