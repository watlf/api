<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Store;

/**
 * @Route("/storeRequest")
 */
class StoreRequestController extends FOSRestController
{
    /**
     * @Route("/{slug}")
     */
    public function getAction($slug)
    {
        $request = Request::createFromGlobals();

        $storeRequest = new Store;

        $storeRequest->setRoute($slug)
            ->setIp($request->getClientIp())
            ->setBody($request->getContent())
            ->setMethod($request->getMethod())
            ->setHeaders($this->getHeadersAsString($request))
            ->setCreated($this->getUtcTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($storeRequest);
        $em->flush();

        $result = [
            'Success' => true,
            'id' => $storeRequest->getId(),
        ];

        return new View($result, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getHeadersAsString(Request $request)
    {
        $result = '';

        foreach ($request->headers->all() as $headerKey => $headerValues) {
            $headerValue = implode(" \n ", $headerValues);
            $result .= sprintf("%s: %s \n ", $headerKey, $headerValue);
        }

        return $result;
    }

    /**
     * @return \DateTime
     */
    private function getUtcTime()
    {
        $dateTime = new \DateTime('now');
        $dateTime->setTimezone(new \DateTimeZone("UTC"));

        return $dateTime;
    }
}
