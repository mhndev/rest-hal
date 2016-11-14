<?php

namespace mhndev\restHal\interfaces;

/**
 * Interface iPatchOperation
 * @package mhndev\orderService\hal\interfaces
 */
interface iPatchOperation
{
    /**
     * @return string
     */
    function getOp();

    /**
     * @return string
     */
    function getPath();

}
