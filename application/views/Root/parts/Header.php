<?php
  $user_id = $this->session->userdata('userid');
  $NamaUser = $this->session->userdata('NamaUser');
  if($user_id == ''){
    echo "<script>location.replace('".base_url()."root');</script>";
  }
//test
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Matrix Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/fullcalendar.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/matrix-media.css" />
<link href="<?php echo base_url();?>Assets/root/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/css/bootstrap-wysihtml5.css" />
<!-- <link rel="stylesheet" href="<?php echo base_url();?>test/index.js" /> -->
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/verticaltab/bootstrap.vertical-tabs.css">

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" /> -->

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script> -->
<!-- Sweet alert -->
<script src="<?php echo base_url();?>Assets/root/sweetalert2-8.8.0/package/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>Assets/root/sweetalert2-8.8.0/package/dist/sweetalert2.min.css">

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<!-- dev express -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.6/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.6/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/19.1.6/js/dx.all.js"></script>
    <script src="data.js"></script>

<style type="text/css">
  body.scrollable {
  overflow-y: auto; }
</style>
</head>
<body>

<!--Header-part-->
<div id="header">
  <!-- <img style="padding-top: 5px; padding-bottom: 5px; padding-left: 30px;" src="<?php echo base_url();?>Assets/root/img/CRLogo.png" width = "10%"> -->
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="<?php echo base_url(); ?>auth/logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text"><?php echo $NamaUser; ?></span></a>
      <ul class="dropdown-menu">
        <li><a class="sInbox" title="" href="<?php echo base_url(); ?>/home/change"><i class="icon-key"></i> Change Password</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->
