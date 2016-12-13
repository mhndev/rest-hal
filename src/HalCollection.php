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
     * @param int $page
     * @param null|integer $count
     * @param null|integer $total
     */
    public function __construct($name, $selfUri, $embedded, $page = 1, $count = null, $total = null)
    {
        $this->selfUri = $selfUri;
        $this->embedded = $embedded;
        $this->page     = $page;
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
        return empty($this->count) ? $this->getTotal() : $this->count ;
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
        $hal = new Hal($this->getSelfUri(), ['count' => (int)$this->getCount(), 'total' => (int)$this->getTotal()]);

        if($this->count == 0){
            $first = 1;
            $prev = null;
            $next = null;
            $last = 1;
        }

        else{
            $self  = $this->getPage();
            $first = 1;
            $prev  = ($this->page == 1) ? null : $this->page - 1;
            $last  = floor($this->total / $this->count ) + 1;
            $next  = ($this->page == $last) ? null : $this->page + 1;

        }

        $pageKey = self::PAGE;

        $hal->addLink('first', $this->getSelfUri().'?'.$pageKey.'='.$first);
        $hal->addLink('prev' , $this->getSelfUri().'?'.$pageKey.'='.$prev);
        $hal->addLink('self' , $this->getSelfUri().'?'.$pageKey.'='.$self);
        $hal->addLink('next' , $this->getSelfUri().'?'.$pageKey.'='.$next);
        $hal->addLink('last' , $this->getSelfUri().'?'.$pageKey.'='.$last);

        foreach ($this->getEmbedded() as $record) {

            if(is_array($record)){
                $val = $record;
            }elseif ($record instanceOf \Traversable){
                $val = iterator_to_array($record);
            }

            $item = new Hal(null, $val);

            $hal->addResource($this->name, $item);
        }

        return $hal;
    }



}
