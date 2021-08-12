<div class="table-responsive">
    <table class="table" id="appCommands-table">
        <thead>
        <tr>
            <th>Command</th>
        <th>Name</th>
        <th>Times Used</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appCommands as $appCommand)
            <tr>
                <td>{{ $appCommand->command }}</td>
            <td>{{ $appCommand->name }}</td>
            <td>{{ $appCommand->times_used }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['appCommands.destroy', $appCommand->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('appCommands.show', [$appCommand->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('appCommands.edit', [$appCommand->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
