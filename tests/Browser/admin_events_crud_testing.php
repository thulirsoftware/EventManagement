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
            ->type('Name', 'lARAVEL duSK')
            ->type('age_limit','1')
            ->type('max_age','10')
            ->keys('#Date','2021-28-07')
            ->keys('#closing_date','2021-28-08')
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
            ->check('competitionCheck')
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
            ->check('competitionCheck')
            ->check('EntryCheck')
            ->type('min_age[]', '1')
            ->type('max_age[]', '9')
            ->select('memberType[]', 'Member')
            ->type('ticketPrice[]', '120')
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

            /*Entry Ticket Edit
            ->click('a[href="#nav-profile"]')
            ->pause(1000)
            ->click('a[id="row_entry_edit'.$entry->id)
            ->type('#row_entry_event_max_age_text'.$entry->id, '20')
            ->click('#entry_save_button'.$entry->id)

            //Food Ticket Edit
            ->click('a[href="#nav-contact"]')
            ->pause(1000)
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
            ->acceptDialog()*/


            ->clickLink('Membership')
            ->clickLink('Events')
            ->clickLink('My Events')
            ->clickLink('My Profile')
            ->clickLink('Change Password')
            ->clickLink('Family Members')
            ->clickLink('Enroll as Volunteer')
