<?php

namespace bydls\LaravelModel\CodeGenerator;

/**
 * Interface LineableInterface
 * @package Krlove\CodeGenerator
 */
interface LineableInterface
{
    /**
     * @return string|string[]
     */
    public function toLines();
}