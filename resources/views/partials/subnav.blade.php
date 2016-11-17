<div class="sub-nav large-2 columns">
    <ul class="menu vertical">
        <p> Department </p>
        <li> <a href="/products/"> All </a> </li>
        @foreach($categories as $category)
            <li> <a href="{!! url('category', $name = $category->name ) !!}"> {!! $name !!} </a> </li>
        @endforeach

        <li>
        <hr/>
        <form method="get" action="/products/s">
            <input type="text" name="search">
        </li>
        <li>
            <br/>
            <input type="submit" class="button" value="Search">
        </li>

        </form>
    </ul>
    <hr/>

</div>

