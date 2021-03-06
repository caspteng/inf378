<div class="scrolling-pagination">
    @forelse($tweets as $tweet)
        @include('includes.tweet')
    @empty
        <div class="ui large feed raised segment">
            <div class="ui active inverted dimmer">
                <div class="ui text">Pas de contenu à afficher</div>
            </div>
            <img class="ui wireframe image" src="{{ asset('/assets/images/wireframe/short-paragraph.png') }}">
        </div>
    @endforelse
    {{ $tweets->links() }}
</div>
