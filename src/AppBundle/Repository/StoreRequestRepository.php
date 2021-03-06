<?php

namespace AppBundle\Repository;

/**
 * StoreRequestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StoreRequestRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param array $params
     * @return array
     */
    public function getStoreByParams(array $params = [])
    {
        $db = $this->_em->createQueryBuilder()
            ->select('store_request')
            ->from('AppBundle\Entity\StoreRequest', 'store_request');

        if (!empty($params['id'])) {
            $db->where('store_request.id = :id');
        } else {
            if (!empty($params['method'])) {
                $db->where('store_request.method = :method');
            }

            if (!empty($params['ip'])) {
                $db->andWhere('store_request.ip = :ip');
            }

            if (!empty($params['route'])) {
                $db->andWhere('store_request.route = :route');
            }

            if (!empty($params['last_days'])) {
                $db->andWhere('store_request.created > :last_days');
            }

            if (!empty($params['search'])) {
                $db->andWhere('store_request.headers LIKE :search OR store_request.body LIKE :body');
                $params['search'] = '%' . $params['search'] . '%';
                $params['body'] = $params['search'];
            }
        }

        $db->setParameters($params);

        return $db->getQuery()->getArrayResult();
    }
}
