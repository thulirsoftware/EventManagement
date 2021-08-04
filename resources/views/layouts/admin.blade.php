
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{ config('app.name', 'Blackstone') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="{{ asset('assets/time-pick/time-pick-dark.css') }}">
<link rel="stylesheet" href="{{ asset('assets/time-pick/time-pick-light.css') }}">
  <Style>
    .field-icon {
    float: right;
    margin-right: 2px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
}
.fa {
    display: inline-block;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

  .layout-fixed .main-sidebar{ background-color: #1f5387; }
  .nav-sidebar .nav-item > .nav-link { color: #fff; }
  .main-footer{ margin-left: 0px; }
.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
    background-color: white;
    color: #1f5387;
}
.btn-back{
  background-color: #1f5387;
  color:white;
}




/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}


/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
.project-tab {
}
.project-tab #tabs{
    background: #1f5387;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #1f5387;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #1f5387;
    font-size: 16px;
    font-weight: 600;
}
.project-tab .nav-link:hover {
    border: none;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}
.project-tab a{
    text-decoration: none;
    color: #333;
    font-weight: 600;
}
.btn-primary{
  background-color: #4267B2;
  border:1px solid #4267B2;
}
.btn-primary:hover{
  background-color: #4267B2;
  border:1px solid #4267B2;
}#prevBtn {
  background-color: #bbbbbb;
}

.button {
  background-color: #1f5387;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

.button:hover {
  opacity: 0.8;
}
.button1 {
  background-color: #1f5387;
  color: #ffffff;
  border: none;
  padding: 7px 10px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
  border-radius: 20px;
}

.button1:hover {
  opacity: 0.8;
}
button[disabled]{
background-color: #cccccc;
color: #666666;
cursor: not-allowed;
  pointer-events: all !important;
}

  </Style>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper flex-wrapper">
      <div >
      @include('layouts.admin_sidebar')
      @yield('content')
    </div>
    <div>
      @include('layouts.footer')
      <aside class="control-sidebar control-sidebar-dark">
      </aside>
    </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script> $.widget.bridge('uibutton', $.ui.button); </script>
   
    <link rel="stylesheet" href="{{ asset('assets/plugins/time-picker-bootstrap/timepicker.css')}}">
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
     <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <!-- Toaster -->
        <!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/time-pick/time-pick.js')}}"></script>

<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
<script>
window.addEventListener("load", function(){
 
  tp.attach({
    target: "event_time",
  });
});
</script>
<script>
  $(function () {
    // Summernote


$('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});


    $('#editor1').summernote();
     var x = localStorage.getItem("Emails"); 
     var nameArr = x.split(',');
    $exampleMulti = $('.select2').select2();
    $exampleMulti.val(nameArr);
     $('.timepicker').wickedpicker();

    //Flat red color scheme for iCheck
      
  });
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
$('#ticketPrice').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
$('#foodticketPrice').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
$('#Amount').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
    $("#free_count").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

}); 
      $("#min_age").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

}); 
        $("#max_age").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

}); 
$("#food_min_age").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

}); 
$("#food_max_age").keypress(function(e) {
    var a = [];
    var k = e.which;

    for (i = 48; i < 58; i++)
      a.push(i);

  if (!(a.indexOf(k)>=0))
      e.preventDefault();

}); 
</script>
 <script>
    $('#member_fee').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
   </script>
   <script>
    $('#non_member_fee').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
   </script>
   <script>
    $('#price').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
   </script>
   <script>
    $('#age_limit').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
   </script>
   <script>
    $('#max_age').keypress(function(e) {
    var a = [];
    var k = e.which;
    
    for (i = 48; i < 58; i++)
        a.push(i);
    
    if (!(a.indexOf(k)>=0))
        e.preventDefault();
    
});
   </script>
<script>
    $(function () {

      $("#competition_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
        $("#event_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,
        "oLanguage": {
        "sEmptyTable": "New Events Not Available"
        }   

      });
     $("#event_entry_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,
        "oLanguage": {
        "sEmptyTable": "Entry Tickets Not Available for Event"
        }   

      });
     $("#event_food_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,
        "oLanguage": {
        "sEmptyTable": "Food Tickets Not Available for Event"
        }  

      });
     $("#event_competition_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,
        "oLanguage": {
        "sEmptyTable": "Competition Not Available for Event"
        }  

      });
      $("#membership_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,
        "oLanguage": {
        "sEmptyTable": "Membership Not available"
        }  

      });
      $("#payments_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
       $("#food_entry_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
        $("#food_report_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
      $("#volunteer_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
      $("#members_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
       $("#non_members_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
       $("#family_members_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
        $("#payments_tickets_list").DataTable({
        "responsive": true,
        "autoWidth": false,
        "iDisplayLength":25,
        "bSort": true,

      });
         
  
}); 
 </script>
  </body>
</html>
