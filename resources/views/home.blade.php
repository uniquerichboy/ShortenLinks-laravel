@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Сервис по сокращению ссылок</div>

                <form class="p-3" method="POST" action="{{ route('create') }}">
                    @csrf
                    
                    <div class="form-outline mb-4">
                        <input type="text" id="link" name="link" class="form-control @error('title') is-invalid @enderror" style="border: solid 1px #eee;" value="{{ old('link') }}" />
                        <label class="form-label" for="link">Введите ссылку</label>
                        @error('link')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Сократить</button>
                </form>
            </div>

            <div class="card mt-5">
                <div class="card-header">Ваши ссылки</div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Старая ссылка</th>
                            <th scope="col">Новая ссылка</th>
                            <th scope="col">Скопировать</th>
                            <th scope="col">Удалить</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($links as $key => $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td>
                            @php 
                            if(mb_strlen($link->default_link) >= 30) {
                                echo mb_substr($link->default_link, 0, 30).'...';
                            } else echo mb_substr($link->default_link, 0, 100);
                            @endphp
                            </td>
                            <td>{{ $link->generate_link }}</td>
                            <td>
                                <input type="text" style="opacity: 0;position: absolute;z-index:-1;" value="{{ $link->generate_link }}" id="{{$link->id}}">
                                <button class="btn btn-primary" onclick="copy('{{$link->id}}')">Копировать</button>
                            </td>
                            <td>
                               <a href="{{ route('delete', ['id' => $link->id]) }}"><button class="btn btn-danger">Удалить</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script>
function copy(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    document.execCommand("copy");
}
</script>

@endsection
