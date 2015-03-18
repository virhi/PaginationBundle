<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/08/2014
 * Time: 14:49
 */

namespace Virhi\Bundle\PaginationBundle\Factory;

use Virhi\Bundle\PaginationBundle\Pagination\Pagination;
use Virhi\Bundle\PaginationBundle\Pagination\Params\PaginationParams;

class PaginationFactory
{
    protected $router;

    function __construct($router)
    {
        $this->router = $router;
    }

    /**
     * @return Pagination
     */
    public function getPagination(PaginationParams $params)
    {
        $pagination = new Pagination(
            $this->router,
            $params->getRoute(),
            $params->getRouteParam(),
            $params->getLimit(),
            $params->getNbElement(),
            $params->getIdPage()
        );
        return $pagination;
    }
} 