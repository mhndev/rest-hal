<?php

namespace mhndev\restHal;

use mhndev\restHal\interfaces\iHalObjectError;
use Nocarrier\Hal;

/**
 * Class HalError
 * @package mhndev\restHal
 */
class HalError extends aHal implements iHalObjectError
{


    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $logRef;

    /**
     * @var string
     */
    protected $code;

    /**
     * HalError constructor.
     * @param $uri
     * @param string $message
     * @param array $options
     * possible options :
     *
     * path
     * logRef
     * code
     */
    public function __construct($uri, $message, array $options)
    {
        $this->selfUri = $uri;
        $this->message = $message;
        $this->path = isset($options['path']) ? $options['path'] : null ;
        $this->logRef = isset($options['logRef']) ? $options['logRef'] : null;
        $this->code = isset($options['code']) ? $options['code'] : null;
    }

    /**
     * @return string
     */
    function getMessage()
    {
        return $this->message;
    }

    /**
     * @return null|string
     */
    function getCode()
    {
        return $this->code;
    }

    /**
     * @return null|string
     */
    function getPath()
    {
        return $this->path;
    }

    /**
     * @return null|string
     */
    function getLogRef()
    {
        return $this->logRef;
    }

    /**
     * @return string
     */
    function getHal()
    {
        $error = ['message'=>$this->getMessage()];

        if($this->getPath()){
            $error['path'] = $this->getPath();
        }

        if($this->getCode()){
            $error['path'] = $this->getCode();
        }

        if($this->getLogRef()){
            $error['path'] = $this->getLogRef();
        }

        $hal = new Hal($this->getSelfUri(), $error);


        return $hal;
    }
}
