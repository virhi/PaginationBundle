<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 10/04/2014
 * Time: 13:39
 */

namespace Virhi\Bundle\PaginationBundle\Pagination;


class RangeAdvancePagination extends FixedPagination
{
    protected function getStartRange($range)
    {
        $result = $this->getCurrant()->getId() - $range;
        return $result;
    }

    protected function getEndRange($range)
    {
        $supplement = 0;

        if ($this->getStartRange($range) <= 0) {
            $nbToSup = $this->getCurrant()->getId() - 1;
            $supplement = $range - $nbToSup;
        }

        $result = $this->getCurrant()->getId() + $range + $supplement;


        return $result;
    }
}