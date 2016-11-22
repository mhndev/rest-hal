<?php

namespace mhndev\restHal;

use mhndev\restHal\interfaces\iHalApiPresenter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class HalApiPresenter
 * @package mhndev\orderService\hal
 */
class HalApiPresenter extends aHalApiPresenter implements iHalApiPresenter
{


    /**
     * @var array
     */
    protected $data;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     * @throws \Exception
     */
    function makeResponse(ServerRequestInterface $request, ResponseInterface $response)
    {
        if($this->getData()){
            $body =  $this->makeResponseBody($request, $response);
            $response->withBody($body);
        }

        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus($this->statusCode);
    }


    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\StreamInterface
     */
    private function makeResponseBody(ServerRequestInterface $request, ResponseInterface $response)
    {
        $body = $response->getBody();

        $halType = $this->getHalType();

        if($halType == self::HAL_TYPE_ERROR){

            $data = $this->getData();
            $message = $data['message'];
            unset($data['message']);

            $hal = (new HalError($request->getUri()->getPath(),$message, $data))->getHal();

        }elseif ($halType == self::HAL_TYPE_RESOURCE){

            $hal = (new HalResource($request->getUri()->getPath(), $this->getData()))->getHal();

        }elseif ($halType == self::HAL_TYPE_COLLECTION){
            $hal = (new HalCollection(
                $this->getData()['name'],
                $request->getUri()->getPath(),
                $this->getData()['data'],
                $this->getData()['count'],
                $this->getData()['total']
            ))->getHal();
        }


        $accept = $request->getHeader('ACCEPT')[0];

        if($accept == 'application/json'){
            $body->write($hal->asJson());

        }elseif ($accept == 'application/xml'){
            $body->write($hal->asXml());

        }else{
            $body->write($hal->asJson());
        }

        return $body;
    }

    /**
     * @return array|\Traversable
     */
    function getData()
    {
        return $this->data;
    }

    /**
     * @param array|\Traversable $data
     * @return mixed
     */
    function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
