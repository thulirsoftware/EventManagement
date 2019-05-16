<?php

Route::get('/', function () {
    return view('welcome');
});


//  Non Member Event
Route::get('/nonMemberTicket','nonMemberController@nonMemberTicket');
Route::get('/nonMemberBuyTicket/{id}','nonMemberController@nonMemberBuyTicket');
Route::post('/nonMemberBuyTicketPost', 'nonMemberController@nonMemberBuyTicketPost');
Route::get('/nonMemberTicketView','nonMemberController@nonMemberTicketView');
Route::get('/execute-payment', 'PaymentController@execute');

Route::post('nonMemberEventPaymentCreate', 'PaymentController@nonMemberEventPaymentCreate')->name('nonMemberEventPaymentCreate');
Route::get('nonMemberEventPaymentExecute', 'PaymentController@nonMemberEventPaymentExecute');



Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::get('/familyMembers','FamilyMemberController@familyMembers');
Route::post('/addFamilyMembers','FamilyMemberController@addFamilyMembers');
Route::get('/familyEdit/{id}', 'FamilyMemberController@familyEdit');
Route::post('/familyUpdate','FamilyMemberController@familyUpdate');
Route::get('/familyDelete/{id}','FamilyMemberController@familyDelete');




Route::get('/memberTickets','MemberController@memberTickets');
Route::get('/memberBuyTicket/{id}','MemberController@memberBuyTicket');
Route::post('/memberBuyTicketPost', 'MemberController@memberBuyTicketPost');
Route::get('/memberTicketView','MemberController@memberTicketView');
Route::post('memberEventPaymentCreate', 'PaymentController@memberEventPaymentCreate')->name('memberEventPaymentCreate');
Route::get('memberEventPaymentExecute','PaymentController@memberEventPaymentExecute');



Route::get('/userhome','MemberController@userhome');
Route::get('/purchase_event_tickets','MemberController@purchase_event_tickets');
Route::get('/edit_members','MemberController@edit_members');
Route::get('/user_home','MemberController@user_home');
Route::get('/renew_membership','MemberController@renew_membership');
Route::get('/editProfile','MemberController@editProfile');
Route::post('/editProfilePost','MemberController@editProfilePost');



Route::get('/membership','MemberController@membership');
Route::post('/membershipPost', 'MemberController@membershipPost');
Route::post('membershipPaymentCreate', 'PaymentController@membershipPaymentCreate')->name('membershipPaymentCreate');
Route::get('membershipPaymentExecute','PaymentController@membershipPaymentExecute');









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



  Route::get('/manageAdmin', 'AdminController@manageAdmin');
  Route::get('/addAdmin', 'AdminController@addAdmin');
  Route::post('/addAdmin', 'AdminController@addAdminPost');
  Route::get('/adminEdit/{id}', 'AdminController@adminEdit');
  Route::post('/adminUpdate','AdminController@adminUpdate');
  Route::get('/adminDelete/{id}','AdminController@adminDelete');

  Route::get('/addEvent', 'AdminController@addEvent');
  Route::post('/addEvent', 'AdminController@addEventPost');
  Route::get('/addEventTicket','AdminController@addEventTicket');
  Route::post('/addEventTicket', 'AdminController@addEventTicketPost');
  Route::get('/eventTicketDelete/{id}','AdminController@eventTicketDelete');

  Route::get('/manageEvent', 'AdminController@manageEvent');
  Route::get('/eventEdit/{id}', 'AdminController@eventEdit');
  Route::post('/eventUpdate','AdminController@eventUpdate');
  Route::get('/eventDelete/{id}', 'AdminController@eventDelete');
  Route::get('/editEventTicket/{id}','AdminController@editEventTicket');

  Route::get('/memberDetails','AdminController@memberDetails');


  Route::get('/editMember/{id}','AdminController@editMember');
  Route::post('/editMemberUpdate','AdminController@editMemberUpdate');


  Route::get('/manageSchool','AdminController@manageSchool');
  Route::get('/addSchool', 'AdminController@addSchool');
  Route::post('/addSchoolPost', 'AdminController@addSchoolPost');
  Route::get('/schoolEdit/{id}', 'AdminController@schoolEdit');
  Route::post('/schoolUpdate','AdminController@schoolUpdate');
  Route::get('/schoolDelete/{id}','AdminController@schoolDelete');

  Route::get('/manageMembership','AdminController@manageMembership');
  Route::get('/addMembership', 'AdminController@addMembership');
  Route::post('/addMembershipPost', 'AdminController@addMembershipPost');
  Route::get('/membershipEdit/{id}', 'AdminController@membershipEdit');
  Route::post('/membershipUpdate','AdminController@membershipUpdate');
  Route::get('/membershipDelete/{id}','AdminController@membershipDelete');


});
