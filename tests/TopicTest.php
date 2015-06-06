<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

require_once __DIR__ . '/SimpleModelTest.php';

class TopicTest extends SimpleModelTest {

    protected $storeUrl = '/topic';
    protected $databaseTable = 'topics';
}