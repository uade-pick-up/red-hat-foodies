<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2020.
**********************************************************************************************************  -->
<!-- 
Template Name: eClass - Learning Management System 
Version: 1.2.0
Author: Media City
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> -->
<html lang="en">
<!-- <![endif]-->
<!-- head -->
@include('theme.head')
<!-- end head -->
<!-- body start-->
<body>
<!-- top-nav bar start-->
@include('theme.nav')
<!-- top-nav bar end-->
<!-- home start -->
@yield('content')
<!-- testimonial end -->
<!-- footer start -->
@include('theme.footer')
<!-- footer end -->
<!-- jquery -->
@include('theme.scripts')
<!-- end jquery -->
</body>
<!-- body end -->
</html> 
