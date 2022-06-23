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
        $className = $config->get('class_name');
        $baseClassName = $config->get('base_class_name');
        $tableName = $config->get('table_name');
        if (!$className||preg_match("/[\x7f-\xff]/", $className)) {
            $className = str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $tableName)));
            $config->set('class_name', $className);
        }
        $model->setName(new ClassNameModel($className, $this->helper->getShortClassName($baseClassName)));
        $model->addUses(new UseClassModel(ltrim($baseClassName, '\\')));
        $model->setTableName($tableName ?: $this->helper->getDefaultTableName($className));

        if ($model->getTableName() !== $this->helper->getDefaultTableName($className)) {
            $property = new PropertyModel('table', 'protected', $model->getTableName());
            $property->setDocBlock(new DocBlockModel('与模型关联的表', '', '@var string'));
            $model->addProperty($property);
        }
    }

    public function getPriority()
    {
        return 10;
    }
}
