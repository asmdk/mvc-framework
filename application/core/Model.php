<?php 

abstract class Model
{
    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DELETE = 'delete';

    protected $db;
    protected $pk;
    protected $attributes;
    protected $scenario;

    public function __construct($scenario = self::SCENARIO_INSERT)
    {
        $this->db = Db::getInstance();
        $this->attributes = new StdClass();
        $this->scenario = $scenario;
    }

    /**
     * return model table name
     * @return string
     */
    abstract protected function tableName();

    /**
     * return model primary key
     * @return array
     */
    abstract protected function primaryKey();

    /**
     * create condition and params for primary sql queries(with pk)
     *
     * @param $params
     * @return array
     * @throws ExtException
     */
    private function primaryKeyParams($params)
    {
        if (!is_array($params) && !is_object($params)) $params = array($params);
        $pk = $this->primaryKey();

        if (count($params) <= count($pk)) {
            $data = array();
            $condition = '';
            try {
                foreach($pk as $key => $value) {
                    $data[':'.$value] = is_array($params) ? $params[$key] : $params->{$value};
                    $condition .= !empty($condition) ? ', ' : '';
                    $condition .= $value.'=:'.$value;
                }
            }
            catch (ExtException $e) {
                throw new ExtException($e->getMessage());
            }
        }
        else {
            throw new ExtException("Primary key doesn't exists with params!");
        }
        return array($data, $condition);
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getAttribute($name)
    {
        if (isset($this->attributes->{$name}) || is_null($this->attributes->{$name})) {
            $attribute = $this->attributes->{$name};
        }
        else {
            throw new ExtException("Atrribute {$name} not found!");
        }
        return $attribute;
    }

    /**
     * @param mixed $attributes
     */
    public function setAttributes($attributes)
    {
        if (!empty($attributes)) {
            foreach($attributes as $attribute => $value) {
                $this->attributes->{$attribute} = $value;
            }
        }

    }

    public function setAttribute($name, $value)
    {
        if (isset($this->attributes->{$name}) || is_null($this->attributes->{$name})) {
            $this->attributes->{$name} = $value;
        }
        else {
            throw new ExtException("Atrribute {$name} not found!");
        }
    }

    public function findAll($condition)
    {

    }

    /**
     * find by primary key
     *
     * @param $params
     * @throws ExtException
     */
    public function findByPk($params)
    {
        $table = $this->tableName();
        list($data, $condition) = $this->primaryKeyParams($params);

        $sql = "SELECT * FROM {$table} t WHERE {$condition}";
        $pdo = $this->execute($sql, $data);
        $result = $pdo->fetchObject();
        $this->attributes = $result;
        $this->scenario = !empty($result) ? self::SCENARIO_UPDATE : self::SCENARIO_INSERT;
    }

    public function save()
    {
        $table = $this->tableName();
        $pk = $this->primaryKey();
        $columns = array();
        $fields = array();
        $condition = array();
        $updateValues = array();

        try {
            foreach($this->attributes as $key => $attribute) {
                if (!in_array($key, $pk)) {
                    $columns[] = $key;
                    $fields[':'.$key] = $attribute;
                    $updateValues[] = $key.'=:'.$key;
                }
                else if ($this->scenario == self::SCENARIO_UPDATE) {
                    $condition[] = $key.'=:'.$key;
                    $fields[':'.$key] = $attribute;
                }
            }
            if ($this->scenario == self::SCENARIO_INSERT) {
                $columnsSql = implode(',', array_values($columns));
                $fieldsSql = implode(',', array_keys($fields));
                $sql = "INSERT INTO {$table} ({$columnsSql}) VALUES({$fieldsSql})";
            } else {
                $conditionSql =  implode(',', array_values($condition));
                $updateValuesSql =  implode(',', array_values($updateValues));
                $sql = "UPDATE {$table} SET {$updateValuesSql} WHERE {$conditionSql}";
            }
        }
        catch (ExtException $e) {
            throw new ExtException($e->getMessage());
        }

        //var_dump($sql);exit;

        return $this->execute($sql, $fields);
    }

    public function delete()
    {
        $table = $this->tableName();
        list($data, $condition) = $this->primaryKeyParams($this->attributes);
        $sql = "DELETE FROM {$table} WHERE ({$condition})";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    /**
     * execute sql query
     * @param $sql
     * @param null|array $data
     * @return PDOStatement
     */
    public function execute($sql, $data = null)
    {
        $pdo = $this->db->prepare($sql);
        $pdo->execute($data);
        return $pdo;
    }
}
