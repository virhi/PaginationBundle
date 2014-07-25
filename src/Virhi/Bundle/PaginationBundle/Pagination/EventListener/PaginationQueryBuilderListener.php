<?php

namespace Virhi\Bundle\PaginationBundle\Pagination\EventListener;

use Rf\Component\Repository\Event\QueryBuilderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class PaginationQueryBuilderListener implements EventSubscriberInterface {

    /*
     * Limit of displayed elements
     *
     * @var int
     */
    private $limit;

    /*
     * Current page
     *
     * @var int
     */
    private $page;

    /**
     * Constructor
     *
     * @param int $limit
     */
    public function __construct($page, $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    /**
     * @inheritedDoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            'query.initialized' => array('onQueryInitialized',0)
        );
    }

    /**
     * Called when query is initialized
     *
     * @param QueryBuilderEvent $event
     */
    public function onQueryInitialized(QueryBuilderEvent $event)
    {
        $offset    = ($this->page - 1) * $this->limit;
        $event
            ->getQueryBuilder()
            ->limit($this->limit)
            ->skip((string) $offset);
    }
}
