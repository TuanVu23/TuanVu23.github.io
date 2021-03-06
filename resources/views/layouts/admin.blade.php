<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin - Movies Pro</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('admin_asset/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('admin_asset/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('admin_asset/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{url('admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{url('admin_asset/bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('admin')}}">Admin Area - Movies Pro</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{route('admin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>                      
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('user_list')}}">List User</a>
                                </li>
                                <li>
                                    <a href="{{route('user_add')}}">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{route('review_list')}}"><i class="fa fa-comments-o fa-fw"></i> Review</a>
                        </li>
                        <li>
                            <a href="{{route('slide_edit')}}"><i class="fa fa-picture-o fa-fw"></i> Slide</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-film fa-fw"></i> Movie<span class="fa arrow"></span></a>
                            <!-- <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List Product</a>
                                </li>
                                <li>
                                    <a href="#">Add Product</a>
                                </li>
                            </ul> -->
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')                   
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{url('admin_asset/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('admin_asset/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('admin_asset/dist/js/sb-admin-2.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{url('admin_asset/bower_components/DataTables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js')}}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });             
        $(document).ready(function(){
            $('#closealert').click(function(){
                $.ajax({
                    url: '{{url(Request::path())}}',
                    success: function(){
                        $('#showalert').remove();
                    }
                });
                return false;
            });
        });
        $(document).ready(function() {   
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.slideshow1').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }               
            $(".file-upload-slide1").on('change', function(){
                readURL(this);
            });
        });
        $(document).ready(function() {   
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.slideshow2').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }               
            $(".file-upload-slide2").on('change', function(){
                readURL(this);
            });
        });
        $(document).ready(function() {   
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.slideshow3').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }               
            $(".file-upload-slide3").on('change', function(){
                readURL(this);
            });
        });
        $(document).ready(function() {   
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.slideshow4').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(input.files[0]);
                }
            }               
            $(".file-upload-slide4").on('change', function(){
                readURL(this);
            });
        });
    </script>
</body>

</html>
