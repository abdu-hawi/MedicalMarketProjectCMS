<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="includeOP/myCode.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/dataTable/datatables.min.css">
<script src="bootstrap/dataTable/jquery.dataTables.min.js"></script>
<title>Med Market</title>
</head>

<body style="background:#f8f8f8;">
<nav class="navbar navbar-default" style="margin-bottom:0px;font-size:1.0em;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=""style="font-size:1.2em;">Med Market</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

<div class="col-md-2 col-lg-2 navbar-default aside" style="font-size:1.0em;padding-left:0px;padding-right:0px;">
  <ul class="nav nav-pills nav-stacked" id="aside">
  	<input type="button" value="ORDER LIST" id="order_list" class="btn btn-success btn-block text-center" style="margin-top:5px;" />
    <li class="active" id="add_supply" style="margin-top:0.5em;"><a href="#">Add Supply</a></li>
    <li id="add_item"><a href="#">Add Item</a></li>
    <li id="supply_list"><a href="#">Supply List</a></li>
    <li id="item_list"><a href="#">Item List</a></li>
    <li id="user_list"><a href="#">User</a></li>
    <li id="menu3"><a href="#">Menu 3</a></li>
  </ul>
</div>

<div class="col-lg-10 col-md-10 nav navbar-inverse" id="searchDiv" style="border-left:#e7e7e7 solid 1px; padding:1em;">
<div class="container-fluid">
<input type="text" class="form-control" placeholder="Search" id="searchBox">
</div>
</div>

<div class="col-lg-10" id="mm_content" style="border-left:#e7e7e7 solid 1px; padding-top:1em; background:#fff;"></div>
</body>
</html>
