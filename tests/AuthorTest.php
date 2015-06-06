<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

require_once __DIR__ . '/SimpleModelTest.php';

class AuthorTest extends SimpleModelTest {

    protected $storeUrl = '/author';
    protected $databaseTable = 'authors';
}