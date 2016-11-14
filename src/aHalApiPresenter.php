<?php
namespace mhndev\restHal;


use mhndev\restHal\interfaces\iHalApiPresenter;

/**
 * Class aHalApiPresenter
 * @package mhndev\restHal
 */
abstract class aHalApiPresenter implements iHalApiPresenter
{


    const HAL_TYPE_COLLECTION = 'collection';
    const HAL_TYPE_RESOURCE   = 'resource';
    const HAL_TYPE_ERROR      = 'error';


    const CONTENT_TYPE_APPLICATION_JSON     = 'application/json';
    const CONTENT_TYPE_APPLICATION_XML      = 'application/xml';
    const CONTENT_TYPE_APPLICATION_HAL_JSON = 'application/hal+json';
    const CONTENT_TYPE_APPLICATION_HAL_XML  = 'application/hal+xml';




    const OUTPUT_JSON = 'json';
    const OUTPUT_XML  = 'xml';




    /**
     * @var array
     */
    public static $possibleHalTypes = [
        self::HAL_TYPE_COLLECTION,
        self::HAL_TYPE_ERROR,
        self::HAL_TYPE_RESOURCE
    ];




    /**
     * @var array
     */
    public static $possibleContentTypes = [
        self::CONTENT_TYPE_APPLICATION_JSON,
        self::CONTENT_TYPE_APPLICATION_XML,
        self::CONTENT_TYPE_APPLICATION_HAL_JSON,
        self::CONTENT_TYPE_APPLICATION_HAL_XML
    ];

    /**
     * @var array
     */
    public static $possibleOutputs = [
        self::OUTPUT_JSON,
        self::OUTPUT_XML
    ];


    /**
     * @var string
     */
    protected $output = self::OUTPUT_JSON;


    /**
     * @var integer
     */
    protected $statusCode = 200;

    /**
     * @var string
     */
    protected $contentType = self::CONTENT_TYPE_APPLICATION_JSON;


    /**
     * @var string
     */
    protected $halType;


    /**
     * aHalApiPresenter constructor.
     * @param $halType
     * @param null $contentType
     * @param null $output
     */
    public function __construct($halType, $contentType = null, $output = null)
    {
        $this->halType = $halType;
        !$contentType ? : $this->contentType = $contentType;
        !$this->output ? :$this->output = $output;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    abstract function makeResponse(ServerRequestInterface $request, ResponseInterface $response);

    /**
     * @return string
     */
    function getOutput()
    {
        return $this->output;
    }

    /**
     * @return string
     */
    function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return string
     */
    function getHalType()
    {
        return $this->halType;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}
