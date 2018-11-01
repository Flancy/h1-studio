<h5>Новое сообщение</h5>
<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    <!-- Message Form Input -->
    <div class="form-group">
        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
    </div>

    @if($users->count() > 0)
        @if(Auth::user()->isAdmin())
            <select-users></select-users>
        @else
            <input type="checkbox" style="display: none" name="recipients[]" value="1">
        @endif
    @endif

    <!-- Submit Form Input -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">Отправить</button>
    </div>
</form>