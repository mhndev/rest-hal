<?php

namespace mhndev\restHal;

use mhndev\restHal\interfaces\iHalObjectResource;
use Nocarrier\Hal;

/**
 * Class HalResource
 * @package mhndev\orderService\hal
 */
class HalResource extends aHal implements iHalObjectResource
{


    /**
     * @var array | \Traversable
     */
    protected $data;


    /**
     * HalResource constructor.
     * @param $selfUri
     * @param array|\Traversable $data
     */
    public function __construct($selfUri, $data)
    {
        $this->selfUri = $selfUri;
        $this->data = $data;
    }

    /**
     * @return array | \Traversable
     */
    function getData()
    {
        return $this->data;
    }


    /**
     * @return Hal
     */
    function getHal()
    {
        $hal = new Hal($this->getSelfUri(), $this->data);

        return $hal;
    }
}
