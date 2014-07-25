<?php
/**
 * Created by PhpStorm.
 * User: virhi
 * Date: 25/07/2014
 * Time: 11:27
 */

namespace Virhi\Bundle\PaginationBundle\Pagination\Event;


interface PaginationEventInterface {

    /**
     * @return int
     */
    public function getPage();

    /**
     * @param $page
     * @return mixed
     */
    public function setPage($page);

    /**
     * @return int
     */
    public function getLimit();

    /**
     * @param $page
     * @return mixed
     */
    public function setLimit($limit);

    /**
     * @param boolean $paginate
     * @return mixed
     */
    public function setPaginate($paginate);

    /**
     * @return boolean
     */
    public function paginate();
} 