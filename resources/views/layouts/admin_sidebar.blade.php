<style>
  .navbar-default .navbar-nav>li>a {
    color: #fff;
}
.nav-side-menu {
  overflow: auto;
  font-family: verdana;
  font-size: 14px;
  font-weight: 200;
  background-color: #feffc9;
  position: fixed;
  top: 7.8%;
  left: 0%;
  width: 20%;
  height: 100%;
  color: brown;
}
.nav-side-menu .brand {
  background-color: #23282e;
  line-height: 50px;
  display: block;
  text-align: center;
  font-size: 14px;
 
Siva 
}
.nav-side-menu .toggle-btn {
  display: none;
}
.nav-side-menu ul,
.nav-side-menu li {
  list-style: none;
  padding: 0px;
  margin: 0px;
  line-height: 35px;
  cursor: pointer;
  /*    
    .collapsed{
       .arrow:before{
                 font-family: FontAwesome;
                 content: "\f053";
                 display: inline-block;
                 padding-left:10px;
                 padding-right: 10px;
                 vertical-align: middle;
                 float:right;
            }
     }
*/
}
.menu-list
{
  margin-top: 1%;
}
.nav-side-menu ul :not(collapsed) .arrow:before,
.nav-side-menu li :not(collapsed) .arrow:before {
  font-family: FontAwesome;
  content: "\f078";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
  float: right;
}

.nav-side-menu ul .sub-menu li:before,
.nav-side-menu li .sub-menu li:before {
  font-family: FontAwesome;
  content: "\f105";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
}
.nav-side-menu li {
  padding: 5px;
  margin-left:15px;
    /*border-left: 3px solid #2e353d;
    border: 1px solid #23282e;*/
}

.nav-side-menu li a {
  text-decoration: none;
  color: brown;

}
.nav-side-menu li a i {
  padding-left: 10px;
  width: 20px;
  padding-right: 20px;
}

@media (max-width: 767px) {
  .navbar-default 
  {
    width: 100%;
  }
  .nav-side-menu {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
    height:  20%;
    left: 0%;
  }
  .nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 10px;
    z-index: 10 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
  }
  .brand {
    text-align: left !important;
    font-size: 22px;
    padding-left: 20px;
    line-height: 50px !important;
    color: #fff;
  }

}
@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
  }
}
body {
  margin: 0px;
  padding: 0px;
}
.navbar{ margin-bottom: 0; }
.navbar-default {
    background-color:brown;
    border-color: #feffc9;
    position: fixed;
  top: 0;
  width: 100%;
    
}
.navbar-default .navbar-brand {
color: #7A7A86;
}
.panel-primary { opacity: 0.9; }
.red,.orange,.green,.blue .fa
{
  font-size: 30px;
}
.red .fa
{ color: #FA2A02; }
.orange .fa
{ color: #FFB402; }
.green .fa
{ color: #19BC9C; }
.blue .fa
{ color: #21A7F0; }

.panel-primary {
    border-color: #19BC9C;
}
.panel-primary>.panel-heading {
    color: #fff;
    background-color: #19BC9C;
    border-color: #19BC9C;
}
.panel-primary .panel-body th
{ color: red; }
.fa-pencil-square-o
{ color: #0662FE; }
.fa-trash-o
{ color: red; }
.red .panel-primary,.red .panel-primary .panel-heading
{
  background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #FA2A02;
}
.orange .panel-primary,.orange .panel-primary .panel-heading
{
background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #FFB402;
}
.green .panel-primary,.green .panel-primary .panel-heading
{
  background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #19BC9C;
}
.blue .panel-primary,.blue .panel-primary .panel-heading
{
 background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #21A7F0;
}
.row
{ margin-right: 0; }
.fa-edit
{
  color:blue;
  font-size: 20px;
}
.fa-check-square-o
{
  color:green;
  font-size: 20px;
}




 /*sidebar navbar*/

.dropbtn {
    background-color:  #feffc9;
    color: brown;
    padding: 16px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color:  #feffc9;
}

.dropdown {
    position: relative;
    display: inline-block;
    background-color:  white;
    border:1px solid brown;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color:  #0091bf;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: brown;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: brown;}

.show {display: block;}


</style>
<div class="col-md-2">
    <div class="nav-side-menu">
      <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

      <div class="menu-list">
              
              {{-- <li data-toggle="collapse" data-target="#locations" class="collapsed">
              <a href="{{ url('admin/dashboard') }}"><i class="fa fa-area-chart fa-lg"></i> Dashboard </a></li> --}}

              <li data-toggle="collapse" data-target="#advertisement" class="collapsed">
              <a href="{{ url('admin/manageAdmin') }}"><i class="fa fa-user fa-lg"></i>Manage Admin </a></li>

              <li data-toggle="collapse" data-target="#notifications" class="collapsed">
              <a href="{{ url('admin/memberDetails') }}"><i class="fa fa-bell fa-lg"></i> Members </a></li>

              <li data-toggle="collapse" data-target="#advertisement" class="collapsed">
              <a href="{{ url('admin/manageEvent') }}"><i class="fa fa-calendar fa-lg"></i>Events </a></li>

              <li data-toggle="collapse" data-target="#advertisement" class="collapsed">
              <a href="{{ url('admin/addEvent') }}"><i class="fa fa-bullhorn fa-lg"></i>Add Events </a></li>         

              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('admin/manageSchool') }}"><i class="fa fa-book fa-lg"></i> Tamil School </a></li>

              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('admin/manageMembership') }}"><i class="fa fa-book fa-lg"></i> Membership </a></li>
                            
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('admin/logout') }}"><i class="fa fa-info-circle fa-lg"></i> Logout </a></li>
              
        </ul>
      </div>
    </div>
  </div>


  <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>