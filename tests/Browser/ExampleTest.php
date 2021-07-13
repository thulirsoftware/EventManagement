<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;
class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
            ->pause(3000)
            ->type('email', 'admin@gmail.com')
            ->type('password', '123456')
            ->click('.btn-back')
            ->visit('/admin/memberDetails')
            ->clickLink('Manage Events')
            ->pause(3000)
            ->visit('/admin/addEvent')
            ->pause(3000)
            ->type('eventName', 'duskeventnameEntry')
            ->type('eventDescription', 'duskeventdescEntry')
            ->attach('eventFlyer', __DIR__.'/images/Screenshot from 2021-06-16 12-17-10.png')
            ->type('eventLocation', 'Entry')
            ->keys('#eventDate','2021-03-01')
            ->keys('#eventTime', '10:00:am')
            ->check('EntryCheck')
            ->select('ageGroup', 'kids')
            ->select('memberType', 'Member')
            ->type('number_of_tickets', '11')
            ->type('ticketPrice', '120')
            ->click('.nextBtn')
            ->pause(3000);
        });
    }
}
