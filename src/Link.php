<?php

namespace mhndev\restHal;
use mhndev\restHal\hal\InvalidArgumentException;


/**
 * Class Link
 * @package mhndev\orderService\hal
 */
class Link implements iLink
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $href;


    /**
     * Link constructor.
     * @param $name
     * @param $href
     */
    public function __construct($name, $href)
    {
        if (filter_var($href, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException(
                sprintf('href should be valid uri given : %s', $http_response_header)
            );
        }

        $this->name = $name;
        $this->href = $href;
    }

    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    function getHrefAddress()
    {
        return $this->href;
    }
}
