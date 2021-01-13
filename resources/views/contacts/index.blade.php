@extends('contacts.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Контакты</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('contacts.create') }}">СОЗДАТЬ</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif 

    <div>
        <div class="col-md-4 float-right"> 
            <form action="{{ route('contacts.index') }}" method="GET" role="search"> 
                <div class="input-group">
                    <input type="text" class="form-control mr-2" name="term" placeholder="Поиск по имени" id="term"> 
                        <span class="input-group-btn mr-5">
                            <button class="btn btn-info" type="submit" title="Поиск по имени">
                                <span class="fa fa-search"></span>
                            </button>
                        </span> 
                        <a href="{{ route('contacts.index') }}" class="">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fa fa-refresh"></span>
                                </button>
                            </span>
                        </a> 
                </div>
            </form> 
        </div>
    </div>
 
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email адрес</th>
            <th width="250px">Действия</th>
        </tr>
        @foreach ($contacts as $contact)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $contact->name }}</td>
            @foreach ($contact->number as $number)
            <td class="d-flex">{{ $number }}</td> 
            @endforeach 
            @foreach ($contact->email as $email) 
            <td>{{ $email }} </td> 
            @endforeach  
            <td>
                <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('contacts.show',$contact->id) }}">Показать</a>
    
                    <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Изменить</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $contacts->links("pagination::bootstrap-4") !!} 

@endsection