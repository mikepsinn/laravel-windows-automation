<div class="table-responsive">
    <table class="table" id="commands-table">
        <thead>
        <tr>
            <th>Command</th>
        <th>Name</th>
        <th>Times Used</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commands as $command)
            <tr>
                <td>{{ $command->command }}</td>
            <td>{{ $command->name }}</td>
            <td>{{ $command->times_used }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['commands.destroy', $command->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('commands.show', [$command->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('commands.edit', [$command->id]) }}"
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
