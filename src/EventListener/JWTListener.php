<?php

// src/EventListener/JWTAddDataListener.php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTDecodedEvent;
use Symfony\Component\HttpFoundation\RequestStack;


class JWTListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();
        // CSRF protection.
        $payload = $event->getData();

        $csrf = random_bytes (32);
        $csrf = sha1 ($csrf);
        $payload['xsrf-token']  = $csrf;
        $payload['id']  = $event->getUser()->getId();

        // Set the data to the event;
        $event->setData($payload);
    }

    /**
     * @param JWTDecodedEvent $event
     *
     * @return void
     */
    public function onJWTDecoded(JWTDecodedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();
        
        $payload = $event->getPayload();

        if (isset($payload['xsrf-token']) && $payload['xsrf-token'] !== $request->headers->get('x-xsrf-token'))
        {
            $event->markAsInvalid();
        }
    }

}