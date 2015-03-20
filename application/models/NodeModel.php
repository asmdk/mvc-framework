<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 19.03.2015
 * Time: 9:56
 */

class NodeModel extends Model {

    protected function tableName()
    {
        return 'Node';
    }

    protected function primaryKey()
    {
        return array('nid');
    }

    public function getNodeList()
    {
        $sql = 'SELECT * FROM NODE';
        $nodes = $this->execute($sql);
        return $nodes;
    }

}