<?php

namespace mhndev\restHal;

use mhndev\restHal\interfaces\iHalObjectCollection;
use Nocarrier\Hal;

/**
 * Class HalCollection
 * @package mhndev\orderService\hal
 */
class HalCollection extends aHal implements iHalObjectCollection
{


    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $count;


    /**
     * @var integer
     */
    protected $page = 1;

    /**
     * @var integer
     */
    protected $total;

    /**
     * @var array []iHalObject
     */
    protected $embedded;

    /**
     * @var bool
     */
    private $isPaginate = true;


    const PAGE = 'page';


    /**
     * HalCollection constructor.
     * @param $name
     * @param string $selfUri
     * @param array|\Traversable $embedded
     * @param null|integer $count
     * @param null|integer $total
     */
    public function __construct($name, $selfUri, $embedded, $count = null, $total = null)
    {
        $this->selfUri = $selfUri;
        $this->embedded = $embedded;
        $this->count = $count;
        $this->total = $total;
        $this->name  = $name;
    }


    /**
     * @return string
     */
    function getHalType()
    {
        return aHalApiPresenter::HAL_TYPE_COLLECTION;
    }

    /**
     * @return integer
     */
    function getCount()
    {
        return $this->count;
    }

    /**
     * @return integer
     */
    function getTotal()
    {
        return $this->total;
    }

    /**
     * @return array []iHalObject
     */
    function getEmbedded()
    {
        return $this->embedded;
    }

    /**
     * @return boolean
     */
    public function isPaginate()
    {
        return $this->isPaginate;
    }

    /**
     * @param boolean $isPaginate
     * @return $this
     */
    public function setIsPaginate($isPaginate)
    {
        $this->isPaginate = $isPaginate;

        return $this;
    }

    /**
     * @return string
     */
    public function getSelfUri()
    {
        return $this->selfUri;
    }


    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }


    /**
     * @return Hal
     */
    public function getHal()
    {
        $hal = new Hal();
        $hal->setUri($this->getSelfUri());

        $self  = $this->getPage();
        $first = 1;
        $prev  = ($this->page == 1) ? null : $this->page - 1;
        $last  = ($this->total / $this->count ) + 1;
        $next  = ($this->page == $last) ? null : $this->page + 1;

        $pageKey = self::PAGE;

        $hal->addLink('first', $this->getSelfUri().'?'.$pageKey.'='.$first);
        $hal->addLink('prev' , $this->getSelfUri().'?'.$pageKey.'='.$prev);
        $hal->addLink('self' , $this->getSelfUri().'?'.$pageKey.'='.$self);
        $hal->addLink('next' , $this->getSelfUri().'?'.$pageKey.'='.$next);
        $hal->addLink('last' , $this->getSelfUri().'?'.$pageKey.'='.$last);

        foreach ($this->getEmbedded() as $record) {
            $item = new Hal(null, $record);
            $hal->addResource($this->name, $item);
        }

        return $hal;
    }



}
