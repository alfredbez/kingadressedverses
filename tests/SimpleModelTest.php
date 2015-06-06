<?php

use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;

use App\User;

abstract class SimpleModelTest extends TestCase {

    protected $storeUrl;

    protected $databaseTable;

    protected $modelname = '';

    protected $data = [];

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

    protected function getLastId() {
      if($this->modelname === '')
      {
        $this->modelname = ucwords(substr($this->storeUrl, 1));
      }
      $model = 'App\\' . $this->modelname;
      return $model::orderBy('id', 'desc')->first()->id;
    }

    /** @test */
    public function it_does_not_delete_an_item_without_permission()
    {
        $lastId = $this->getLastId();

        $this->delete( $this->storeUrl . '/' . $lastId )
             ->seeStatusCode(403);
    }

    /** @test */
    public function it_deletes_an_item()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);

        $lastId = $this->getLastId();

        $this->delete( $this->storeUrl . '/' . $lastId)
             ->seeStatusCode(302);
    }
}