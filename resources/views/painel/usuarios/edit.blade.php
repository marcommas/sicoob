@extends('painel.templates.index')

@section('content')

<div class="col-md-12">
     <div>
        <a href="{{url('/painel')}}"></i> Home</a> >
        <a href="{{url('/painel/usuarios')}}"> Usuários</a> 
        > <span style="font-weight: bold; color:#4C7C83;">Alteração de Usuários</span>
    </div>
    
    <div class="modal-header bg-padrao4">
        <h4 class="modal-title" id="myModalLabel">Gestão de Usuários</h4>
    </div>

    <form class="form-padrao form-dados" method="POST" action="/painel/usuarios/editar/{{$user->id}}" send="/painel/usuarios/editar/{{$user->id}}" > 

        <div class="modal-body">

            @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable fade in" role="alert" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @if (session()->has('sucesso'))
            <div class="alert alert-success alert-dismissable fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <p>{{  session('sucesso') }}</p>

            </div>
            @endif

            {!! csrf_field() !!}


            <div class="form-group">
                <input type="text" name="name" value="{{ old('name', isset($user->name) ? $user->name : null)   }}" class="form-control" placeholder="Nome *">
            </div>
            <div class="form-group">
                <input type="email" name="email" value="{{ old('email', isset($user->email) ? $user->email : null) }}" class="form-control" placeholder="Email *">
            </div>
            <div class="form-group">
                <input type="password" name="old_password" class="form-control" placeholder="Senha Antiga *">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Nova Senha *">
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a Senha *">
            </div>
            <div class="form-group">
                <input type="text" name="cidade" value="{{ old('cidade', isset($user->cidade) ? $user->cidade : null) }}" placeholder="Cidade">

                <input type="text" name="estado" value="{{ old('estado', isset($user->estado) ? $user->estado : null) }}" placeholder="Estado">
            </div>
            <div class="form-group">
                <label >{!! Form::checkbox('ativo', '1', Input::old('ativo', $user->ativo), ['class' => 'form-control'] ) !!}Ativo</label>
            </div>
            
            <div class="form-group">
            <h4>Tipo *:</h4>
            
                {!! Form::select('tipo', ['1' => 'Administrador', '2' => 'Comum'], Input::old('tipo', $user->tipo), ['class' => 'form-control']) !!}
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-lg active" onclick="limparCampos('/painel/usuarios/');" ><i class="fa fa-trash-o"></i> Limpar</button>
            <button type="submit" class="btn btn-primary btn-lg active"><i class="fa fa-floppy-o"></i> Salvar</button>
        </div>


    </form>


</div>

@endsection

