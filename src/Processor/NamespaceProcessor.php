<?php

namespace bydls\LaravelModel\Processor;

use bydls\LaravelModel\CodeGenerator\Model\NamespaceModel;
use bydls\LaravelModel\Config;
use bydls\LaravelModel\Model\EloquentModel;

class NamespaceProcessor implements ProcessorInterface
{
    public function process(EloquentModel $model, Config $config)
    {
        $model->setNamespace(new NamespaceModel($config->get('namespace')));
    }

    public function getPriority()
    {
        return 6;
    }
}
