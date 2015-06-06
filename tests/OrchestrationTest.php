<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

require_once __DIR__ . '/SimpleModelTest.php';

class OrchestrationTest extends SimpleModelTest {

    protected $storeUrl = '/orchestration';
    protected $databaseTable = 'orchestrations';
}