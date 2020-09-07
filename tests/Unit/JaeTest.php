<?php

namespace Tests\Unit;

use Tests\TestCase;

class JaeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test()
    {
      // Testing Log in redirects to homepage
      $credential = [
        'email' => 'test@test.com',
        'password' => '12341234'
      ];
      $this->post('login',$credential)->assertRedirect('/home');

      // Test that users page is accessible
      $response = $this->get('/users');
      $response->assertStatus(200);

      // Test that weight record can be created 
      $newRecord = [
        'date' => '16/06/2020',
        'other_type' => 'weights',
        'weight' => 2
      ];
      $this->post('/weights',$newRecord);

    }

    //Tests creation of friend request
    public function UserFriendRequest()
    {
        $sender    = createUser();
        $recipient = createUser();
        
        $sender->befriend($recipient);
        
        $this->assertCount(1, $recipient->getFriendRequests());
    }

    //Tests return of friendsList
    public function FriendsList()
    {
        $sender     = createUser();
        $recipients = createUser([], 3);
        
        foreach ($recipients as $recipient) {
            $sender->befriend($recipient);
        }
        
        $recipients[0]->acceptFriendRequest($sender);
        $recipients[1]->acceptFriendRequest($sender);
        $recipients[2]->denyFriendRequest($sender);
        $this->assertCount(3, $sender->getAllFriendships());
    }
}
