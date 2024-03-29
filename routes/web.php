<?php
Route::get('email_template', 'Auth\ForgotPasswordController@email_template');

Route::get('forget-password', 'Auth\ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');

Route::post('forget-password', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post'); 

Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');

Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');
Route::get('/','Auth\LoginController@home');

Auth::routes();

Route::post('/member_register', 'Auth\RegisterController@create')->name('member.register');

Route::post('/login', [
    'uses'          => 'Auth\AuthController@login',
    'middleware'    => 'IsMember',
]);


Route::get('/verify/{email}/{token}', 'VerifyController@verify')->name('verify');
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
Route::get('AddAsVolunteer/Family/{id}','FamilyMemberController@AddAsVolunteer');


Route::post('/AddVolunteer/Family', 'FamilyMemberController@AddVolunteerSave');


Route::get('/memberTickets','MemberController@memberTickets')->name('member.tickets');
Route::get('/memberBuyTicket/{id}','User\PurchaseTicketsController@memberBuyTicket');

  Route::prefix('tickets')->group(function() {

    Route::post('/save/entry','User\PurchaseTicketsController@saveEntryTicket')->name('save.entry.ticket');

    Route::get('/get/food/{id}','User\PurchaseTicketsController@getFoodTicket')->name('get.food.ticket');

     Route::post('/save/food','User\PurchaseTicketsController@savefoodTicket')->name('save.food.ticket');

     Route::get('/get/competition/{id}','User\PurchaseTicketsController@getFoodTicket')->name('get.food.ticket');

     Route::get('/competition/add/{id}','User\CompetitionController@getCompetition')->name('user.competition.add');

     Route::post('/group/add','User\CompetitionController@saveGroup')->name('competition.group.save');

     Route::get('/group/list','User\CompetitionController@listGroupParticipants')->name('competition.group.list');

     Route::get('/participant/list','User\CompetitionController@listParticipants')->name('competition.participant.list');

      Route::get('/competition/show/payment','User\CompetitionController@competitionPayment')->name('competition.show.payment');
  });


Route::get('/EditmemberBuyTicket/{id}','User\PurchaseTicketsController@EditmemberBuyTicket');

Route::post('/memberBuyTicketPost', 'User\PurchaseTicketsController@memberBuyTicketPost');
Route::post('/memberAddCompetition', 'User\PurchaseTicketsController@memberAddCompetition');
Route::get('/memberAddCompetition/{id}', 'User\PurchaseTicketsController@memberAddCompetition');



Route::get('/memberTicketView','User\PurchaseTicketsController@memberTicketView');
Route::post('memberPaymentCreate', 'User\PurchaseTicketsController@memberTicketAmountPay')->name('memberPaymentCreate');
Route::post('memberEventPaymentCreate', 'PaymentController@memberEventPaymentCreate')->name('memberEventPaymentCreate');
Route::get('memberEventPaymentExecute','PaymentController@memberEventPaymentExecute');
Route::post('/MemberCompetitionPost','User\CompetitionController@SaveCompetition')->name('member.competition.save');
Route::get('/MemberCompetitionget','User\CompetitionController@MemberCompetitionShow')->name('member.competition.show');

Route::post('/CompetitionAddParticipant', 'User\PurchaseTicketsController@GroupCompetitionAddParticipant')->name('member.competition.participant.update');


Route::get('/userhome','MemberController@userhome');
Route::get('/purchase_event_tickets','MemberController@purchase_event_tickets');
Route::get('/edit_members','MemberController@edit_members');
Route::get('/user_home','MemberController@user_home');
Route::get('/renew_membership','User\MembershipPurchaseController@renew_membership');
Route::get('/editProfile','MemberController@editProfile');
Route::post('/editProfilePost','MemberController@editProfilePost');
Route::get('/ChangePassword','MemberController@ChangePassword');
Route::post('/UpdatePassword','MemberController@UpdatePassword');



Route::post('/membershipPost', 'User\MembershipPurchaseController@membershipPost');
Route::post('membershipPaymentCreate', 'PaymentController@membershipPaymentCreate')->name('membershipPaymentCreate');
Route::get('membershipPaymentExecute','PaymentController@membershipPaymentExecute');
Route::get('/MemberShipAdd/{id}', 'User\MembershipPurchaseController@membershipAdd');
Route::get('/MemberShip', 'User\MembershipPurchaseController@membership');
Route::get('/purchasedmembership', 'User\MembershipPurchaseController@MemberPurchasedDetails');
Route::get('/purchasedticketdetails', 'MemberController@MemberPurchasedTicketDetails');


Route::get('/MyEvents', 'MemberController@MyEvents');
Route::get('/ViewEvent/{id}', 'MemberController@ViewEvent');

Route::get('/AddVolunteer', 'MemberController@AddVolunteer');
Route::post('/AddVolunteer', 'MemberController@AddVolunteerSave');


Route::get('/MemberShip/Skip/FamilyMembers', 'FamilyMemberController@SkipFamilyMembers')->name('membership.add.familyMembers');

Route::post('/MemberShip/Add/FamilyMembers', 'FamilyMemberController@AddMembershipFamilyMembers')->name('membership.save.familyMembers');

Route::get('/MemberShip/Buy', 'User\MembershipPurchaseController@MembershipBuy')->name('membership.buy');

Route::get('/MemberShip/{id}', 'User\MembershipPurchaseController@membershipAdd');
Route::get('/Competition/AgeValidation', 'MemberController@AgeValidation');


Route::get('/donations', 'MemberController@listDonation');

Route::get('/donation/add', 'MemberController@addDonation');
Route::post('/donation/save', 'MemberController@SaveDonation');
Route::get('/sponsors', 'MemberController@Sponsorship');
Route::post('/sponsors/add', 'MemberController@AddSponsorship');

Route::get('memberpaymentComplete', 'User\PaymentController@memberpaymentComplete')->name('memberpaymentComplete');

Route::get('membershippaymentComplete', 'User\MembershipPaymentController@membershippaymentComplete')->name('membershippaymentComplete');

Route::get('/getStatus','User\PaymentController@getPaymentStatus')->name('status');

Route::get('/getMembershipStatus','User\MembershipPaymentController@getPaymentStatus')->name('membership.status');

Route::get('donationpaymentComplete', 'User\DonationPaymentController@donationpaymentComplete')->name('memberpaymentComplete');

Route::get('sponsorshippaymentComplete', 'User\SponsorshipPaymentController@sponsorshippaymentComplete')->name('sponsorshippaymentComplete');

Route::get('/getDonationStatus','User\DonationPaymentController@getPaymentStatus')->name('donation.status');

Route::get('/getSponsorshipStatus','User\SponsorshipPaymentController@getPaymentStatus')->name('sponsorship.status');




/******** Pay Later *************/

Route::get('/payLater/list','User\PayLaterController@list')->name('payLater.list');


Route::get('/payLater/pay/{id}','User\PayLaterController@payNow')->name('payLater.pay');


Route::get('/getPayLaterStatus','User\PayLaterController@getPayLaterStatus')->name('payLater.status');


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
  Route::get('/addEventcompetitions', 'EventController@addEventcompetitions');
  Route::post('/addEventcompetitionsSave', 'EventController@addEventcompetitionsSave');

  /********* Duplicate Event *****************/

  Route::get('/createDuplicateEvent/{id}', 'Admin\EventDuplicationController@createDuplicateEvent');
  Route::post('/addDuplicateEvent', 'Admin\EventDuplicationController@addDuplicateEventPost')->name('admin.duplicateEventSave');
  Route::get('/addDuplicateEventcompetitions/{id}', 'Admin\EventDuplicationController@addDuplicateEventcompetitions');
  Route::post('/addDuplicateEventcompetitionsSave', 'Admin\EventDuplicationController@addDuplicateEventcompetitionsSave');

  /*********** Vip Tickets ***************/
  Route::get('/Event/addVipTicket/{id}','Admin\VipJudgeController@addVipTicket');
  Route::post('/Event/createVipTicket','Admin\VipJudgeController@createVipTicket');

  Route::get('/Event/FoodTicket/Validation','EventController@EventFoodTicketStatusChange');
  Route::get('/Event/EntryTicket/Validation','EventController@EventEntryTicketStatusChange');
  Route::get('/Event/Competition/Validation','EventController@EventCompetitionStatusChange');

  Route::get('/addEventTicket','EventController@addEventTicket');
  Route::post('/addEventTicket', 'EventController@addEventTicketPost');
  Route::get('/eventTicketDelete','EventController@eventTicketDelete');

  Route::get('/Event/addEventEntryTicket/{id}', 'EventController@addEventEntryTicket');
  Route::post('/Event/addEventEntryTicketPost', 'EventController@addEventEntryTicketPost');

  Route::get('/editEventEntryTicket/{id}','EventController@editEventEntryTicket');

  Route::get('/Event/addEventFoodTicket/{id}', 'EventController@addEventFoodTicket');
  Route::post('/Event/addEventFoodTicketPost', 'EventController@addEventFoodTicketPost');
  Route::get('/Event/FoodTicket/Delete','EventController@EventFoodTicketDelete');

  Route::get('/Event/addCompetition/{id}', 'EventController@addEventCompetition');
  Route::post('/Event/addEventCompetitionPost', 'EventController@addEventCompetitionPost');

  Route::get('/manageEvent', 'EventController@manageEvent');
  Route::get('/eventEdit/{id}', 'EventController@eventEdit');
  Route::get('/eventTickets/{id}', 'EventController@eventTickets');
  
  Route::post('/eventUpdate','EventController@eventUpdate');
  Route::get('/eventDelete', 'EventController@eventDelete');
  Route::get('/editEventTicket/{id}','EventController@editEventTicket');
  Route::post('/UpdateEventEntryTicket','EventController@UpdateEventEntryTicket');
  Route::post('/UpdateEventFoodTicket','EventController@UpdateEventFoodTicket');

  Route::get('/editEventCompetition/{id}/{eventId}','EventController@EditEventCompetition')->name('admin.event.competition.edit');

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
      Route::get('/Delete','MembershipController@DeleteMembership')->name('admin.membership.delete');
  });
  Route::prefix('Competition')->group(function() {

      Route::get('/List','CompetitionController@ListCompetition')->name('admin.competition.list');

      Route::get('/Add', 'CompetitionController@AddCompetition')->name('admin.competition.add');
      Route::post('/Save', 'CompetitionController@SaveCompetition')->name('admin.competition.save');
      Route::get('/Edit/{id}', 'CompetitionController@EditCompetition')->name('admin.competition.edit');
      Route::post('/Update','CompetitionController@UpdateCompetition')->name('admin.competition.update');
      Route::get('/Delete','CompetitionController@DeleteCompetition')->name('admin.competition.delete');
  });

Route::prefix('Location')->group(function() {

      Route::get('/List','LocationController@ListLocation')->name('admin.location.list');

      Route::get('/Add', 'LocationController@AddLocation')->name('admin.location.add');
      Route::post('/Save', 'LocationController@SaveLocation')->name('admin.location.save');
      Route::get('/Edit/{id}', 'LocationController@EditLocation')->name('admin.location.edit');
      Route::post('/Update','LocationController@UpdateLocation')->name('admin.location.update');
      Route::get('/Delete','LocationController@DeleteLocation')->name('admin.location.delete');
  });
Route::prefix('Food')->group(function() {

      Route::get('/List','FoodController@ListFoodTypes')->name('admin.food.list');

      Route::get('/Add', 'FoodController@AddFoodTypes')->name('admin.food.add');
      Route::post('/Save', 'FoodController@SaveFoodTypes')->name('admin.food.save');
      Route::get('/Edit/{id}', 'FoodController@EditFoodTypes')->name('admin.food.edit');
      Route::post('/Update','FoodController@UpdateFoodTypes')->name('admin.food.update');
      Route::get('/Delete','FoodController@DeleteFoodTypes')->name('admin.food.delete');
  });

Route::prefix('Entry')->group(function() {

      Route::get('/List','EntryConfigurationController@ListEntries')->name('admin.entry.list');

      Route::get('/Add', 'EntryConfigurationController@AddEntries')->name('admin.entry.add');
      Route::post('/Save', 'EntryConfigurationController@SaveEntries')->name('admin.entry.save');
      Route::get('/Edit/{id}', 'EntryConfigurationController@EditEntries')->name('admin.entry.edit');
      Route::post('/Update','EntryConfigurationController@UpdateEntries')->name('admin.entry.update');
      Route::get('/Delete','EntryConfigurationController@DeleteEntries')->name('admin.entry.delete');
  });

  Route::prefix('sponsorship')->group(function() {

      Route::get('/List','SponsorshipController@List')->name('admin.sponsorship.list');
      Route::get('/Add', 'SponsorshipController@Add')->name('admin.sponsorship.add');
      Route::post('/Save', 'SponsorshipController@Save')->name('admin.sponsorship.save');
      Route::get('/Edit/{id}', 'SponsorshipController@Edit')->name('admin.sponsorship.edit');
      Route::post('/Update','SponsorshipController@Update')->name('admin.sponsorship.update');
      Route::get('/Delete','SponsorshipController@Delete')->name('admin.sponsorship.delete');
  });
  
  
  Route::prefix('Campaign')->group(function() {

      Route::get('/List','Admin\CampaignController@list')->name('admin.campaign.list');

      Route::get('/Add', 'Admin\CampaignController@add')->name('admin.campaign.add');
      Route::post('/Save', 'Admin\CampaignController@create')->name('admin.campaign.save');
      Route::get('/Edit/{id}', 'Admin\CampaignController@edit')->name('admin.campaign.edit');
      Route::post('/Update','Admin\CampaignController@update')->name('admin.campaign.update');
      Route::get('/Delete','Admin\CampaignController@delete')->name('admin.campaign.delete');
  });


  Route::get('/member_details', 'AdminController@member_details');
  Route::get('/membersearch', 'AdminController@membersearch');

  Route::get('/FoodTicketsReport', 'ReportsController@FoodTicketsReport');
  
  Route::get('/FoodTicketsReports/Filter', 'ReportsController@FoodTicketsReportFilter')->name('foodticket.reports.filter');


  Route::get('/EntryTicketsReport', 'ReportsController@EntryTicketsReport');

  Route::get('/EntryTicketsReports/Filter', 'ReportsController@EntryTicketsReportFilter')->name('entryticket.reports.filter');

  Route::get('/VolunteerReports', 'ReportsController@VolunteerReports');
  Route::get('/VolunteerReports/Filter', 'ReportsController@VolunteerReportsFilter')->name('volunteer.reports.filter');

  Route::get('/donations', 'ReportsController@DonationsReport');
  Route::get('/sponsors', 'ReportsController@SponsorsReport');
  Route::get('/sponsors/Filter', 'ReportsController@sponsorsReportsFilter')->name('sponsors.reports.filter');
  Route::get('/donations/Filter', 'ReportsController@donationsReportsFilter')->name('donations.reports.filter');

  Route::get('/CompetitionReport', 'ReportsController@CompetitionReport');

  Route::get('/CompetitionReport/Filter', 'ReportsController@CompetitionReportFilter')->name('competition.reports.filter');

  Route::get('/Payments', 'AdminController@PaymentList');
  Route::get('/PaymentEdit/{id}', 'AdminController@PaymentEdit');
    Route::post('/UpdatePayment','AdminController@UpdatePayment');

    Route::get('/RegistrationPaymentEdit/{id}', 'AdminController@RegistrationPaymentEdit');
    Route::post('/RegistrationPaymentUpdate','AdminController@RegistrationPaymentUpdate');

  Route::get('/Member/EditMembership/{id}', 'AdminController@EditMembership');
Route::post('/Member/UpdateMembership', 'AdminController@UpdateMembership');

  Route::get('/Member/EditMembership/{id}', 'AdminController@EditMembership');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
