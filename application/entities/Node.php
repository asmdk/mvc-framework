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
     * @Column(length=100, nullable=false, unique=true)
     */
    protected $slug;

    /**
     * @Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @Column(type="string", length=255)
     */
    protected $title;

    /**
     * @Column(type="string", length=255)
     */
    protected $keywords;

    /**
     * @Column(type="string", length=255)
     */
    protected $description;

    /**
     * @Column(type="string", length=1000)
     */
    protected $teaser;

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
     * @ManyToOne(targetEntity="Category", inversedBy="nodes")
     * @JoinColumn(name="category_id", referencedColumnName="cid")
     */
    protected $category;

    /**
     * @return int
     */
    public function getNid()
    {
        return $this->nid;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Node
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
     * @param string $name
     * @return Node
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     * @return Node
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Node
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * @param string $teaser
     * @return Node
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;
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

    /**
     * Set category
     *
     * @param Category $category
     * @return Node
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;
        return $this;
    }
    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

}