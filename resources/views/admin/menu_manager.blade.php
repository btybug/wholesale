@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-md-4">
  
<div class="box box-primary">
   <div class="box-header with-border">
      <h3 class="box-title">Add Routes</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <div id="all-routes" class="box-body" style="overflow-y: scroll; max-height: 150px;" data-name="Unnamed">
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="test"> <span>Test</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="home"> <span>Home</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="dashboard"> <span>Dashboard</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="user-role-managements.index"> <span>User role managements</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="user-role-managements.create"> <span>User role managements - create</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="users.index"> <span>Users</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="users.create"> <span>Users - create</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="profile.index"> <span>Profile</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="profile.edit"> <span>Profile - edit</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="profile.change-password"> <span>Profile - change password</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="profile.setting"> <span>Profile - setting</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="profile.setting.edit"> <span>Profile - setting - edit</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="profile.avatar.edit"> <span>Profile - avatar - edit</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="admin-settings.index"> <span>Admin settings</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="system-notices.index"> <span>System notices</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="system-notices.create"> <span>System notices - create</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="notices.index"> <span>Notices</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="logs.index"> <span>Logs</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="audits.index"> <span>Audits</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="logout"> <span>Logout</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="menu-manager.index"> <span>Menu manager</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="login"> <span>Login</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="register.index"> <span>Register</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="forget-password.index"> <span>Forget password</span>
         </label>
      </div>
      <div class="checkbox" style="margin:3px 0;">
         <label>
         <input type="checkbox" class="route-check-box" value="verification.form"> <span>Verification - email</span>
         </label>
      </div>
   </div>
   <div class="box-footer">
      <button class="btn btn-primary" id="add-route">Add Route</button>
   </div>
</div>
<div class="box box-primary">
   <div class="box-header with-border">
      <h3 class="box-title">Add LINK</h3>
   </div>
   <!-- /.box-header -->
   <!-- form start -->
   <div class="box-body">
      <div class="form-group">
         <input type="text" id="link-data" placeholder="Enter url" class="form-control">
      </div>
      <div class="form-group">
         <input type="text" data-name="Unnamed" id="link-name" placeholder="Enter Menu Item Name" class="form-control">
      </div>
   </div>
   <div class="box-footer">
      <button class="btn btn-primary" id="add-link">Add A custom Link</button>
   </div>
</div>
  </div>
  <div class="col-md-8">
  <form id="menu-manager-form">
  <ol class="mymenu ui-sortable">
  <li class="individual-menu-item">
   <div class="innermenu">
      <div class="innermenuhead">
         <div class="title ui-sortable-handle">
            Profile setting
         </div>
         <div class="type"><span class="arrow-icon">
            Route
            <i class="fa fa-caret-right"></i></span>
         </div>
      </div>
      <div class="innermenubody">
         <p><label>Navigation Label<br></label><input type="text" class="name" value="Profile setting" name="menu_item[2][name]"></p>
         <p style="padding-top:10px"><label>Route: profile.setting</label></p>
         <div class="row">
            <div class="col-xs-6">
               <p><label>Extra Class<br></label><input type="text" name="menu_item[2][class]" value="" class="prevent-default"></p>
            </div>
            <div class="col-xs-6">
               <p><label>Menu Icon<br></label><input type="text" name="menu_item[2][icon]" value="" class="prevent-default"></p>
            </div>
         </div>
         <p><label>Beginning Text<br></label><input type="text" name="menu_item[2][beginning_text]" value="" class="prevent-default"></p>
         <p><label>Ending Text<br></label><input type="text" name="menu_item[2][ending_text]" value="" class="prevent-default"></p>
         <p><label for=""></label><input type="checkbox" class="newwindow"><em>Open link in a new window/tab</em></p>
         <p class="mymgmenu"><label for=""></label><input type="checkbox" class="megamenu"><em>Use As Mega Menu</em></p>
         <hr class="myhrborder">
         <button class="deletebutton">Remove</button>
        
      </div>
   </div>
</li>
</ol>
</form>
  </div>
</div>

@stop
@section("css")
<link rel="stylesheet" href="http://laraframe.codemen.org/backend/assets/css/menu.css">
@stop

@section("js")
<script src="http://laraframe.codemen.org/backend/vendors/menu_manager/jquery.mjs.nestedSortable.js"></script>
<script src="/public/js/custom/menu_manager.js"></script>
@stop