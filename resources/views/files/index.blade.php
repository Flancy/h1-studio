@extends('layouts.app')
@section('content')
<div class="container orders">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Файлы</div>
                <div class="card-body">
                    <files-create></files-create>
                    <files-index></files-index>
                    <?php echo $files->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection