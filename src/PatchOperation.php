<?php
namespace mhndev\restHal;
use mhndev\restHal\hal\InvalidArgumentException;
use mhndev\restHal\interfaces\iPatchOperation;

/**
 * Class PatchOperation
 * @package mhndev\orderService\hal
 */
class PatchOperation implements iPatchOperation
{

    const OPERATION_REMOVE  = 'remove';
    const OPERATION_ADD     = 'add';
    const OPERATION_REPLACE = 'replace';
    const OPERATION_MOVE    = 'move';
    const OPERATION_COPY    = 'copy';
    const OPERATION_TEST    = 'test';


    /**
     * @var string
     */
    protected $operation;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var null|mixed
     */
    protected $value = null;

    /**
     * @var null|string
     */
    protected $from = null;


    /**
     * PatchOperation constructor.
     * @param $operation
     * @param $path
     * @param array $options
     *
     * supported options :
     * from
     * value
     */
    public function __construct($operation, $path, array $options)
    {

        $this->operation = $operation;
        $this->path  = $path;

        switch($operation){

            case self::OPERATION_ADD:
                $this->setNeededOptions(self::OPERATION_ADD, 'value', $operation['value']);
                break;

            case self::OPERATION_COPY:
                $this->setNeededOptions(self::OPERATION_COPY, 'from', $operation['from']);
                break;


            case self::OPERATION_MOVE:
                $this->setNeededOptions(self::OPERATION_REMOVE, 'from', $operation['from']);
                break;


            case self::OPERATION_REMOVE:
                break;

            case self::OPERATION_TEST:
                break;

            case self::OPERATION_REPLACE:
                $this->setNeededOptions(self::OPERATION_REPLACE, 'value', $operation['value']);
                break;

            default:
                throw new InvalidArgumentException('Invalid Operation specified.');
        }

    }


    private function setNeededOptions($operation, $requiredOption, $requiredOptionValue)
    {
        if(empty($operation['value'])){
            throw new InvalidArgumentException(
                sprintf('while using %s , %s option is required.',$operation, $requiredOption)
            );
        }
        $this->{$requiredOption} = $requiredOptionValue;
    }


    /**
     * @return string
     */
    function getOp()
    {
        return $this->operation;
    }

    /**
     * @return string
     */
    function getPath()
    {
        return $this->path;
    }
}
