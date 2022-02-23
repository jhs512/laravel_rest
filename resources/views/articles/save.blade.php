@extends('app')

@php
$pageModeHan = $pageMode == 'write' ? '작성' : '수정';
$actionUrl = $pageMode == 'write' ? route('articles.store') : route('articles.update', $article->id);
$formMethod = $pageMode == 'write' ? 'POST' : 'PATCH';
@endphp

@section('title', '게시물 ' . $pageModeHan)

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-pen"></i> 글 {{ $pageModeHan }}</div>

                <div class="card-body">
                    <form class="t-grid t-grid-cols-1 t-gap-4 t-mt-4" action="{{ $actionUrl }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method($formMethod)
                        @if ($pageMode == 'edit')
                            <div class="t-flex t-gap-4 t-flex-wrap">
                                <div>
                                    <span class="badge bg-primary">No. {{ $article->id }}</span>
                                </div>
                                <div class="t-mr-auto">
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-clock"></i> {{ $article->created_at->format('y.m.d H:i') }}
                                    </span>
                                </div>
                                <div>
                                    <span class="badge bg-success">
                                        <i class="fas fa-user"></i> {{ $article->user->name }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="form-label">제목</label>
                            <input name="title" type="text" maxlength="100"
                                class="@error('title') is-invalid @enderror form-control" placeholder="제목을 입력해주세요."
                                value="{{ old('title', $article->title) }}">

                            @error('title')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label>내용</label>
                            <textarea name="body" class="@error('body') is-invalid @enderror form-control" rows="10"
                                placeholder="내용을 입력해주세요.">{{ old('body', $article->body) }}</textarea>

                            @error('body')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label>이미지 1</label>
                            <input type="file" name="img_1" class="@error('img_1') is-invalid @enderror form-control">

                            @error('img_1')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($article->img_1)
                            <div class="form-check t-mt-2">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="Y" name="img_1__remove">

                                    <span>삭제</span>
                                </label>
                            </div>
                            
                            <div>
                                <img src="{{ asset('storage/' . $article->img_1) }}" alt="{{ $article->title }}" class="t-rounded">
                            </div>
                            @endif
                        </div>

                        <div class="t-flex t-gap-4">
                            <button class="btn btn-primary t-mr-auto">
                                <i class="fas fa-pen"></i>
                                {{ $pageModeHan }}
                            </button>
                            <a href="{{ route('articles.index') }}" class="btn btn-link">
                                <i class="fas fa-list"></i>

                                리스트
                            </a>

                            @if ($pageMode == 'edit')
                                <a class="t-m-0 btn btn-outline-danger"
                                    href="javascript:if ( confirm('정말로 삭제하시겠습니까?') ) document.article_destory_form.submit();">
                                    <i class="fas fa-trash-alt"></i>
                                    삭제
                                </a>
                            @endif
                        </div>
                    </form>

                    @if ($pageMode == 'edit')
                        <form class="t-hidden" name="article_destory_form"
                            action="{{ route('articles.destroy', $article->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
