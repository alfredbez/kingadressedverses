<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;
use Laracasts\TestDummy\Factory as TestDummy;

use App\User;

abstract class SimpleModelTest extends TestCase {

    protected $storeUrl;

    protected $databaseTable;

    protected $modelname = '';

    protected $data = [];

    protected function getClassName() {
      if($this->modelname === '')
      {
        $this->modelname = ucwords(substr($this->storeUrl, 1));
      }
      return 'App\\' . $this->modelname;
    }

    public function getDummy()
    {
      return TestDummy::create($this->getClassName());
    }

    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate');
    }

    /** @test */
    public function it_does_not_store_request_without_permission()
    {
        $this->post( $this->storeUrl , ['name' => 'Test'])
             ->seeStatusCode(403);
    }

    /** @test */
    public function it_does_not_store_request_without_name()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);

        $this->post( $this->storeUrl , ['name' => ''])
             ->seeStatusCode(302);
    }

    /** @test */
    public function it_does_store_request_with_name()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);

        $this->data = ['name' => 'Test'];

        $this->post( $this->storeUrl , $this->data)
             ->seeStatusCode(200)
             ->verifyInDatabase( $this->databaseTable, $this->data );
    }

    /** @test */
    public function it_changes_the_name()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);

        $dummy = $this->getDummy();

        $url = $this->storeUrl . '/' . $dummy->id . '/edit';

        $newName = 'Neuer Name';

        $this->visit( $url )
              ->type($newName, 'name')
              ->press('Umbenennen')
              ->notSee('<small class="error">')
              ->verifyInDatabase(
                $this->databaseTable,
                ['id' => $dummy->id, 'name' => $newName]
              );
    }

    /** @test */
    public function it_does_not_change_the_name_to_empty_name()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);

        $dummy = $this->getDummy();

        $url = $this->storeUrl . '/' . $dummy->id . '/edit';

        $this->visit( $url )
              ->type('', 'name')
              ->press('Umbenennen')
              ->see('<small class="error">')
              ->notVerifyInDatabase(
                $this->databaseTable,
                ['id' => $dummy->id, 'name' => '']
              );
    }

    /** @test */
    public function it_does_not_change_the_name_without_permission()
    {
        $dummy = $this->getDummy();

        $this->put( $this->storeUrl . '/' . $dummy->id , ['name', 'Neuer Name'])
             ->seeStatusCode(403);
    }

    /** @test */
    public function it_does_not_delete_an_item_without_permission()
    {
        $dummy = $this->getDummy();

        $this->delete( $this->storeUrl . '/' . $dummy->id )
             ->seeStatusCode(403);
    }

    /** @test */
    public function it_deletes_an_item()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);

        $dummy = $this->getDummy();

        $this->delete( $this->storeUrl . '/' . $dummy->id)
             ->seeStatusCode(302);
    }
}