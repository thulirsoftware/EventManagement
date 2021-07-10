<?php
Route::get('/','Auth\LoginController@home');

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Auth::routes();

Route::post('/member_register', 'Auth\RegisterController@create')->name('member.register');


//  Non Member Event
Route::get('/nonMemberTicket','nonMemberController@nonMemberTicket');
Route::get('/nonMemberBuyTicket/{id}','nonMemberController@nonMemberBuyTicket');
Route::post('/nonMemberBuyTicketPost', 'nonMemberController@nonMemberBuyTicketPost');
Route::get('/nonMemberTicketView','nonMemberController@nonMemberTicketView');
Route::get('/execute-payment', 'PaymentController@execute');

Route::post('nonMemberEventPaymentCreate', 'PaymentController@nonMemberEventPaymentCreate')->name('nonMemberEventPaymentCreate');
Route::get('nonMemberEventPaymentExecute', 'PaymentController@nonMemberEventPaymentExecute');

Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');
//Route::get('/home1', 'VerifyController@verify')->name('verify');


Auth::routes();

Route::get('/home', 'MemberController@membership');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/familyMembers','FamilyMemberController@familyMembers');
Route::post('/addFamilyMembers','FamilyMemberController@addFamilyMembers');
Route::get('/familyEdit/{id}', 'FamilyMemberController@familyEdit');
Route::post('/familyUpdate','FamilyMemberController@familyUpdate');
Route::get('/familyDelete/{id}','FamilyMemberController@familyDelete');
Route::get('add/familyMembers','FamilyMemberController@ShowFamilyMembers');




Route::get('/memberTickets','MemberController@memberTickets')->name('member.tickets');
Route::get('/memberBuyTicket/{id}','MemberController@memberBuyTicket');
Route::post('/memberBuyTicketPost', 'MemberController@memberBuyTicketPost');
Route::get('/memberTicketView','MemberController@memberTicketView');
Route::post('memberPaymentCreate', 'MemberController@memberTicketAmountPay')->name('memberPaymentCreate');
Route::post('memberEventPaymentCreate', 'PaymentController@memberEventPaymentCreate')->name('memberEventPaymentCreate');
Route::get('memberEventPaymentExecute','PaymentController@memberEventPaymentExecute');
Route::post('/MemberCompetition','MemberController@MemberCompetition')->name('member.competition');
Route::post('/MemberCompetitionPost','MemberController@MemberCompetitionPost')->name('member.competition.save');



Route::get('/userhome','MemberController@userhome');
Route::get('/purchase_event_tickets','MemberController@purchase_event_tickets');
Route::get('/edit_members','MemberController@edit_members');
Route::get('/user_home','MemberController@user_home');
Route::get('/renew_membership','MemberController@renew_membership');
Route::get('/editProfile','MemberController@editProfile');
Route::post('/editProfilePost','MemberController@editProfilePost');





Route::post('/membershipPost', 'MemberController@membershipPost');
Route::post('membershipPaymentCreate', 'PaymentController@membershipPaymentCreate')->name('membershipPaymentCreate');
Route::get('membershipPaymentExecute','PaymentController@membershipPaymentExecute');
Route::get('/MemberShipAdd/{id}', 'MemberController@membershipAdd');
Route::get('/MemberShip', 'MemberController@membership');
Route::get('/purchasedmembership', 'MemberController@MemberPurchasedDetails');
Route::get('/purchasedticketdetails', 'MemberController@MemberPurchasedTicketDetails');




// Admin Dashboard

Route::prefix('admin')->group(function() {
 Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');



  Route::get('/dashboard','AdminController@dashboard');
  Route::get('/admin_edit_profile','AdminController@admin_edit_profile');



  Route::get('/manageAdmin', 'AdminController@manageAdmin')->name('admin.manageAdmin');
  Route::get('/addAdmin', 'AdminController@addAdmin');
  Route::post('/addAdmin', 'AdminController@addAdminPost');
  Route::get('/adminEdit/{id}', 'AdminController@adminEdit');
  Route::post('/adminUpdate','AdminController@adminUpdate');
  Route::get('/adminDelete','AdminController@adminDelete');

  Route::get('/addEvent', 'EventController@addEvent');
  Route::post('/addEvent', 'EventController@addEventPost');
  Route::get('/addEventTicket','EventController@addEventTicket');
  Route::post('/addEventTicket', 'EventController@addEventTicketPost');
  Route::get('/eventTicketDelete/{id}','EventController@eventTicketDelete');

  Route::get('/addEventEntryTicket', 'EventController@addEventEntryTicket');
  Route::post('/addEventEntryTicket', 'EventController@addEventEntryTicketPost');
  Route::get('/editEventEntryTicket/{id}','EventController@editEventEntryTicket');


  Route::get('/manageEvent', 'EventController@manageEvent');
  Route::get('/eventEdit/{id}', 'EventController@eventEdit');
    Route::get('/eventTickets/{id}', 'EventController@eventTickets');

  Route::post('/eventUpdate','EventController@eventUpdate');
  Route::get('/eventDelete', 'EventController@eventDelete');
  Route::get('/editEventTicket/{id}','EventController@editEventTicket');
  Route::post('/UpdateEventEntryTicket','EventController@UpdateEventEntryTicket');
  Route::post('/UpdateEventFoodTicket','EventController@UpdateEventFoodTicket');
  Route::post('/UpdateCompetition','EventController@UpdateCompetition');

  Route::get('/DeleteEventCompetition','EventController@DeleteEventCompetition');

  Route::get('/memberDetails','AdminController@memberDetails')->name('admin.members');

  Route::get('/nonMemberDetails','AdminController@nonMemberDetails');


  Route::get('/editMember/{id}','AdminController@editMember');
  Route::post('/editMemberUpdate','AdminController@editMemberUpdate');
  Route::get('/viewFamilyMember/{id}','AdminController@viewFamilyMember');


  Route::get('/manageSchool','AdminController@manageSchool');
  Route::get('/addSchool', 'AdminController@addSchool');
  Route::post('/addSchoolPost', 'AdminController@addSchoolPost');
  Route::get('/schoolEdit/{id}', 'AdminController@schoolEdit');
  Route::post('/schoolUpdate','AdminController@schoolUpdate');
  Route::get('/schoolDelete/{id}','AdminController@schoolDelete');

  Route::prefix('Membership')->group(function() {

      Route::get('/List','MembershipController@ListMembership')->name('admin.membership.list');

      Route::get('/Add', 'MembershipController@AddMembership')->name('admin.membership.add');
      Route::post('/Save', 'MembershipController@SaveMembership')->name('admin.membership.save');
      Route::get('/Edit/{id}', 'MembershipController@EditMembership')->name('admin.membership.edit');
      Route::post('/Update','MembershipController@UpdateMembership')->name('admin.membership.update');
      Route::get('/Delete/{id}','MembershipController@DeleteMembership');
  });
  Route::prefix('Competition')->group(function() {

      Route::get('/List','CompetitionController@ListCompetition')->name('admin.competition.list');

      Route::get('/Add', 'CompetitionController@AddCompetition')->name('admin.competition.add');
      Route::post('/Save', 'CompetitionController@SaveCompetition')->name('admin.competition.save');
      Route::get('/Edit/{id}', 'CompetitionController@EditCompetition')->name('admin.competition.edit');
      Route::post('/Update','CompetitionController@UpdateCompetition')->name('admin.competition.update');
      Route::get('/Delete/{id}','CompetitionController@DeleteCompetition');
  });

  Route::get('/member_details', 'AdminController@member_details');
  Route::get('/membersearch', 'AdminController@membersearch');

  Route::get('/FoodTicketsReport', 'AdminController@FoodTicketsReport');
  Route::get('/EntryTicketsReport', 'AdminController@EntryTicketsReport');

  Route::get('/Payments', 'AdminController@PaymentList');
  Route::get('/PaymentEdit/{id}', 'AdminController@PaymentEdit');
    Route::post('/UpdatePayment','AdminController@UpdatePayment');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
