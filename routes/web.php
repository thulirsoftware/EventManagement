<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nonMemberTicket','nonMemberController@nonMemberTicket');
Route::get('/nonMemberBuyTicket/{id}','nonMemberController@nonMemberBuyTicket');
Route::post('/nonMemberBuyTicketPost', 'nonMemberController@nonMemberBuyTicketPost');

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




Route::get('/userhome','MemberController@userhome');
Route::get('/purchase_event_tickets','MemberController@purchase_event_tickets');
Route::get('/edit_members','MemberController@edit_members');
Route::get('/user_home','MemberController@user_home');
Route::get('/renew_membership','MemberController@renew_membership');
Route::get('/edit_profile','MemberController@edit_profile');




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

});
