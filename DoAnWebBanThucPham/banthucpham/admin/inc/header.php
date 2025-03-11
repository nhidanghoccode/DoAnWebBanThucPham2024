<?php
include '../lib/session.php';
Session::checkSession();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Quản trị viên</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-nf3gfylPGh6s4X2StPQZ2haP6T1N0d9RExo5u5pdGOj2s94qg7EmnmrBEjQN5jEf" crossorigin="anonymous">
    <link rel="icon" href="../img/logothucpham.jpg" type="image/jpeg">
	
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/jquery.dataTables.min.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12" style="background: #009966;">
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>bảng điều khiển</span></a> </li>
				
				<li class="ic-grid-tables"><a href="inbox.php"><span>Hộp thư đến</span></a></li>
                <div class="floatright" style="margin-left: 30%;">
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li style="line-height: 3rem;">Xin chào <?php echo Session::get('adminTen')?></li>
                            <?php
                            //xử lý đăng xuất
                                if(isset($_GET['action']) && $_GET['action']=='logout'){
                                    Session::destroy();
                                }
                            ?>
                            <li><a href="?action=logout">Đăng xuất</a></li>
                            
                        </ul>
                    </div>
                </div>
            </ul>
            
        </div>
        <div class="clear">
        </div>
    <style>

body {
  background: #009966 none repeat scroll 0 0;
  color: #444;
  font-size: 14px;
  padding: 0;
}
/* commons
----------------------------------------------- */
.floatleft{float:left;}
.logo img {
  margin-top: -15px;
  width: 52px;
}
.middle {
  margin-left: 22px;
  margin-top: -14px;
}
.middle h1{color:#ddd;margin:0}
.middle p {
  color: #ddd;
  margin: 0;
  font-weight: bold;
}
.floatright{float:right;}
.fontwhite{color:#fff;}
.small{font-size:9px;}
.inline-ul li{display:inline; color:#fff;}
.marginleft10{margin-left:10px;}
.grey{color:#C2C2C2;}

/* anchors
----------------------------------------------- */
a {
	color: #000;
	font-weight:bold;
	text-decoration: none;
}
a:hover {
	color:#333;
}


/* 960 grid system container background
----------------------------------------------- */
.container_12,
.container_16 {
	background: #009966;
}


/* headings
----------------------------------------------- */
h1, h2, h3, h4, h5, h6 {line-height:1.2em; margin-bottom:.3em;}
h2 {margin-top:1em;}

h6 {font-size:1em; text-transform:uppercase;}


h1 a {
	font-weight:normal;
}


/* branding
----------------------------------------------- */
/* #branding {
  font-weight: normal;
  margin-bottom: 0;
  padding: 22px 10px 3px;
  text-align: left;
}

.header-repeat{background:url(../img/header-repeat.jpg) repeat-x;}

#branding a{color:#A1EAFF; font-weight:normal;}
#branding a:hover{color:#fff;}

#branding a:before{content:" | "; color:#fff;}

#branding ul, #branding ul li{margin:0px; padding:0px; }
#branding li{padding:0px 0px 0px 0px !important;}
.top-10{margin-top:-10px;} */


/* page heading
----------------------------------------------- */
h2#page-heading {
	font-weight:normal;
	padding:.5em;
	margin:0 0 10px 0;
	border-bottom:1px solid #ccc;
	color:#fff;
}


/* boxes
----------------------------------------------- */
.box {
	background:#fff;
	margin-bottom:20px;
	padding:10px 10px 10px 10px; margin-left:-8px;
}
.box.grid{padding-bottom:40px;}
.box.round{
	  -moz-border-radius: 5px 5px 0px 0px; /* Firefox */
	  -webkit-border-radius: 5px 5px 0px 0px; /* Safari, Chrome */
	  border-radius: 5px 5px 0px 0px; /* CSS3 */
}
	  
.box h2 {
	font-size:1.2em;
	font-weight:bold;
	color:#066719;
	background: #b4f1c0;
	margin:-10px -10px 0 -10px;
	padding:10px 12px;
	border-bottom:1px solid #B3CBD6;
	
	 -moz-border-radius: 5px 5px 0px 0px; /* Firefox */
	  -webkit-border-radius: 5px 5px 0px 0px; /* Safari, Chrome */
	  border-radius: 5px 5px 0px 0px; /* CSS3 */
}
.box h2 a,
.box h2 a.visible {
	color:#066719;
	background:url("../img/switch_minus.gif") 97% 50% no-repeat;
	display:block;
	padding:6px 12px;
	margin:-6px -12px;
	border:none;
	
	 -moz-border-radius: 5px 5px 0px 0px; /* Firefox */
	  -webkit-border-radius: 5px 5px 0px 0px; /* Safari, Chrome */
	  border-radius: 5px 5px 0px 0px; /* CSS3 */
	
}
.grid_4 .box h2 a {
	background-position: 97% 50%;
}
.grid_5 .box h2 a {
	background-position: 98% 50%;
}
.grid_12 .box h2 a {
	background-position: 99% 50%;
}


.box h2 a.hidden,
.box h2 a.hidden:hover {
	background-image: url("../img/switch_plus.gif");
}
.box h2 a:hover {
	background-color:transparent;
}

.box.first {
  min-height: 406px;
}

.block {
	padding-top:20px;
}
.copyblock {
  border: 1px solid #e6f0f3;
  line-height: 32px;
  margin-left: 100px;
  margin-top: 20px;
  padding-left: 20px;
  width: 600px;
}
div.menu {
	padding:0;
}
div.menu h2 {
	margin:0;
}
div.menu .block {
	padding-top:0;
}


/* sidebar menu
----------------------------------------------- */

.box.sidemenu{ background: #b4f1c0; border-right:1px solid #3A5665; padding:0px; margin:0px; cursor:pointer; }
.box.sidemenu .block{padding-top:0px; margin-top:0px;}

/* paragraphs, quotes and lists
----------------------------------------------- */
p {
	margin-bottom:1em;
}
blockquote {
	font-family: Georgia, 'Times New Roman', serif;
	font-size:1.2em;
	padding-left:1em;
	border-left:4px solid #ccc;
}
blockquote cite {
	font-size:.9em;
}
ul, ol {
	padding-top:0;
}


/* menus
----------------------------------------------- */
ul.menu {
	list-style:none;
	border-top:1px solid #bbb;
}
ul.menu li {
	margin:0;
}
ul.menu li a {
	display:block;
	padding:4px 10px;
	border-bottom:1px solid #ccc;
}
ul.menu li a:hover {
	background:#eee;
}
ul.menu li a:active {
	background:#ccc;
}


/* submenus
----------------------------------------------- */
ul.menu ul {
	list-style:none;
	margin:0;
}
ul.menu ul li a {
	padding-left:30px;
}


/* section menus
----------------------------------------------- */
ul.section {
	border-top:0;
	margin-bottom:0;
}
/* ul.section li {

} */
ul.section li a {
	background:url(../img/sidemenu-repeat.jpg) repeat-x;
	line-height: 31px;
    padding-left: 11px;
}
ul.section li a:hover {
	background:url(../img/sidemenu-repeat-hover.jpg) repeat-x;
}
ul.section li a:active {
	color:#066719;
	background:url(../img/sidemenu-repeat-hover.jpg) repeat-x;
}
ul.section li li a {
	background:#fff;
	border-bottom:1px solid #eee;
}
ul.section li li a:hover {
	background:#ccc;
}
ul.section li li a:active {
	color:#000;
	background:#fff;
}
ul.section ul li {
	text-transform:none;
}
ul.section ul.current li a {
  background: #eee none repeat scroll 0 0;
  border-bottom: 1px solid #fff;
  font-size: 16px;
  font-weight: normal;
}
ul.section ul.current li a:hover {
	background: #b4f1c0;
}
ul.section ul.current li a:active {
	background: #b4f1c0;
}
ul.section li a.current {
	color:#066719;
	
}
ul.section li a.current:hover {
	color:#066719;
	
}
ul.section li a.current:active {
	color:#066719;
	
}
ul.section li a.active {
	background:#fff;
	cursor:default;
}
ul.section li.current > a.active,
ul.section li.current > a.active:hover {
	color:#fff;
	background:#666;
	cursor:default;
}


/* table
----------------------------------------------- */
table.form {
	width:100%;
}
table.form td {
	padding:4px 0px;
}
table.form label {
	font-weight:bold;
}

table.form .col1{width:20%;}
/* table.form .col2{} */
table.form input, table.form select{
    font-size: 15px;
	padding: 4px 4px 5px 4px;
	border-top: 1px solid #b3b3b3;
	border-left: 1px solid #b3b3b3;
	border-right: 1px solid #eaeaea;
	border-bottom: 1px solid #eaeaea;
}
table.form input[type="submit"] {
  border: 1px solid #ddd;
  color: white;
  cursor: pointer;
  font-size: 20px;
  padding: 3px 14px;
  background: #009966;
}
input.mini{width: 30%;	}

input.medium
{
	width: 55%;	
}

input.large
{
	width: 85%;	
}

input.date
{
	width: 180px;	
}

input.button
{
	margin: 0;
	padding: 4px 8px 4px 8px;
	background: #D4D0C8;
	border-top: 1px solid #FFFFFF;
	border-left: 1px solid #FFFFFF;
	border-right: 1px solid #404040;
	border-bottom: 1px solid #404040;
	color: #000000;
}


input.error
{
	background: #FBE3E4;
	border-top: 1px solid #e1b2b3;
	border-left: 1px solid #e1b2b3;
	border-right: 1px solid #FBC2C4;
	border-bottom: 1px solid #FBC2C4;
}

 input.success
{
	background: #E6EFC2;
	border-top: 1px solid #cebb98;
	border-left: 1px solid #cebb98;
	border-right: 1px solid #c6d880;
	border-bottom: 1px solid #c6d880;
}

 input.warning
{
	background: #fff3b3;
	border-top: 1px solid #cebb98;
	border-left: 1px solid #cebb98;
	border-right: 1px solid #c6d880;
	border-bottom: 1px solid #c6d880;
}

 span.error
{
	margin: 8px 0 0 0;
	padding: 0;
	height: 1%;
	
	color: #FF0000;
}

span.success
{
	margin: 8px 0 0 0;
	padding: 0;
	height: 1%;
	
	color: #7b912b;
}

label.error
{
	margin: 8px 0 0 0;
	padding: 0;
	height: 1%;
	display: block;
	color: #FF0000;
}





/* site information
----------------------------------------------- */

#site_info p{line-height:35px; margin-bottom:0px;}
#site_info a {
	color:#9ab6cc;
}
#site_info a:hover {
	color:#000;
}


/* AJAX sliding shelf
----------------------------------------------- */
#loading {float:right; margin-right:14px; margin-top:-2px;}
.block {padding-bottom:1px; /* background-color:red; margin-left:-10px; padding-left:10px;*/}


/* Accordian
----------------------------------------------- */
.toggler {
	color: #222;
	margin: 0;
	padding: 2px 5px;
	background: #eee;
	border-bottom: 1px solid #ddd;
	border-right: 1px solid #ddd;
	border-top: 1px solid #f5f5f5;
	border-left: 1px solid #f5f5f5;
	font-size:1.1em;
	font-weight: normal;
}
.element h4 {
	margin: 0;
	padding:4px;
	line-height:1.2em;
}
.element p {
	margin: 0;
	padding: 4px;
}
.float-right {
	padding:10px 20px;
	float:right;
}

#accordian-block {
	padding-bottom:10px;
}


/* Mootools Kwicks
----------------------------------------------- */
#kwick-box { 
	padding:0;
	overflow:hidden;
}
#kwick-box h2 { 
	margin:0;
}
#kwick {
	position: relative;
}
#kwick .kwicks {
	display: block;
	background: #999;
	height: 120px;
	list-style:none;
	margin:0;
	overflow:hidden;
}
#kwick li {
	float: left;
	margin:0;
	padding:0;
}
#kwick .kwick {
	display: block;
	cursor: pointer;
	overflow: hidden;
	height: 100px;
	width: 215px;
	padding: 10px;
	background: #fff;
}
#kwick .kwick span {
	color:#fff;
}
#kwick .one {
	background: #666;
}
#kwick .two {
	background: #777;
}
#kwick .three {
	background: #888;
}
#kwick .four {
	background: #999;
}


/* .stat-col{float:left; margin:0px; margin-right:30px;}
.stat-col span{font-weight:bold; font-size:1.1em; font-family:Helvetica Neue, Arial;}
.stat-col p{font-family:Helvetica Neue, Arial; font-size:3em; color:#fff; font-weight:bold; text-shadow: 1px 1px 0px rgba(27, 27, 27, 0.4);; filter: dropshadow(color=#1b1b1b, offx=1, offy=1) /* IE */
	  /* -moz-border-radius: 4px; /* Firefox */
	  /* -webkit-border-radius: 4px; Safari, Chrome */
	  /* border-radius: 4px; CSS3 */
	  /* line-height:1.1em;
	  padding:4px 12px; 
	  margin-bottom:10px;
	  margin-top:4px;
	  } */ *

.stat-col p.purple{
	
	
  background-color: #47196e;
  
  background: -webkit-linear-gradient(top, #a072c7, #47196e); 
  background:    -moz-linear-gradient(top, #a072c7, #47196e); 
  background:     -ms-linear-gradient(top, #a072c7, #47196e); 
  background:      -o-linear-gradient(top, #a072c7, #47196e); 
  background:         linear-gradient(top, #a072c7, #47196e);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#a072c7', EndColorStr='#47196e'); 


}

.stat-col p.yellow{
	background-color:#ffb400;
	
  /* background-image: -webkit-gradient(linear, left top, left bottom, from(#ffc22e), to(#d19400));  */
  background-image: -webkit-linear-gradient(top, #ffc22e, #d19400); 
  background-image:    -moz-linear-gradient(top, #ffc22e, #d19400); 
  background-image:     -ms-linear-gradient(top, #ffc22e, #d19400); 
  background-image:      -o-linear-gradient(top, #ffc22e, #d19400); 
  background-image:         linear-gradient(top, #ffc22e, #d19400);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ffc22e', EndColorStr='#d19400'); 

}
.stat-col p.darkblue{

	background-color: #163247;
  /* background-image: -webkit-gradient(linear, left top, left bottom, from(#5d798e), to(#163247));  */
  background-image: -webkit-linear-gradient(top, #5d798e, #163247); 
  background-image:    -moz-linear-gradient(top, #5d798e, #163247); 
  background-image:     -ms-linear-gradient(top, #5d798e, #163247); 
  background-image:      -o-linear-gradient(top, #5d798e, #163247); 
  background-image:         linear-gradient(top, #5d798e, #163247);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#5d798e', EndColorStr='#163247'); 

} 

.stat-col p.green{

  background-color: #5c8000;
  /* background-image: -webkit-gradient(linear, left top, left bottom, from(#a3c747), to(#5c8000));  */
  background-image: -webkit-linear-gradient(top, #a3c747, #5c8000);
  background-image:    -moz-linear-gradient(top, #a3c747, #5c8000); 
  background-image:     -ms-linear-gradient(top, #a3c747, #5c8000); 
  background-image:      -o-linear-gradient(top, #a3c747, #5c8000); 
  background-image:         linear-gradient(top, #a3c747, #5c8000);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#a3c747', EndColorStr='#5c8000'); 

}
.stat-col p.blue{

  background-color: #074676;
  /* background-image: -webkit-gradient(linear, left top, left bottom, from(#4d8cbc), to(#074676));  */
  background-image: -webkit-linear-gradient(top, #4d8cbc, #074676); 
  background-image:    -moz-linear-gradient(top, #4d8cbc, #074676); 
  background-image:     -ms-linear-gradient(top, #4d8cbc, #074676); 
  background-image:      -o-linear-gradient(top, #4d8cbc, #074676); 
  background-image:         linear-gradient(top, #4d8cbc, #074676);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#4d8cbc', EndColorStr='#074676'); 

}
.stat-col p.red{

 background-color: #a40312;
  /* background-image: -webkit-gradient(linear, left top, left bottom, from(#ea4958), to(#a40312));  */
  background-image: -webkit-linear-gradient(top, #ea4958, #a40312); 
  background-image:    -moz-linear-gradient(top, #ea4958, #a40312); 
  background-image:     -ms-linear-gradient(top, #ea4958, #a40312); 
  background-image:      -o-linear-gradient(top, #ea4958, #a40312); 
  background-image:         linear-gradient(top, #ea4958, #a40312);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#ea4958', EndColorStr='#a40312'); 

}

.stat-col.last{margin-right:0px;}



/* -----------------------------------------------------------
	images
----------------------------------------------------------- */

img.left
{
	margin: 10px 10px 10px 0;
	border: none;
	float: left;
}

img.right
{
	margin: 10px 0 10px 10px;
	border: none;
	float: right;
}

.fullpage{margin-left:0px;}


/* form */





/* PrettyPhoto styling */




.prettygallery{ margin-top:10px; }
.prettygallery li{display:inline; padding:0px 70px 40px 10px; margin:0px;  float:left; }
.prettygallery img {
	
	box-shadow:0px 0px 5px #ccc;
	-moz-box-shadow:0px 0px 5px #ccc;
	-webkit-box-shadow:0px 0px 5px #ccc;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	padding:5px;
	background:#fff;
	
}





/* Data Tables */


.dataTables_info,
.dataTables_paginate { margin-bottom: 3em; }

.dataTables_wrapper {
	position: relative;
	min-height: 302px;
	clear: both;
	_height: 302px;
	zoom: 1; /* Feeling sorry for IE */
}

.dataTables_processing {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 250px;
	height: 30px;
	margin-left: -125px;
	margin-top: -15px;
	padding: 14px 0 2px 0;
	border: 1px solid #ddd;
	text-align: center;
	color: #999;
	font-size: 14px;
	background-color: white;
}

.dataTables_length {
	width: 40%;
	float: left;
	margin-bottom: 1em;
}

.dataTables_filter {
	width: 50%;
	float: right;
	text-align: right;
	margin-bottom: 1em;
}

.dataTables_info {
	width: 60%;
	float: left;
	margin-top: 1em; 
}

.dataTables_paginate {

	float: right;
	text-align: right;
	margin-top: 1em; 
}

/* Pagination nested */
.paginate_disabled_previous, .paginate_enabled_previous, .paginate_disabled_next, .paginate_enabled_next {
	height: 19px;
	width: 19px;
	margin-left: 3px;
	float: left;
	cursor: pointer;
}

.paginate_disabled_previous {
	background-image: url(../img/table/back_disabled.png);
}

.paginate_enabled_previous {
	background-image: url(../img/table/back_enabled.png);
}

.paginate_disabled_next {
	background-image: url(../img/table/forward_disabled.png);
}

.paginate_enabled_next {
	background-image: url(../img/table/forward_enabled.png);
}



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * DataTables display
 */
table.display {
	margin: 0 auto;
	clear: both;
	width: 100%;
	
	/* Note Firefox 3.5 and before have a bug with border-collapse
	 * ( https://bugzilla.mozilla.org/show%5Fbug.cgi?id=155955 ) 
	 * border-spacing: 0; is one possible option. Conditional-css.com is
	 * useful for this kind of thing
	 *
	 * Further note IE 6/7 has problems when calculating widths with border width.
	 * It subtracts one px relative to the other browsers from the first column, and
	 * adds one to the end...
	 *
	 * If you want that effect I'd suggest setting a border-top/left on th/td's and 
	 * then filling in the gaps with other borders.
	 */
}





/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * DataTables sorting
 */


.sorting_asc {
	background: #8f8f8f url(../img/table/sort_asc.png) no-repeat center right; padding:8px 5px; text-align:left; color:#fff;
}

.sorting_desc {
	background: #8f8f8f url(../img/table/sort_desc.png) no-repeat center right; padding:8px 5px; text-align:left; color:#fff;
}

.sorting {
	background:#8f8f8f   url(../img/table/sort_both.png) no-repeat center right; padding:8px 5px; text-align:left; color:#fff;
}

.sorting_asc_disabled {
	background: #8f8f8f url(../img/table/sort_asc_disabled.png) no-repeat center right; padding:8px 5px; text-align:left; color:#fff;
}

.sorting_desc_disabled {
	background: #8f8f8f url(../img/table/sort_desc_disabled.png) no-repeat center right; padding:8px 5px; text-align:left; color:#fff;
}




tr.odd {
	  height: 30px;
line-height: 30px; border-bottom:1px solid #e6e6e6; 
}

tr.even {
	 height: 30px;
line-height: 30px; border-bottom:1px solid #e6e6e6;
}
tr.odd:hover, tr.even:hover { background:#f6f6f6; }
tr.odd td, tr.even td{ padding-left:5px; text-align: center;}



.clear {
	clear: both;
}

.dataTables_empty {
	text-align: center;
}

tfoot { display: none; }
tfoot input {
	margin: 0.5em 0;
	width: 100%;
	color: #444;
}

tfoot input.search_init {
	color: #999;
}

td.group {
	background-color: #d1cfd0;
	border-bottom: 2px solid #A19B9E;
	border-top: 2px solid #A19B9E; 
}

td.details {
	background-color: #d1cfd0;
	border: 2px solid #A19B9E;
}


.example_alt_pagination div.dataTables_info {
	width: 40%;
}

.paging_full_numbers {
	width: 400px;
	height: 22px;
	line-height: 22px;
}

.paging_full_numbers span.paginate_button,
 	.paging_full_numbers span.paginate_active {
	border: 1px solid #aaa;
	/* -webkit-border-radius: 5px;
	-moz-border-radius: 5px; */
	padding: 2px 5px;
	margin: 0 3px;
	cursor: pointer;
	cursor: hand;
}

.paging_full_numbers span.paginate_button {
	background-color: #ddd;
}

.paging_full_numbers span.paginate_button:hover {
	background-color: #ccc;
}

.paging_full_numbers span.paginate_active {
	background-color: #99B3FF;
}


/* Buttons */

.btn,
.btn-icon,
.btn-mini
{
	background-repeat: repeat-x;
	color: #FFF;	
	font-weight: bold;
	display: inline-block;	
	text-decoration: none;
	border-width: 1px;
	border-style: solid;
	padding: 0 15px 4px;
	padding: 0 7px 4px;
	margin: 0;
	text-shadow: 1px 1px 1px rgba(0,0,0,.2);
	/* -moz-box-shadow: 1px 1px 1px rgba(0,0,0,.25);
	-webkit-box-shadow: 1px 1px 1px rgba(0,0,0,.25);
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px; */
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#999999,direction=135,strength=2);
	cursor: pointer;
	position: relative;
}
	
	/* Active/Click state */
	.btn:active, .btn-icon:active, .btn-mini:active { top: 1px; }


/* Sizes */
.btn, .btn-icon { background-position: 0 -80px; font-size: 12px; height: 32px; line-height: 29px; }
.btn.btn-small, .btn-icon.btn-small { background-position: 0 0; font-size: 10px; height: 26px; line-height: 23px; }
.btn.btn-large, .btn-icon.btn-large { background-position: 0 -160px; font-size: 15px; height: 42px; line-height: 40px; }

	/* Sizes - Line height for A buttons need to be different */
	a.btn, a.btn-icon { height: 32px; line-height: 32px; padding-bottom: 0; }
	a.btn.btn-small, a.btn-icon.btn-small { line-height: 26px; padding-bottom: 0; }
	a.btn.btn-large, a.btn-icon.btn-large { line-height: 42px; padding-bottom: 0; }
	

/* Fix the button in IE7 :-( */
*+html .btn, *+html .btn-icon { border-color: none ; border: 1px solid transparent; }



/* Set default button colors */
.btn, .btn-icon, .btn-mini,
.btn:visited, .btn-icon:visited, .btn-mini:visited {  background-image: url(../img/bg-lite.png); background-color: #F90; border-color: #D58000; color: #FFF; }

.btn:hover, .btn-icon:hover, .btn-mini:hover { background-color: #D58000; color: #FFF; }


/* Colors */	
.btn-pink,
.btn-pink:visited { background-color: #FF0066; border-color: #DA0C59; }
.btn-pink:hover { background-color: #DA0C59; }

.btn-blue,
.btn-blue:visited { background-color: #066ECD; border-color: #0561B4; }
.btn-blue:hover { background-color: #0561B4; }

.btn-red,
.btn-red:visited { background-color: #E40001; border-color: #CC0000; }
.btn-red:hover { background-color: #CC0000; }

.btn-green,
.btn-green:visited { background-color: #77B32F; border-color: #689C29; }
.btn-green:hover { background-color: #689C29; }

.btn-black,
.btn-black:visited { background-color: #111; border-color: #000; }
.btn-black:hover { background-color: #000; }

.btn-purple,
.btn-purple:visited { background-color: #7B0F75; border-color: #6A0D66; }
.btn-purple:hover { background-color: #6A0D66; }

.btn-navy,
.btn-navy:visited { background-color: #002142; border-color: #00172F; }
.btn-navy:hover { background-color: #00172F; }

.btn-maroon,
.btn-maroon:visited { background-color: #750000; border-color: #530000; }
.btn-maroon:hover { background-color: #530000; }

.btn-yellow,
.btn-yellow:visited { background-color: #FFCC00; border-color: #D9AD01; }
.btn-yellow:hover { background-color: #D9AD01; }

.btn-teal,
.btn-teal:visited { background-color: #39A7B6; border-color: #2E8794; }
.btn-teal:hover { background-color: #2E8794; }

.btn-orange,
.btn-orange:visited { background-color: #F90; border-color: #D58000; color: #FFF; }
.btn-orange:hover{ background-color: #D58000; color: #FFF; }

.btn-grey,
.btn-grey:visited  { background-color: #999; border-color: #888; color: #FFF; }
.btn-grey:hover{ background-color: #888; color: #FFF; }


/* Images Overlays - Gradient Effect */
/* 50% Opacity for darker colors */
.btn-blue,
.btn-black,
.btn-purple,
.btn-navy,
.btn-maroon,
.btn-teal,
.btn-grey { background-image: url(../img/bg-dark.png) !important; }


/* 65% opacity for lighter colors */
.btn-red,
.btn-orange,
.btn-green,
.btn-yellow,
.btn-pink { background-image: url(../img/bg-lite.png) !important; }



/* Icon Button Styles */
.btn-icon { padding-left: 32px !important; }
*+html .btn-icon { padding-left: 20px !important; padding-right: 5px !important; }

.btn-icon span
{
	background-image: url(../img/btn-icons.png); 
	background-repeat: no-repeat; 
	background-position: 0 0; 
	width: 16px; 
	height: 16px; 
	position: absolute; 
	left: 6px; 
	top: 6px;
}

	.btn-icon.btn-small span { top: 4px; }
	.btn-icon.btn-large span { top: 12px; }
	@-moz-document url-prefix() { .btn-icon span { left: -24px; top: 0px; } .btn-icon.btn-small span { top: -1px; } .btn-icon.btn-large span { top: 4px; } } 


/* Mini Buttons */
.btn-mini 
{ 
	background-position: 0 0; 
	width: 32px; 
	height: 26px !important; 
	line-height: 500px !important; 
	overflow: hidden;
	padding: 0; 
}

	.btn-mini span 
	{ 
		background-image: url(../img/btn-icons.png); 
		background-repeat: no-repeat; 
		display: block;
		width: 16px; 
		height: 16px;
		line-height: 0;
		position: absolute;
		left: 50%;
		top: 50%;
		margin-left: -8px;
		margin-top: -8px;
	}
	
	
/* Icon Classes */
.btn-arrow-down span { background-position: -48px 0; }
.btn-arrow-up span { background-position: -32px 0; }
.btn-arrow-right span { background-position: -16px 0; }
.btn-arrow-left span { background-position: 0 0; }
.btn-comment span { background-position: -112px 0; }
.btn-heart span { background-position: -96px 0; }
.btn-star span { background-position: -80px 0; }
.btn-cart span { background-position: -64px 0; }
.btn-print span { background-position: -128px 0; }
.btn-rss span { background-position: -144px 0; }
.btn-person span { background-position: 0 -16px; }
.btn-check span { background-position: -16px -16px; }
.btn-dollar span { background-position: -32px -16px; }
.btn-refresh span { background-position: -48px -16px; }
.btn-home span { background-position: -64px -16px; }
.btn-plus span { background-position: -80px -16px; }
.btn-minus span { background-position: -96px -16px; }
.btn-cross span { background-position: -112px -16px; }
	
	
/* Transparent Button Styles */
.btn-transparent, .btn-transparent:hover { background-image: url(../img/bg-lite.png); background-color: transparent; filter: none; border-color: transparent\0;
 border-color: rgba(0,0,0,.4) !important; margin: 0 1em 0 0; }
*+html .btn-transparent { border: none; }


/*  Notifications */

.message {
    padding: 10px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -khtml-border-radius: 5px;
    border-radius: 5px;
    margin-bottom: 10px;
    -moz-box-shadow:inset 0 1px 0 rgba(255,255,255,0.5);
    -webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,0.5);
    box-shadow:inset 0 1px 0 rgba(255,255,255,0.5);
}
    .message h3 {
        margin-top: 0;
    }
    .message p {
        margin-bottom: 0;
    }

.message.info {
    border: 1px solid #cadcea;
    background: #e1f2fc;
    /* background: -webkit-gradient(linear, left top, left bottom, from(#e1f2fc), to(#cae9fd)); */
    background: -moz-linear-gradient(top,  #e1f2fc,  #cae9fd);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#e1f2fc', endColorstr='#cae9fd');
    color: #225b86;
    text-shadow: 0 1px 0 #fff;
}

.message.error {
    border: 1px solid #eeb7ba;
    background: #fae2e2;
    /* background: -webkit-gradient(linear, left top, left bottom, from(#fae2e2), to(#f2cacb)); */
    background: -moz-linear-gradient(top,  #fae2e2,  #f2cacb);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#fae2e2', endColorstr='#f2cacb');
    color: #be4741;
    text-shadow: 0 1px 0 #fff;
}

.message.success {
    border: 1px solid #b8c97b;
    background: #e5edc4;
    /* background: -webkit-gradient(linear, left top, left bottom, from(#e5edc4), to(#d9e4ac)); */
    background: -moz-linear-gradient(top,  #e5edc4,  #d9e4ac);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5edc4', endColorstr='#d9e4ac');
    color: #3f7227;
    text-shadow: 0 1px 0 #fff;
}

.message.warning {
    border: 1px solid #e5dbaa;
    background: #ffffc0;
    /* background: -webkit-gradient(linear, left top, left bottom, from(#ffffc0), to(#f9ee9c)); */
    background: -moz-linear-gradient(top,  #ffffc0,  #f9ee9c);
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffc0', endColorstr='#f9ee9c');
    color: #6d7829;
    text-shadow: 0 1px 0 #fff;
}

.gallery-sand .sorting{background-color:white !important;}
table.form select{width:200px;}

.success{
	font-size: 18px;
	color: green;
}
.error{
	font-size: 18px;
	color: red;
}
#site_info {
	color:#fff;
	background:#0a7620;
	border-top:1px solid #0a7620;
	padding-left:20px;
}</style>
<style>

ul.nav,
ul.nav * { margin:0;padding:0;}
/* ul.nav {
  background: rgba(0, 0, 0, 0) url("../img/nav-repeat2.jpg") repeat-x scroll 0 8px !important;
  height: 58px;
  max-width: 100%;
  position: relative;
} */
ul.nav li {
	cursor:pointer;
	float:left;
	text-align:center;
	list-style-type:none;
	font-weight:normal;
	vertical-align:middle;
}
ul.nav li ul {
	cursor:default;
	width:100%;
	max-width:100%;
	position:absolute;
	height:auto;
	top:3.4em;
	background-position:0 0 !important;
	left:-9000px;
}
ul.nav li ul li {
	padding:0;
	border:none;
	width:auto;
	max-width:none;
}
ul.nav li a {
	color:#fff;
	font-weight:bold;
	text-decoration:none;
	display:block;
	float:left;
	padding:0 1em;
	height:3.7em;
	line-height:3.7em;
	
}
ul.nav li ul li a {
	position:relative !important; /* ie Mac */
	cursor:pointer !important;
	white-space:nowrap;
	line-height:2.5em;
	height:2.5em;
	font-weight:normal;
	color:#666;
	background-position:0 50% !important;
}

ul.nav li:hover a,
ul.nav li a:hover,
ul.nav li a:focus {color:#000; background:#103D5F;}
ul.nav li a:active {color:#666; background:#fff;}
ul.nav li:hover ul {left:0;z-index:10}

ul.nav li:hover ul li a {color:#444;}
ul.nav li:hover ul li a:hover {color:#000; background:#fff;}
ul.nav li:hover ul li a:active {color:#666; background:#fff;}

ul.nav li.current a {color:#666; background:#fff; cursor:default; font-weight:bold;}
ul.nav li.current ul {left:0;z-index:5}
ul.nav li.current ul,
ul.nav li.current {background:#103D5F !important}
ul.nav li.current ul li a {color:#444; background:#103D5F; font-weight:normal;}
ul.nav li.current ul li a:hover {color:#000; background:#fff;}
ul.nav li ul li.current a,
ul.nav li ul li.current a:hover,
ul.nav li.current:hover ul li a:active {color:#666; background:#fff;}


/* navigation (vertical subnavigation)
----------------------------------------------- */
ul.main li {
  position:relative;
  top:0;
  left:0;
}
ul.main li ul {
  border-top:0;
}
ul.main li ul li {
  float:left;
}
ul.main li a {
	height:3.7em;
	line-height:3.7em;
	border:0;
	color:#fff;

}
ul.main li ul li a {
  width:12em;
  line-height:3em;
  height:3em;
  text-align:left;
  color:#fff;
  border-top:1px solid #1A3A52;
  background:#103D5F;
}
ul.main li a:focus {color:#fff; background:#103D5F;}
ul.main li ul li a:hover {
  color:#fff;
  background:#103D5F;
}
ul.main li:hover a {
  color:#fff;
  background:#103D5F;
}
ul.main li:hover ul li a {color:#fff;}
ul.main li:hover ul li a:hover {color:#fff; background:#2D536F;}
ul.main li:hover a:active {background:#103D5F;}
ul.main li:hover ul li a:active {color:#fff; background:#103D5F;}


/* secondary list
----------------------------------------------- */
ul.nav li.secondary {
	float:right;
	color:#cde;
	background:transparent !important;
}
ul.nav li.secondary span.status {
	float:left;
	padding:0 1em;
	line-height:2.77em;
	height:2.77em;
  font-size:0.9em;
}
ul.nav li.secondary span.status a {
	float:none;
	display:inline;
	padding:0;
	height:auto;
	line-height:auto;
	color:#cde;
	background:transparent;
}
ul.nav li.secondary span.status a:hover {
	color:#fff;
	background:transparent;
}
ul.nav li.secondary span.status span {
	text-transform:capitalize;
}
ul.nav li.secondary:hover a {
	color:#fff;
	background:#009966;
}
ul.nav li.secondary:hover a:hover {
	background:#009966;
}
ul.nav li.secondary:hover a:active {background:#009966;}

/* ul.nav li.ic-dashboard a span, .ic-dashboard{background:url(../img/icon-dashboard.png) no-repeat center left;}
ul.nav li.ic-typography a span, .ic-typography{background:url(../img/icon-typography.png) no-repeat center left;}
ul.nav li.ic-charts a span, .ic-charts{background:url(../img/icon-charts-graphs.png) no-repeat center left;}
ul.nav li.ic-form-style a span, .ic-form-style{background:url(../img/icon-form-style.png) no-repeat center left;}
ul.nav li.ic-grid-tables a span, .ic-grid-tables{background:url(../img/icon-grid-tables.png) no-repeat center left;}
ul.nav li.ic-gallery a span, .ic-gallery{background:url(../img/icon-gallery.png) no-repeat center left;}
ul.nav li.ic-notifications a span, .ic-notifications{background:url(../img/icon-notifications.png) no-repeat center left;} */
ul.nav li {
  background-image: none !important;
  overflow: hidden;
}

ul.nav li a span {
padding: 0px 0px 0px 30px;
display: block;
background-repeat: no-repeat;
white-space: nowrap;
}

li.dd span:after{content: '';}
</style>