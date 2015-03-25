##<%inherit file="sv:templates/bootstrap_base.mako"/>
<%inherit file="../bootstrap_base.mako"/>
<%namespace name="player" file="../players/sm2.mako"/>

<%block name="title">Голос санскрита</%block>

<%block name="head">
    <link href="${request.static_path('sv:static/css/blog.css')}" rel="stylesheet">
    ${player.head()}
</%block>

<%block name="body_start">${player.body_start()}</%block>
<%block name="body_end">${player.body_end()}</%block>

##<%block name="body">
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item${' active' if request.path == '/' else ''}" href="/">Все</a>

          % for c in categories:
            <%
              path = request.route_path('category', category=c[0])
              active = (path == request.path)
            %>
            <a class="blog-nav-item${' active' if active else ''}" href="${path}">${c[1]}</a>
          % endfor

          <a class="blog-nav-item" href="/about">О сайте</a>
        </nav>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <div class="blog-header">
            <h1 class="blog-title">Голос санскрита</h1>
            ##<p class="lead blog-description">Баджаны, которые <a href="http://artofliving.org">мы</a> поем</p>
            <p class="lead blog-description">Баджаны, которые мы поем</p>
          </div>

          ${next.body()}
        </div><!-- /.blog-main -->

        <%doc>
          <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
              <h4>About</h4>
              <p>Баджаны, исполняемые на сатсангах "Искусства Жизни"</p>
            </div>
            <div class="sidebar-module">
              <h4>Тэги</h4>
              <ol class="list-unstyled">
                <li><a href="#">March 2014</a></li>
                <li><a href="#">February 2014</a></li>
                <li><a href="#">January 2014</a></li>
                <li><a href="#">December 2013</a></li>
                <li><a href="#">November 2013</a></li>
                <li><a href="#">October 2013</a></li>
                <li><a href="#">September 2013</a></li>
                <li><a href="#">August 2013</a></li>
                <li><a href="#">July 2013</a></li>
                <li><a href="#">June 2013</a></li>
                <li><a href="#">May 2013</a></li>
                <li><a href="#">April 2013</a></li>
              </ol>
            </div>
          </div><!-- /.blog-sidebar -->
        </%doc>
      </div><!-- /.row -->
    </div><!-- /.container -->

    <footer class="blog-footer">
      <p><a href="https://github.com/kuzmich/sanskritvoice">Исходный код</p>
    </footer>
##</%block>
