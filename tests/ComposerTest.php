<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

require_once __DIR__ . '/SimpleModelTest.php';

class ComposerTest extends SimpleModelTest {

    protected $storeUrl = '/composer';
    protected $databaseTable = 'composers';
}