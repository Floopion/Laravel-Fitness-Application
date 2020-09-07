<?php

namespace Tests\Unit;

use Tests\TestCase;

class RohillTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExmaple()
    {
        // define user credentials to login as
        $credential = [
            'email' => 'test@test.com',
            'password' => 'password'
        ];

        // send post request to login in as user and check redirect to home page
        $this->post('login', $credential)->assertRedirect('/home');

        // get the searches page check if status is 200 = 'ok'
        $response = $this->get('/searches')->assertStatus(200);

        // search query: both input
        $searchRecordOne =  [
            'search-workout' => 'Run',
            'search-distance' => '0'
        ];  

    // search query: only distance input
        $searchRecordTwo =  [
            'search-workout' => '',
            'search-distance' => '0'
        ];  

        // search query: only workout type input
        $searchRecordThree =  [
            'search-workout' => 'Run',
            'search-distance' => ''
        ];  

        // search query: no inputs
        $searchRecordFour =  [
            'search-workout' => '',
            'search-distance' => ''
        ];  

        // post the queries to the searches post route
        $this->post('/searches/post', $searchRecordOne);
        $this->post('/searches/post', $searchRecordTwo);
        $this->post('/searches/post', $searchRecordThree);
        $this->post('/searches/post', $searchRecordFour);

    }
}
