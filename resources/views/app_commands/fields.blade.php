<!-- Command Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('command', 'Command:') !!}
    {!! Form::textarea('command', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Times Used Field -->
<div class="form-group col-sm-6">
    {!! Form::label('times_used', 'Times Used:') !!}
    {!! Form::number('times_used', null, ['class' => 'form-control']) !!}
</div>