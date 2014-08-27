<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 27/08/2014
 * Time: 14:11
 */

namespace Virhi\Bundle\PaginationBundle\Pagination\Params;


class RangePaginationParams extends PaginationParams
{
    protected $range;

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