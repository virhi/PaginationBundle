<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 19/03/2015
 * Time: 09:45
 */

namespace Virhi\Bundle\PaginationBundle\Pagination\Params;


class FixedPaginationParams extends PaginationParams
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