@extends('layouts.app')

@section('content')
<div class="container orders">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header primary">Создать новую беседу</h5>
                <div class="card-body">
                    <form action="{{ route('messages.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label">Название беседы</label>
                            <input type="text" class="form-control" name="subject" placeholder="Название беседы"
                                   value="{{ old('subject') }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Сообщение</label>
                            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                        </div>

                        @if($users->count() > 0)
                            @if(Auth::user()->isAdmin())
                                <select-users></select-users>
                            @else
                                <input type="checkbox" style="display: none" name="recipients[]" value="1" checked="checked">
                            @endif
                        @endif
                
                        <!-- Submit Form Input -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
         </div>
     </div>
</div>
@stop
