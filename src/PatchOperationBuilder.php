<?php
namespace mhndev\restHal;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class PatchOperationBuilder
 * @package mhndev\restHal
 */
class PatchOperationBuilder
{

    /**
     * @param ServerRequestInterface $request
     * @return array []iPatchOperation
     */
    private static function build(ServerRequestInterface $request)
    {
        $body = $request->getParsedBody();

        $operations = [];

        foreach ($body as $operation){

            $options = $operation;
            unset($options['op'], $options['path']);

            $operation = new PatchOperation($operation['op'], $operation['path'], $options);

            $operations[] = $operation;
        }


        return $operations;

    }

    /**
     * @param ServerRequestInterface $request
     * @return \array[]
     */
    public static function operations(ServerRequestInterface $request)
    {
        return self::build($request);
    }


    /**
     * @param ServerRequestInterface $request
     * @param $object
     * @return mixed
     */
    public static function applyFromRequest(ServerRequestInterface $request, $object)
    {
        $operations = self::build($request);

        /** @var PatchOperation $operation */
        foreach ($operations as $operation){
            switch ($operation->getOp()){
                case PatchOperation::OPERATION_ADD:
                    $object->{'set'.ucfirst($operation->getPath())}($operation->getOption('value'));
                    break;

                case PatchOperation::OPERATION_COPY:
                    $object->{'set'.ucfirst($operation->getPath())}($object->{$operation->getOption('from')});
                    break;


                case PatchOperation::OPERATION_MOVE:
                    $object->{'set'.ucfirst($operation->getPath())}($object->{$operation->getOption('from')});
                    $object->{'set'.ucfirst($operation->getOption('from'))}(null);
                    break;


                case PatchOperation::OPERATION_REMOVE:
                    $object->{'set'.ucfirst($operation->getPath())}(null);
                    break;

                case PatchOperation::OPERATION_TEST:
                    break;

                case PatchOperation::OPERATION_REPLACE:
                    $object->{'set'.ucfirst($operation->getPath())}($operation->getOption('value'));
                    break;
            }

        }

        return $object;


    }

}
