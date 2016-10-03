
<div id="navigation" class="top-bar" >

 <div class="top-bar-left">

    <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
        <button class="menu-icon dark" type="button" data-toggle></button>
    </span>

    <ul class="menu">

        <li class="menu-text"> Zaycho </li>
        <li class="menuitem"><a href="#"> Hello </a></li>
    </ul>

</div>


<div class="top-bar-right">
        <div id="responsive-menu">
            <div class="top-bar-left">
                @if(Auth::user())
                <ul class="dropdown menu" data-dropdown-menu>
                    <li>
                        <a href="#">{!! Auth::user()->name !!}</a>
                        <ul class="menu vertical">
                            <li><a href="#">One</a></li>
                            <li><a href="#">Orders</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>
                    </ul>
                @else
                    <ul class="menu">
                        <li class="menuitem"> <a href="#" class="button"> Login </a></li>
                    </ul>
                @endif

                </div>
        </div>
    </div>

</div>
