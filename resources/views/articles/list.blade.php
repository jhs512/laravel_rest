@extends('app')

@section('title', '게시물 리스트')

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <div class="t-flex">
                <h1 class="t-font-bold t-mr-auto"><i class="fas fa-list"></i> 게시물 리스트</h1>
                @can('create', App\Models\Article::class)
                    <a href="{{ route('articles.create') }}" class="link-primary"><i class="fas fa-pen"></i> 글 작성</a>
                @endcan
            </div>
            <div class="t-flex t-justify-end t-mt-3">
                <form action="" class="t-flex">
                    <input name="search_keyword" type="text" class="form-control" placeholder="검색" value="{{request()->get('search_keyword')}}">
                    <span>&nbsp;</span>
                    <button type="submit" class="btn btn-outline-success t-whitespace-nowrap">검색</button>
                </form>
            </div>
            <ul class="t-grid t-grid-cols-1 sm:t-grid-cols-2 lg:t-grid-cols-3 t-gap-4 t-mt-4">
                @foreach ($articles as $article)
                    <li>
                        <div class="card">
                            <a href="{{ route('articles.show', $article->id) }}" class="t-block">
                                <img src="{{ $article->thumb_img_url }}" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <div class="t-grid t-gap-4">
                                    <div class="t-flex t-gap-4 t-flex-wrap">
                                        <a href="{{ route('articles.show', $article->id) }}">
                                            <span class="badge bg-primary">No. {{ $article->id }}</span>
                                        </a>
                                        <a href="{{ route('articles.show', $article->id) }}" class="t-mr-auto">
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-clock"></i>
                                                {{ $article->created_at->format('y.m.d H:i') }}
                                            </span>
                                        </a>
                                        <a href="{{ route('articles.show', $article->id) }}">
                                            <span class="badge bg-success">
                                                <i class="fas fa-user"></i> {{ $article->user->name }}
                                            </span>
                                        </a>
                                    </div>

                                    <a href="{{ route('articles.show', $article->id) }}"
                                        class="t-block card-title t-truncate">
                                        @if ( count($article->logined_user_reaction_points) > 0 and $article->logined_user_reaction_points[0]->point > 0 )
                                            <span class="t-text-red-500"><i class="fa-solid fa-heart"></i></span>
                                        @endif
                                        <span>{{ $article->title }}</span>
                                    </a>

                                    <a href="{{ route('articles.show', $article->id) }}"
                                        class="t-block card-text t-text-gray-500">
                                        <div class="multiline-truncate-3">
                                            {{ $article->body }}
                                        </div>
                                    </a>

                                    <div class="t-flex t-gap-3">
                                        <span>
                                            <i class="fa-regular fa-thumbs-up"></i> {{$article->good_reaction_point}}
                                        </span>
                                        <span>
                                            <i class="fa-regular fa-thumbs-down"></i> {{$article->bad_reaction_point}}
                                        </span>
                                    </div>

                                    <div class="t-flex t-justify-end">
                                        @can('update', $article)
                                            <a href="{{ route('articles.edit', $article->id) }}" href="#"
                                                class="btn btn-link">
                                                <i class="far fa-edit"></i>
                                                수정
                                            </a>
                                        @endcan
                                        @can('delete', $article)
                                            <form class="t-m-0"
                                                action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" onclick="if ( !confirm('정말 삭제하시겠습니까?') ) return false;"
                                                    class="btn btn-outline-danger">
                                                    <i class="fas fa-trash-alt"></i>

                                                    삭제
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="t-mt-3">
                {{ $articles->withQueryString()->links() }}
            </div>
        </div>
    </section>
@endsection
