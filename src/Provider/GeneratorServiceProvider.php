<?php

namespace bydls\LaravelModel\Provider;

use Illuminate\Support\ServiceProvider;
use bydls\LaravelModel\Command\GenerateModelCommand;
use bydls\LaravelModel\EloquentModelBuilder;
use bydls\LaravelModel\Processor\CustomPrimaryKeyProcessor;
use bydls\LaravelModel\Processor\CustomPropertyProcessor;
use bydls\LaravelModel\Processor\ExistenceCheckerProcessor;
use bydls\LaravelModel\Processor\FieldProcessor;
use bydls\LaravelModel\Processor\NamespaceProcessor;
use bydls\LaravelModel\Processor\RelationProcessor;
use bydls\LaravelModel\Processor\TableNameProcessor;

class GeneratorServiceProvider extends ServiceProvider
{
    const PROCESSOR_TAG = 'bydls_model_generator.processor';

    public function register()
    {
        $this->commands([
            GenerateModelCommand::class,
        ]);

        $this->app->tag([
            ExistenceCheckerProcessor::class,
            FieldProcessor::class,
            NamespaceProcessor::class,
            RelationProcessor::class,
            CustomPropertyProcessor::class,
            TableNameProcessor::class,
            CustomPrimaryKeyProcessor::class,
        ], self::PROCESSOR_TAG);

        $this->app->bind(EloquentModelBuilder::class, function ($app) {
            return new EloquentModelBuilder($app->tagged(self::PROCESSOR_TAG));
        });
    }
}
