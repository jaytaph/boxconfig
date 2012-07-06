<?php

namespace BoxConfig\DefaultBundle\EventListener;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class WebDebugToolbarListener extends \Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        // This will NOT load the webtoolbar, even in development mode when standalone is given. This option is
        // given when we load the page inside an iframe. Just like ESI-snippets, we don't want the toolbar to
        // appear.
        if ($event->getRequest()->get("standalone")) {
            return;
        }
        return parent::onkernelResponse($event);

    }
}
