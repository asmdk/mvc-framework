<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 31.03.2015
 * Time: 11:13
 */

class NodeRepository extends  Doctrine\ORM\EntityRepository {

    public function getRandomNode()
    {
        $sql = 'SELECT * FROM Node ORDER BY RAND()';

        $query = $this->getEntityManager()->getConnection()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}