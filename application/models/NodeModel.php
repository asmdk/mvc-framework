<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 19.03.2015
 * Time: 9:56
 */

class NodeModel extends Model {

    public function getNodeList()
    {
        $sql = 'SELECT * FROM NODE';
        $nodes = $this->execSql($sql);
        return $nodes;
    }

}