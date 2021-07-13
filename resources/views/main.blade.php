<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Basic page needs -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <!-- fevicon -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
.main-content{
	width: 36%;
	border-radius: 20px;
	box-shadow: 0 5px 5px rgba(0,0,0,.4);
	margin: 5em auto;
	display: flex;
}
.company__info{
	background-color: #1f5387;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
	display: flex;
	flex-direction: column;
	justify-content: center;
	color: #fff;
}
.fa-android{
	font-size:3em;
}
@media screen and (max-width: 640px) {
	.main-content{width: 90%;}
	.company__info{
		display: none;
	}
	.login_form{
		border-top-left-radius:20px;
		border-bottom-left-radius:20px;
	}
}
@media screen and (min-width: 642px) and (max-width:800px){
	.main-content{width: 70%;}
}
.row > h4{
	color:#1f5387;
}
.login_form{
	background-color: #fff;
	border-top-right-radius:20px;
	border-bottom-right-radius:20px;
	border-top:1px solid #ccc;
	border-right:1px solid #ccc;
}
form{
	padding: 0 2em;
}
.form__input{
	width: 100%;
	border:0px solid transparent;
	border-radius: 0;
	border-bottom: 1px solid #aaa;
	padding: 1em .5em .5em;
	padding-left: 2em;
	outline:none;
	margin:1.5em auto;
	transition: all .5s ease;
}
.form__input:focus{
	border-bottom-color: #1f5387;
	box-shadow: 0 0 5px rgba(0,80,80,.4); 
	border-radius: 4px;
}
input[type=submit]{
	transition: all .5s ease;
	width: 70%;
	border-radius: 30px;
	color:#1f5387;
	font-weight: 600;
	background-color: #fff;
	border: 1px solid #1f5387;
	margin-top: 1.5em;
	margin-bottom: 1em;
}
input[type=submit]:hover, input[type=submit]:focus{
	background-color: #1f5387;
	color:#fff;
}
 .field-icon {
    float: right;
    margin-right: 2px;
    margin-top: -45px;
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

       </style>
        @include('components.header')
        
    </head>
    
	 @yield('content')
</html>
	