<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
    <li>
        <form action="{{ route('login') }}" method="GET">
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </li>
</ul>

</nav>
