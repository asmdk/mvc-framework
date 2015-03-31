<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 31.03.2015
 * Time: 6:34
 */

/**
 * Class Node
 * @Entity(repositoryClass="NodeRepository")
 * @Table(name="node")
 */
class Node {

    /**
     * @id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $nid;

    /**
     * @Column(type="string", length=255)
     */
    protected $title;
    /**
     * @Column(type="text")
     */
    protected $body;

    /**
     * @Column(type="datetime")
     */
    protected $created;

    /**
     * @Column(type="datetime")
     */
    protected $updated;

    /**
     * @return int
     */
    public function getNid()
    {
        return $this->nid;
    }

    /**
     * @param int $nid
     * @return Node
     */
    public function setNid($nid)
    {
        $this->nid = $nid;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Node
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Node
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param int $created
     * @return Node
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return int
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param int $updated
     * @return Node
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }



}