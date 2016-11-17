
<div id="navigation" class="top-bar" >

 <div class="top-bar-left">

    <span data-responsive-toggle="responsive-menu" data-hide-for="medium">
        <button class="menu-icon dark" type="button" data-toggle></button>
    </span>

    <ul class="menu">
        <li class="menu-text"> <a href="/products/"> ZAYCHO </a></li>
    </ul>

</div>


<div class="top-bar-right">
        <div id="responsive-menu">
            <div class="top-bar-left">
              @if(Auth::check()) 

                  <ul class="dropdown menu" data-dropdown-menu>

                      <li class="menuitem"> 
                          <a href="{!! url('user/orders') !!}" > Dashboard
                              @if( $notifications >= 1)
                                  <span class="alert badge notification"> {{ $notifications }}</span>
                              @endif
                          </a> 
                      </li>


                    <li>
                        <a href="#">{!! Auth::user()->name !!} </a>

                        <ul class="menu">
                           <li><a href="{!! url('logout') !!}">Logout</a></li>
                        </ul>
                    </li>

                    </ul>
                @else
                    <ul class="menu">
                        <li class="menuitem"> <a href="{!! url('register') !!}" > Sign up</a></li>
                        <li class="menuitem"> <a href="{!! url('login') !!}" class="button"> Login </a></li>
                    </ul>
                @endif
                  </ul>



                </div>
        </div>
    </div>

</div>
