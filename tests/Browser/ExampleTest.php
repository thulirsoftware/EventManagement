<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;
use App\Event;
use App\EventEntryTickets;
use App\EventTicket;
use App\EventCompetition;
use App\Competition;
use Auth;
use App\EventRegistration;

class ExampleTest extends DuskTestCase
{
    protected $events;

  

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $events = Event::orderby('id','desc')->first();
        if($events!=null)
        {
            $entry = EventEntryTickets::where('eventId',$events->id)->orderby('id','desc')->first();
            $food = EventTicket::where('eventId',$events->id)->orderby('id','desc')->first();
            $competition = EventCompetition::where('event_id',$events->id)->orderby('id','desc')->first();

            $competitionId =Competition::orderby('id','desc')->first();
        }
        else
        {
            $entry = EventEntryTickets::orderby('id','desc')->first();
            $food = EventTicket::orderby('id','desc')->first();
            $competition = EventCompetition::orderby('id','desc')->first();

            $competitionId =Competition::orderby('id','desc')->first();
        }



        $this->browse(function (Browser $browser) use($events,$entry,$food,$competition,$competitionId)
        {
            $browser->visit('admin/login')
            ->pause(3000)
            ->type('email', 'admin@sangam.com')
            ->type('password', 'sangam@123')
            ->click('.btn-back')
            ->visit('admin/memberDetails')

             ->clickLink('Manage Events')
             ->clickLink('Manage Membership')
             ->clickLink('Manage Competition')
             ->clickLink('Manage Payments')
             ->clickLink('Food Tickets')
             ->clickLink('Entry Tickets')
             ->clickLink('Volunteer')
             ->clickLink('Members')
             ->clickLink('Non Members')
            
            ->clickLink('Manage Competition')
            ->visit('admin/Competition/Add')
            ->pause(4000)
            ->type('Name', 'Poetry')
            ->type('age_limit','1')
            ->type('max_age','10')
            ->keys('#Date','28/07/2021')
            ->keys('#closing_date','28/07/2021')
            ->select('competition_type', 'group')
            ->press('Submit')
             ->visit('admin/Competition/Edit/'.$competitionId->id)
             ->type('max_age','40')
             ->press('Update')

             ->clickLink('Manage Events')
             //Entry Only
            ->visit('admin/addEvent')
            ->pause(2000)
            ->type('eventName', 'Entry Only')
            ->type('eventLocation', 'Entry Only')
            ->keys('#eventDate','2021-08-01')
            ->click('#event_time')
            ->click('.tp-ok')
            ->type('free_count', '0')
            ->check('EntryCheck')
            ->type('min_age[]', '1')
            ->type('max_age[]', '9')
            ->select('memberType[]', 'Member')
            ->type('ticketPrice[]', '120')
            ->click('.nextBtn')

            //Food Only
            ->visit('admin/addEvent')
            ->pause(2000)
            ->type('eventName', 'Food Only')
            ->type('eventLocation', 'Food Only')
            ->keys('#eventDate','2021-08-01')
            ->click('#event_time')
            ->click('.tp-ok')
            ->type('free_count', '0')
            ->check('FoodCheck')
            ->type('food_min_age[]', '1')
            ->type('food_max_age[]', '9')
            ->select('FoodmemberType[]', 'Member')
            ->select('foodType[]', 'veg')
            ->type('FoodticketPrice[]', '120')
            ->click('.nextBtn')


            //Food Entry & Competition
            ->visit('admin/addEvent')
            ->pause(2000)
            ->type('eventName', 'Food Entry & Competition')
            ->type('eventLocation', 'Entry')
            ->keys('#eventDate','2021-08-01')
            ->click('#event_time')
            ->click('.tp-ok')
            ->type('free_count', '0')
            ->check('competitionCheck')
            ->check('EntryCheck')
            ->type('min_age[]', '1')
            ->type('max_age[]', '9')
            ->select('memberType[]', 'Member')
            ->type('ticketPrice[]', '120')
            ->check('FoodCheck')
            ->type('food_min_age[]', '1')
            ->type('food_max_age[]', '9')
            ->select('FoodmemberType[]', 'Member')
            ->select('foodType[]', 'veg')
            ->type('FoodticketPrice[]', '120')
            ->click('.nextBtn')
            ->select('FoodmemberType','1')
            ->type('member_fee', '1')
            ->type('non_member_fee', '25')
            ->click('.add-row')
            ->click('.nextBtn')
        
            //Food and Entry

            ->visit('admin/addEvent')
            ->pause(2000)
            ->type('eventName', 'Food and Entry')
            ->type('eventLocation', 'Entry')
            ->keys('#eventDate','2021-08-01')
            ->click('#event_time')
            ->click('.tp-ok')
            ->type('free_count', '0')
            ->check('EntryCheck')
            ->type('min_age[]', '1')
            ->type('max_age[]', '9')
            ->select('memberType[]', 'Member')
            ->type('ticketPrice[]', '120')
            ->check('FoodCheck')
            ->type('food_min_age[]', '1')
            ->type('food_max_age[]', '9')
            ->select('FoodmemberType[]', 'Member')
            ->select('foodType[]', 'no-food')
            ->type('FoodticketPrice[]', '120')
            ->click('.nextBtn')

            //Entry and Competition

            ->visit('admin/addEvent')
            ->pause(2000)
            ->type('eventName', 'Entry and Competition')
            ->type('eventLocation', 'Entry')
            ->keys('#eventDate','2021-08-01')
            ->click('#event_time')
            ->click('.tp-ok')
            ->type('free_count', '0')
            ->check('EntryCheck')
            ->type('min_age[]', '1')
            ->type('max_age[]', '9')
            ->select('memberType[]', 'Member')
            ->type('ticketPrice[]', '120')
            ->check('competitionCheck')
            ->click('.nextBtn')
            ->select('FoodmemberType')
            ->type('member_fee', '12')
            ->type('non_member_fee', '25')
            ->click('.add-row')
            ->click('.nextBtn')

            //Food and Competition

            ->visit('admin/addEvent')
            ->pause(2000)
            ->type('eventName', 'Food and Competition')
            ->type('eventLocation', 'Food')
            ->keys('#eventDate','2021-08-01')
            ->click('#event_time')
            ->click('.tp-ok')
            ->type('free_count', '0')
             ->check('FoodCheck')
            ->type('food_min_age[]', '1')
            ->type('food_max_age[]', '9')
            ->select('FoodmemberType[]', 'Member')
            ->select('foodType[]', 'nveg')
            ->type('FoodticketPrice[]', '120')
            ->check('competitionCheck')
            ->click('.nextBtn')
            ->select('FoodmemberType')
            ->type('member_fee', '12')
            ->type('non_member_fee', '25')
            ->click('.add-row')
            ->click('.nextBtn')

             //View Tickets
            ->visit('admin/eventTickets/'.$events->id)
            ->pause(1000)

            //View Add Event Entry Ticket

            ->visit('admin/Event/addEventEntryTicket/'.$events->id)
            ->type('min_age', '10')
            ->type('max_age', '30')
            ->select('memberType', 'Member')
            ->type('ticketPrice', '150')
            ->click('.nextBtn')
            ->clickLink('Manage Events')
            ->visit('admin/eventTickets/'.$events->id)
            ->pause(1000)

             //View Tickets
            ->visit('admin/eventTickets/'.$events->id)
            ->pause(1000)

            //View Add Event Food Ticket

            ->visit('admin/Event/addEventFoodTicket/'.$events->id)
            ->type('min_age', '10')
            ->type('max_age', '15')
            ->select('FoodmemberType', 'Member')
            ->select('foodType', 'veg')
            ->type('FoodticketPrice', '180')
            ->click('.nextBtn')
            ->clickLink('Manage Events')
            ->visit('admin/eventTickets/'.$events->id)
            ->pause(1000)
             //View Tickets
            ->visit('admin/eventTickets/'.$events->id)
            ->pause(1000)

            //View Add Event Competition

            ->visit('admin/Event/addCompetition/'.$events->id)
             ->select('FoodmemberType','2')
            ->type('member_fee', '10')
            ->type('non_member_fee', '25')
            ->click('.add-row')
            ->click('.nextBtn')
             //View Tickets
            ->visit('admin/eventTickets/'.$events->id)
            ->pause(1000)

            //Entry Ticket Edit
            ->click('a[href="#nav-profile"]')
            ->pause(1000)
            ->click('a[id="row_entry_edit'.$entry->id)
            ->type('#row_entry_event_max_age_text'.$entry->id, '20')
            ->click('#entry_save_button'.$entry->id)

            //Food Ticket Edit
            ->click('a[href="#nav-contact"]')
            ->pause(3000)
            ->click('a[id="row_food_edit'.$food->id)
            ->type('#row_food_event_price_text'.$food->id, '20')
            ->click('#food_save_button'.$food->id)

            //Competition Edit
            ->click('a[href="#nav-competition"]')
            ->pause(1000)
            ->click('a[id="row_competition_edit'.$competition->competition_id)
            ->type('#row_competition_nonFee_text'.$competition->competition_id, '20')
            ->click('#Competition_save_button'.$competition->competition_id)

            //Entry Ticket Delete
            ->click('a[href="#nav-profile"]')
            ->pause(1000)
            ->click('a[id="row_entry_delete'.$entry->id)
            ->acceptDialog()

            //Food Ticket Delete
            ->click('a[href="#nav-contact"]')
            ->pause(1000)
            ->click('a[id="row_food_delete'.$food->id)
            ->acceptDialog()

            //Competition Delete
            ->click('a[href="#nav-competition"]')
            ->pause(1000)
            ->click('a[id="row_Competition_delete'.$competition->competition_id)
            ->acceptDialog()
            ->pause(3000)
            ->clickLink('Logout')
            ->visit('/')
            ->pause(3000)
            ->type('email', 'kani@mailinator.com')
            ->type('password', '123456')
            ->press('Submit')

            ->clickLink('Membership')
            ->clickLink('Events')
            ->clickLink('My Events')
            ->clickLink('My Profile')
            ->clickLink('Change Password')
            ->clickLink('Family Members')
            ->clickLink('Enroll as Volunteer')

            ->visit('memberTickets')
            ->clickLink('Register')
            ->pause(3000)
            //Entry Food Competition Register
            ->type('ticketQty[]', '1')
            ->type('FoodticketQty[]', '5')
            ->pause(3000)
            ->press('Register')
            ->pause(3000)
            ->select('Competition','1_solo')
            ->select('familyMembers','1')
            ->click('.solo-add-row')
            ->press('Submit')
            ->pause(3000)
            ->radio('payment_type', 'cash')
            ->press('Pay')

            //Entry Food Register
            ->type('ticketQty[]', '1')
            ->type('FoodticketQty[]', '5')
            ->radio('minimal', 'no')
            ->pause(3000)
            ->press('Register')
            ->pause(3000)
            ->radio('payment_type', 'cash')
            ->press('Pay')
            

            //Entry Register
            ->type('ticketQty[]', '1')
            ->radio('minimal', 'no')
            ->pause(3000)
            ->press('Register')
            ->pause(3000)
            ->radio('payment_type', 'cash')
            ->press('Pay')
            ->pause(3000)
            ->clickLink('Logout');
        });
    }
}
