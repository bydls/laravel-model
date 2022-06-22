<?php

namespace bydls\LaravelModel\Processor;

use bydls\LaravelModel\Config;
use bydls\LaravelModel\Model\EloquentModel;

interface ProcessorInterface
{
    /**
     * @param EloquentModel $model
     * @param Config $config
     */
    public function process(EloquentModel $model, Config $config);

    /**
     * @return int
     */
    public function getPriority();
}
