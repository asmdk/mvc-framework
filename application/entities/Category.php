<?php
/**
 * Created by PhpStorm.
 * User: kel
 * Date: 01.04.2015
 * Time: 5:16
 */

/**
 * Class Category
 * @Entity
 * @Table(name="category")
 */
class Category {

    /**
     * @var integer
     *
     * @Column(name="cid", type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $cid;

    /**
     * @Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @OneToMany(targetEntity="Node", mappedBy="category")
     */
    protected $nodes;

    public function __construct()
    {
        $this->nodes = new Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getCid()
    {
        return $this->cid;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add Node
     *
     * @param Node $node
     * @return Category
     */
    public function addNode(Node $node)
    {
        $this->nodes[] = $node;
        return $this;
    }
    /**
     * Remove Node
     *
     * @param Node $node
     */
    public function removeNode(Node $node)
    {
        $this->nodes->removeElement($node);
    }
    /**
     * Get Node
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNodes()
    {
        return $this->nodes;
    }

}