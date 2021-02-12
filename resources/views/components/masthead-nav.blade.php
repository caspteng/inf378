<!-- Following Menu -->
<div class="ui large top fixed hidden menu">
    <div class="ui container">
        <a class="active item">Home</a>
        <a class="item">Work</a>
        <a class="item">Company</a>
        <a class="item">Careers</a>
        @guest
        <div class="right menu">
            <div class="item">
                <a href="{{ route('login') }}" class="ui button">Log in</a>
            </div>
            <div class="item">
                <a href="{{ route('register') }}" class="ui primary button">Sign Up</a>
            </div>
        </div>
        @endguest
    </div>
</div>
