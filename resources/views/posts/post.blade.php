@foreach ($allPosts as $post)
<div class="mt-4 card">
            <div  class="d-flex flex-row align-items-center  card-header">
                <img src="{{ $post->user->picture }}" alt=" profile img" class="rounded-circle m-2"  style="width:40px; height:40px;" >
                <h6 class="card-title">{{ $post->user->name }}</h6>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text "> {{ substr($post->content, 0, 100) }}... </p>
                
                <div class="d-flex justify-content-between">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">

                        @php
                            $liked = $post->likes->contains('user_id', auth()->id());
                            $saved = $post->savedPosts->contains('user_id', auth()->id());
                        @endphp


                        <form action="{{ route('posts.like') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            @if ($liked)
                                <button type="submit" class="btn btn-primary bi bi-hand-thumbs-up "> {{$post->likes->count() }}</button>
                            @else
                                <button type="submit" class="btn btn-outline-primary bi bi-hand-thumbs-up "> {{ $post->likes->count() }}</button>
                            @endif
                        </form>


                        <a href="{{ route('posts.show', $post) }}"><button type="button" class="btn btn-outline-secondary bi bi-chat-square"> {{  $post->comments->count() }}</button></a>
                        <form action="{{ route('posts.save') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            @if ($saved)
                                <button type="submit" class="btn btn-dark bi bi-save "> {{$post->savedPosts->count() }}</button>
                            @else
                                <button type="submit" class="btn btn-outline-dark bi bi-save "> {{ $post->savedPosts->count() }}</button>
                            @endif
                        </form>

                    </div>
                <div class="" role="group" aria-label="Small button group">
                <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-primary">The post</a>
                @if($post->user_id === Auth::id())
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-secondary">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
                @endif
                </div>
            </div>
            </div>
</div> 

@endforeach
            