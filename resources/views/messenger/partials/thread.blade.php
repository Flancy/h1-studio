<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="col-md-4 mb-5">
    <div class="card">
        <h5 class="card-header {{ $class }}">
            Тема: <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
            ({{ $thread->userUnreadMessagesCount(Auth::id()) }} не прочитано)
        </h5>
        <div class="card-body">
            <p>
                <small><strong>Создатель:</strong> {{ $thread->creator()->name }}</small>
            </p>
        </div>
        <div class="card-footer">
            <p>
                <strong>Последнее сообщение:</strong> {{ $thread->latestMessage->body }}
            </p>
        </div>
    </div>
</div>