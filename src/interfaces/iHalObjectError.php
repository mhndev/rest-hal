<?php
namespace mhndev\restHal\interfaces;

/**
 * Interface iHalObjectError
 * @package mhndev\orderService\hal\interfaces
 */
interface iHalObjectError extends iHalObject
{
    function getMessage();

    function getCode();

    function getPath();

    function getLogRef();
}
