<table>
    <h4> Payments </h4>
    <thead>
        <tr>
            <th width="50"> ID</th>
            <th width="100"> Name </th>
            <th width="300"> Address </th>
            <th width="150"> Sign Up</th>
            <th width="100"></th>
            <th width="100"></th>

        </tr>
    </thead>
    <tbody>
        @foreach( $users as $user)
            <tr>
                <td> {!! $user->id !!} </td>
                <td> {!! $user->name !!} </td>
                <td> {!! $user->address !!} </td>
                <td> {!! $user->created_at->toFormattedDateString() !!} </td>
                <td> <a href="/staff/users/{!! $user->id !!}/edit" class="tiny expanded button"> Edit </a> </td>
                <td> 
                {!! Form::open(['method' => 'DELETE', 'route' => ['staff.users.destroy', $user->id]]) !!}
                {{ csrf_field() }}
                <button class="alert button expanded tiny"> DELETE </a> 
                {!! Form::close() !!}
                </td>

            @endforeach
    </tbody>
