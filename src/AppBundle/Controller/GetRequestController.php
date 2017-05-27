<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Store;

class GetRequestController extends FOSRestController
{
    /**
     * @Rest\Get("/getRequest")
     */
    public function getAction(Request $request)
    {
        $response = $this->getDoctrine()->getRepository('AppBundle:Store')->findAll();

        if ($response === null) {
            return new View("There are no store data", Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
