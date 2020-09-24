@extends('layouts.masterpage')

@section('contenido')
    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('media-types/store')}}">
        @csrf
        <fieldset>
        
        <!-- Form Name -->
        <legend>Update media types whit CSV file</legend>
        <!-- File Button --> 
        <div class="form-group">
          <label class="col-md-4 control-label" for="mediaTypes">Carga masiba</label>
          <div class="col-md-4">
            <input id="mediaTypes" name="mediaTypes" class="input-file" type="file">
          </div>
        </div>
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for=""></label>
          <div class="col-md-4">
            <button type="submit" id="" name="" class="btn btn-primary">Enviar</button>
          </div>
        </div>
        </fieldset>
        </form>
        @if(session("exito"))

        <div class="alert-success"> {{session("exito")}} </div>
    
        @endif
        <br>
        @if(session('repetidos'))
          <p>Repetidos:</p>
          @foreach (session("repetidos") as $mediaRepetidos)
            <p class="alert-warning"> {{ $mediaRepetidos }} </p>
          @endforeach
        @endif
        
@endsection