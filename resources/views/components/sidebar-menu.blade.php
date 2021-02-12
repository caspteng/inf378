<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
    <a class="active item">Home</a>
    <a class="item">Work</a>
    <a class="item">Company</a>
    <a class="item">Careers</a>
    @guest
    <a href="{{ route('login') }}" class="item">Login</a>
    <a href="{{ route('register') }}" class="item">Signup</a>
    @endguest
</div>
