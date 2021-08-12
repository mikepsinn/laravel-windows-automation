<!-- Command Id Field -->
<div class="col-sm-12">
    {!! Form::label('command_id', 'Command Id:') !!}
    <p>{{ $execution->command_id }}</p>
</div>

<!-- Command Field -->
<div class="col-sm-12">
    {!! Form::label('command', 'Command:') !!}
    <p>{{ $execution->command }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $execution->user_id }}</p>
</div>

<!-- Success Field -->
<div class="col-sm-12">
    {!! Form::label('success', 'Success:') !!}
    <p>{{ $execution->success }}</p>
</div>

<!-- Output Field -->
<div class="col-sm-12">
    {!! Form::label('output', 'Output:') !!}
    <p>{{ $execution->output }}</p>
</div>

