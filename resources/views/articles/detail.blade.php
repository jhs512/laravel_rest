@extends('app')

@section('title', '게시물 상세내용')

@section('content')
    <section class="section-1 t-mt-4">
        <div class="t-container t-mx-auto t-px-4">
            <div class="t-flex">
                <h1 class="t-font-bold t-mr-auto"><i class="fas fa-newspaper"></i> {{ $article->id }}번 글 내용</h1>
            </div>

            <div class="t-grid t-grid-cols-1 t-gap-4 t-mt-4">

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

                <div class="t-font-bold t-text-lg">
                    {{ $article->title }}
                </div>

                @if ($article->img_1)
                    <div>
                        <img src="{{ asset('storage/' . $article->img_1) }}" alt="{{ $article->title }}"
                            class="t-rounded">
                    </div>
                @endif


                <div class="t-text-gray-500">
                    {!! nl2br(e($article->body)) !!}
                </div>

                <div class="t-flex t-gap-3">
                    <span>
                        <i class="fa-regular fa-thumbs-up"></i> {{$article->good_reaction_point}}
                    </span>
                    <span>
                        <i class="fa-regular fa-thumbs-down"></i> {{$article->bad_reaction_point}}
                    </span>
                </div>

                <div class="t-flex t-gap-3">
                    @can('makeGoodReactionPoint', [App\Models\ReactionPoint::class, 'article', $article->id])
                    <form class="t-m-0" action="{{ route('reaction-points.make-good', ['article', $article->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fa-regular fa-thumbs-up"></i> +1
                        </button>
                    </form>
                    @endcan

                    @can('makeBadReactionPoint', [App\Models\ReactionPoint::class, 'article', $article->id])
                    <form class="t-m-0" action="{{ route('reaction-points.make-bad', ['article', $article->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fa-regular fa-thumbs-down"></i> -1
                        </button>
                    </form>
                    @endcan
                    
                    @can('cancelGoodReactionPoint', [App\Models\ReactionPoint::class, 'article', $article->id])
                        <form class="t-m-0" action="{{ route('reaction-points.cancel-good', ['article', $article->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-thumbs-up"></i> +1
                            </button>
                        </form>
                    @endcan

                    @can('cancelBadReactionPoint', [App\Models\ReactionPoint::class, 'article', $article->id])
                        <form class="t-m-0" action="{{ route('reaction-points.cancel-bad', ['article', $article->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-thumbs-down"></i> -1
                            </button>
                        </form>
                    @endcan
                </div>

                <div class="t-flex t-gap-4">
                    @can('update', $article)
                        <a href="{{ route('articles.edit', $article->id) }}" href="#" class="btn btn-link">
                            <i class="far fa-edit"></i>
                            수정
                        </a>
                    @endcan
                    @can('delete', $article)
                        <form class="t-m-0" action="{{ route('articles.destroy', $article->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="if ( !confirm('정말 삭제하시겠습니까?') ) return false;"
                                class="btn btn-outline-danger">
                                <i class="fas fa-trash-alt"></i>

                                삭제
                            </button>
                        </form>
                    @endcan
                    <a href="{{ route('articles.index') }}" class="btn btn-link t-ml-auto">
                        <i class="fas fa-list"></i> 리스트
                    </a>

                    @can('create', App\Models\Article::class)
                        <a href="{{ route('articles.create') }}" class="btn btn-link">
                            <i class="fas fa-pen"></i>
                            작성
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </section>
@endsection
