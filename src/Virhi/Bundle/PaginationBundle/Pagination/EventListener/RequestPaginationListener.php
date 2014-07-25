<?php

namespace Virhi\Bundle\PaginationBundle\Pagination\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Class RequestPaginationListener
 *
 * @package Virhi\Bundle\PaginationBundle\Pagination;\EventListener
 *
 * Enables PaginationQueryBuilderListener if request has "page" parameter
 */
class RequestPaginationListener implements EventSubscriberInterface {

    /*
     * Limit of displayed elements
     *
     * @var int
     */
    private $limit;

    /**
     * Constructor
     *
     * @param int $limit
     */
    public function __construct($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @inheritedDoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            'kernel.controller' => array('onGetController',0)
        );
    }

    /**
     * Called when kernel.controller event is dispatched
     *
     * @param FilterControllerEvent $event
     */
    public function onGetController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();
        if($request->attributes->get('page')) {
            $request->attributes->set('pagined', true);
            $eventDispatcher = $event->getDispatcher();
            $subscriber = new PaginationQueryBuilderListener((int) $request->attributes->get('page'), (int) $this->limit);
            $eventDispatcher->addSubscriber($subscriber);
        }
    }
}
