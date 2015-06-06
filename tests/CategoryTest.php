<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

require_once __DIR__ . '/SimpleModelTest.php';

class CategoryTest extends SimpleModelTest {

    protected $storeUrl = '/category';
    protected $databaseTable = 'categories';
}