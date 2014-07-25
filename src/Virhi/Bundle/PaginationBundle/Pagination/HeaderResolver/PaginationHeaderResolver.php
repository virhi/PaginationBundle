<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 25/07/2014
 * Time: 14:53
 */

namespace Virhi\Bundle\PaginationBundle\Pagination\HeaderResolver;


class PaginationHeaderResolver
{
    CONST LIMIT = 0;
    protected $page;

    protected $limit;

    public function resolve($input)
    {
        $raw = explode('/', $input);
        $this->limit = self::LIMIT;

        if (array_key_exists(1, $raw) ) {
            $this->limit = $raw[1];
        }

        $this->page  = $raw[0];
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return (int)$this->limit;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return (int)$this->page;
    }
}