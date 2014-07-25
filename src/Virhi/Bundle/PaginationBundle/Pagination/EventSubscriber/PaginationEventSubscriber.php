<?php

namespace Virhi\Bundle\PaginationBundle\Pagination\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Virhi\Bundle\PaginationBundle\Pagination\Event\PaginationEventInterface;
use Virhi\Bundle\PaginationBundle\Pagination\Event\PaginationEvent;
use Virhi\Bundle\PaginationBundle\Pagination\HeaderResolver\PaginationHeaderResolver;

class PaginationEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var boolean
     */
    protected $pagination;

    /**
     * @var \Virhi\Bundle\PaginationBundle\Pagination\HeaderResolver\PaginationHeaderResolver
     */
    protected $resolver;

    function __construct(PaginationHeaderResolver $resolver)
    {
        $this->pagination = false;
        $this->resolver   = $resolver;
    }


    /**
     * @inheritedDoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            PaginationEvent::EVENT_NAME => array('onPagination'),
            'kernel.controller'         => array('onGetController',0)
        );
    }

    /**
     * Called when kernel.controller event is dispatched
     *
     * @param FilterControllerEvent $event
     */
    public function onGetController(FilterControllerEvent $event)
    {
        $headerKey = 'X-Ranges';
        $request = $event->getRequest();
        if ($request->headers->has($headerKey)) {
            $this->pagination = true;
            $this->resolver->resolve($request->headers->get($headerKey));
        }
    }

    /**
     * Called when query is initialized
     *
     * @param PaginationEventInterface $event
     */
    public function onPagination(PaginationEventInterface $event)
    {
        if ($this->pagination === true) {
            $event->setPage($this->resolver->getPage());
            $event->setLimit($this->resolver->getLimit());

            if ($this->resolver->getPage() !== null) {
                $event->setPaginate(true);
            }
        }
    }
}