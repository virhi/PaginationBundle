<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 25/07/2014
 * Time: 11:30
 */

namespace Virhi\Bundle\PaginationBundle\Pagination\Event;

use Symfony\Component\EventDispatcher\Event;

class PaginationEvent extends Event implements PaginationEventInterface
{

    const EVENT_NAME = 'query_pagination';

    /*
     * Current page
     *
     * @var int
     */
    protected $page;

    /**
     * @var int
     */
    protected $limit;

    protected $paginate;

    /**
     * @param boolean $paginate
     * @return mixed
     */
    public function setPaginate($paginate)
    {
        $this->paginate = $paginate;
    }

    /**
     * @return boolean
     */
    public function paginate()
    {
        return $this->paginate;
    }


    function __construct()
    {
        $this->setName(self::EVENT_NAME);
        $this->page  = 0;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param $page
     * @return mixed
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

}