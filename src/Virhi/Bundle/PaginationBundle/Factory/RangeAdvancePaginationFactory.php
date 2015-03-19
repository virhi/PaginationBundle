<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 19/03/2015
 * Time: 09:43
 */

namespace Virhi\Bundle\PaginationBundle\Factory;

use Virhi\Bundle\PaginationBundle\Pagination\RangeAdvancePagination;
use Virhi\Bundle\PaginationBundle\Pagination\Params\PaginationParams;
use Virhi\Bundle\PaginationBundle\Pagination\Params\RangePaginationParams;

class RangeAdvancePaginationFactory extends FixedPaginationFactory
{
    /**
     * @param PaginationParams $params
     * @return RangeAdvancePagination
     */
    public function getPagination(PaginationParams $params)
    {
        if (!$params instanceof RangePaginationParams) {
            throw new \RuntimeException('Wrong Pagination Params, need RangePaginationParams');
        }

        $pagination = new RangeAdvancePagination(
            $this->router,
            $params->getRoute(),
            $params->getRouteParam(),
            $params->getLimit(),
            $params->getNbElement(),
            $params->getIdPage(),
            $params->getRange()
        );

        return $pagination;
    }
}