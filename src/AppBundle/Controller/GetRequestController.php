<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\Type;
use AppBundle\Repository\StoreRequestRepository;

class GetRequestController extends FOSRestController
{
    /**
     * @Rest\Get("/getRequest")
     */
    public function getAction(Request $request)
    {
        /**
         * @var StoreRequestRepository $storeRequestRepository
         */
        $storeRequestRepository = $this->getDoctrine()->getRepository('AppBundle:StoreRequest');
        $response = new View("There are no stored data by search params", Response::HTTP_NOT_FOUND);

        try {
            $params = $this->validateRequest($request);

            if ($params) {
                $result = $storeRequestRepository->getStoreByParams($params);

                if ($result) {
                    $response = new View($result, Response::HTTP_OK);
                }
            }
        } catch (\InvalidArgumentException $e) {
            $response = new View(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateRequest(Request $request)
    {
        $params = [];
        $validationCollection = [];

        if ($request->get('id')) {
            $params['id'] = $request->get('id');
            $validationCollection['id'] = new GreaterThanOrEqual(['value' => 1]);
        }

        if ($request->get('route')) {
            $params['route'] = $request->get('route');
            $validationCollection['route'] = new Type(['type' =>'string']);
        }

        if ($request->get('ip')) {
            $params['ip'] = $request->get('ip');
            $validationCollection['ip'] = new Ip();
        }

        if ($request->get('method')) {
            $params['method'] = $request->get('method');
            $validationCollection['method'] = new Type(['type' =>'string']);
        }

        if ($request->get('last_days')) {
            $params['last_days'] = $this->getDatePeriod($request->get('last_days'));
            $validationCollection['last_days'] = new LessThanOrEqual("today");
        }

        if ($request->get('search')) {
            $params['search'] = $request->get('search');
            $validationCollection['search'] = new Type(['type' =>'string']);
        }

        $constraint = new Collection($validationCollection);

        $violationList = $this->get('validator')->validate($params, $constraint);

        $errors = '';

        foreach ($violationList as $error) {
            /**
             * @var  $error ConstraintViolation
             */
            $errors .= sprintf('%s:%s', $error->getPropertyPath(), $error->getMessage());
        }

        if (!empty($errors)) {
            throw new \InvalidArgumentException($errors);
        }

        return $params;
    }

    /**
     * @param $period
     * @return \DateTime|null
     */
    private function getDatePeriod($period)
    {
        $result = null;

        if ($period > 0) {
            $date = new \DateTime();
            $date->setTimezone(new \DateTimeZone("UTC"));
            $result = $date->sub(new \DateInterval(sprintf('P%dD', $period)));
        }

        return $result;
    }
}
