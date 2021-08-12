<!-- Command Field -->
<div class="col-sm-12">
    {!! Form::label('command', 'Command:') !!}
    <p>{{ $appCommand->command }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $appCommand->name }}</p>
</div>

<!-- Times Used Field -->
<div class="col-sm-12">
    {!! Form::label('times_used', 'Times Used:') !!}
    <p>{{ $appCommand->times_used }}</p>
</div>

