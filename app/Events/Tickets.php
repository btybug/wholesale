<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/24/2018
 * Time: 9:37 PM
 */

namespace App\Events;


use Illuminate\Queue\SerializesModels;

class Tickets
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;
    public $ticket;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($user,$ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
    }
}
