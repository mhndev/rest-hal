<?php

namespace mhndev\restHal\interfaces;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface iHalApiPresenter
 * @package mhndev\orderService\hal
 */
interface iHalApiPresenter
{

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    function makeResponse(ServerRequestInterface $request, ResponseInterface $response);


    /**
     * @return string
     */
    function getOutput();


    /**
     * @return string
     */
    function getContentType();


    /**
     * @return string
     */
    function getHalType();


    /**
     * @return array|\Traversable
     */
    function getData();

    /**
     * @param $data
     * @return mixed
     */
    function setData($data);

    /**
     * @return integer
     */
    function getStatusCode();


    /**
     * @param integer $statusCode
     * @return $this
     */
    function setStatusCode($statusCode);
}
