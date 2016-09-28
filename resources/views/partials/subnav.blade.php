<div class="sub-nav large-2 columns">
    <ul class="menu vertical">
        <p> Department </p>
        @foreach($categories as $category)
            <li> <a href="{!! url('category', $name = $category->name ) !!}"> {!! $name !!} </a> </li>
        @endforeach
        
    </ul>

</div>

