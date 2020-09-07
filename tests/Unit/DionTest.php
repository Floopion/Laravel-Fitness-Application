<?php

namespace Tests\Unit;

use Tests\TestCase;

class DionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    // Test to see if the User can Post a new Mood
    public function testExample()
    {
      // Log into the Website making sure that it redirects to home
      $credential = [
        'email' => 'test3@gmail.com',
        'password' => '12341234'
      ];
      $this->post('login',$credential)->assertRedirect('/home');

      // Check you can navigate to the add record page
      $response = $this->get('/recordadd');
      $response->assertStatus(200);

      // Check that you can post a new record to the database with the specified credentials
      $newRecord = [
        'date' => '16/06/2020',
        'other_type' => 'moods',
        'amount' => 2
      ];
      $this->post('/moods',$newRecord);

    }
}
