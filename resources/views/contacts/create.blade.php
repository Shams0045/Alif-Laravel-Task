@extends('contacts.layout')
  
@section('content')

<style>
.container1 input[type=text] {
padding:5px 0px;
margin:5px 5px 5px 0px;
}


.add_form_field
{
    background-color: #1c97f3;
    border: none;
    color: white;
    padding: 8px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	border:1px solid #186dad;

}

.add_form_field2
{
    background-color: #1c97f3;
    border: none;
    color: white;
    padding: 8px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	border:1px solid #186dad;

}

input{
    border: 1px solid #1c97f3;
    width: 260px;
    height: 40px;
	margin-bottom:14px;
}

.delete{
    background-color: #fd1200;
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;

}
</style>

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Создать новый контакт</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Назад</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Warning!</strong> Please check your inputs<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('contacts.store') }}" method="POST">
    @csrf
    <table class="table table-bordered">
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Имя:</strong>
                <input type="text" name="name" class="col-4 form-control" placeholder="Имя">
            </div>
            <div class="form-group">
                <strong>Телефон:</strong>
                <div class="container1 d-inline">
                    <button class="add_form_field">Добавить поле &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
                    <div><input type="text" name="number[]" class="col-4 form-control" placeholder="Телефон"></div>
                </div>            
            </div>
            <div class="form-group">
                <strong>Email:</strong>
                <div class="container2 d-inline">
                    <button class="add_form_field2">Добавить поле &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
                    <div><input type="text" name="email[]" class="col-4 form-control" placeholder="Email"></div>
                </div>  
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Создать</button>
        </div>
    </div>
   </table>
</form>

    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields      = 10;
            var wrapper         = $(".container1");  
            var add_button      = $(".add_form_field"); 

            var x = 1; 
                $(add_button).click(function(e){ 
                    e.preventDefault();
                        if(x < max_fields){ 
                            x++; 
                        $(wrapper).append('<div><input type="text" name="number[]" placeholder="Телефон" /><a href="#" class="delete">Удалить</a></div>');  
                }else {
                alert('You Reached the limits')
                }
                });

            $(wrapper).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });

        $(document).ready(function() {
            var max_fields      = 10;
            var wrapper         = $(".container2");  
            var add_button      = $(".add_form_field2"); 

            var x = 1; 
                $(add_button).click(function(e){ 
                    e.preventDefault();
                        if(x < max_fields){ 
                            x++;  
                        $(wrapper).append('<div><input type="text" name="email[]" placeholder="Email" /><a href="#" class="delete">Удалить</a></div>');   
                }else {
                alert('You Reached the limits')
                }
                });

            $(wrapper).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>

@endsection