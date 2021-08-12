<!-- Command Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('command_id', 'Command Id:') !!}
    {!! Form::number('command_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Command Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('command', 'Command:') !!}
    {!! Form::textarea('command', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Success Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('success', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('success', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('success', 'Success', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Output Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('output', 'Output:') !!}
    {!! Form::textarea('output', null, ['class' => 'form-control']) !!}
</div>