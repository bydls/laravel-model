<?php

namespace bydls\LaravelModel\CodeGenerator\Model\Traits;

use bydls\LaravelModel\CodeGenerator\Model\DocBlockModel;

/**
 * Trait DocBlockTrait
 * @package Krlove\CodeGenerator\Model\Traits
 */
trait DocBlockTrait
{
    /**
     * @var DocBlockModel
     */
    protected $docBlock;

    /**
     * @return DocBlockModel
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * @param DocBlockModel $docBlock
     *
     * @return $this
     */
    public function setDocBlock($docBlock)
    {
        $this->docBlock = $docBlock;

        return $this;
    }
}
