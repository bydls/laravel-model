<?php

namespace bydls\LaravelModel\Processor;

use bydls\LaravelModel\CodeGenerator\Model\DocBlockModel;
use bydls\LaravelModel\CodeGenerator\Model\PropertyModel;
use bydls\LaravelModel\Config;
use bydls\LaravelModel\Model\EloquentModel;

class CustomPropertyProcessor implements ProcessorInterface
{
    public function process(EloquentModel $model, Config $config)
    {
        if ($config->get('no_timestamps') === true) {
            $pNoTimestamps = new PropertyModel('timestamps', 'public', false);
            $pNoTimestamps->setDocBlock(
                new DocBlockModel('Indicates if the model should be timestamped.', '', '@var bool')
            );
            $model->addProperty($pNoTimestamps);
        }

        if ($config->has('date_format')) {
            $pDateFormat = new PropertyModel('dateFormat', 'protected', $config->get('date_format'));
            $pDateFormat->setDocBlock(
                new DocBlockModel('The storage format of the model\'s date columns.', '', '@var string')
            );
            $model->addProperty($pDateFormat);
        }

        if ($config->has('connection')) {
            $pConnection = new PropertyModel('connection', 'protected', $config->get('connection'));
            $pConnection->setDocBlock(
                new DocBlockModel('The connection name for the model.', '', '@var string')
            );
            $model->addProperty($pConnection);
        }
    }

    public function getPriority()
    {
        return 5;
    }
}
