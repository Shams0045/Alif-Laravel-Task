@extends('contacts.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Изменить контакт</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('contacts.index') }}">Назад</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check inputs<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('contacts.update',$contact->id) }}" method="POST">
        @csrf
        @method('PUT')
   
   <input type="hidden" name="id" value="{{ $contact->id }}">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="name" value="{{ $contact->name }}" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <strong>Телефон:</strong>
                    @foreach($contact->number as $number)
                    <input type="text" name="number[]" value="{{ $number }}" class="form-control" placeholder="Number">
                    @endforeach
                </div>
                <div class="form-group">
                    <strong>Email:</strong>
                    @foreach($contact->email as $email)
                    <input type="text" name="email[]" value="{{ $email }}" class="form-control" placeholder="Email">
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
   
    </form>
@endsection