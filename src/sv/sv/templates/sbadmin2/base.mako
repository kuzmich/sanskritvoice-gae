<%inherit file="../bootstrap_base.mako"/>

<%block name="title">Voice Admin</%block>

<%block name="head">
  <link href="${request.static_path('sv:static/css/sb-admin-2.css')}" rel="stylesheet">
</%block>

##<%block name="body">
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
                <a class="navbar-brand" href="${request.route_path('admin.index')}"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span> Voice Admin</a>
            </div> <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-user fa-fw"></i>admin <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url_for('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul> <!-- /.dropdown-user -->
                </li> <!-- /.dropdown -->
            </ul> <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                          <a href="${request.route_path('admin.bhajans')}"><i class="fa fa-book fa-fw"></i> Баджаны</a>
                        </li>
                        <li>
                          <a href="${request.route_path('admin.records')}"><i class="fa fa-music fa-fw"></i> Записи</a>
                        </li>
                    </ul>
                </div> <!-- /.sidebar-collapse -->
            </div> <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <h1 class="page-header"><%block name="page_header"/></h1>
                      ${next.body()}
                    </div> <!-- /.col-lg-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container-fluid -->
        </div> <!-- /#page-wrapper -->

    </div> <!-- /#wrapper -->
##</%block>
