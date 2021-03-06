<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/08/2014
 * Time: 13:58
 */

namespace Virhi\Bundle\PaginationBundle\Factory;

use Virhi\Bundle\PaginationBundle\Pagination\FixedPagination;
use Virhi\Bundle\PaginationBundle\Pagination\Params\PaginationParams;
use Virhi\Bundle\PaginationBundle\Pagination\Params\FixedPaginationParams;


class FixedPaginationFactory extends PaginationFactory
{

    /**
     * @return FixedPagination
     */
    public function getPagination(PaginationParams $params)
    {
        if (!$params instanceof FixedPaginationParams) {
            throw new \RuntimeException('Wrong Pagination Params, need FixedPaginationParams');
        }

        $pagination = new FixedPagination(
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