<?php

namespace bydls\LaravelModel\Processor;

use bydls\LaravelModel\CodeGenerator\Model\ClassNameModel;
use bydls\LaravelModel\CodeGenerator\Model\DocBlockModel;
use bydls\LaravelModel\CodeGenerator\Model\PropertyModel;
use bydls\LaravelModel\CodeGenerator\Model\UseClassModel;
use bydls\LaravelModel\Config;
use bydls\LaravelModel\Helper\EmgHelper;
use bydls\LaravelModel\Model\EloquentModel;

class TableNameProcessor implements ProcessorInterface
{
    /**
     * @var EmgHelper
     */
    protected $helper;

    /**
     * @param EmgHelper $helper
     */
    public function __construct(EmgHelper $helper)
    {
        $this->helper = $helper;
    }

    public function process(EloquentModel $model, Config $config)
    {
        $className     = $config->get('class_name');
        $baseClassName = $config->get('base_class_name');
        $tableName     = $config->get('table_name');

        $model->setName(new ClassNameModel($className, $this->helper->getShortClassName($baseClassName)));
        $model->addUses(new UseClassModel(ltrim($baseClassName, '\\')));
        $model->setTableName($tableName ?: $this->helper->getDefaultTableName($className));

        if ($model->getTableName() !== $this->helper->getDefaultTableName($className)) {
            $property = new PropertyModel('table', 'protected', $model->getTableName());
            $property->setDocBlock(new DocBlockModel('The table associated with the model.', '', '@var string'));
            $model->addProperty($property);
        }
    }

    public function getPriority()
    {
        return 10;
    }
}
