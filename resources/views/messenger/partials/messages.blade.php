<div class="row justify-content-center">
    <div class="col-sm-2">
        <img src="/img/avatar-default.jpg"
             alt="{{ $message->user->name }}" class="rounded-circle" style="max-width: 100%;">
    </div>
    <div class="col-sm-9">
        <div class="alert alert-secondary">
            <h5 class="alert-heading">{{ $message->user->name }}</h5>
            <p>{{ $message->body }}</p>
            <div class="text-muted">
                <small>Автор: {{ $message->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
</div>