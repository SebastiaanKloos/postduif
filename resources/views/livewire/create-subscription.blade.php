<div>
    <x-brand :team="$team" />

    @if(! filled($message))
    <div class="p-10 overflow-y-scroll grid gap-10">
        <p>{{ $team->description }}</p>

        {{ $this->form }}

        <div>
            {{ $this->submitAction }}
        </div>
    </div>
    @endif

    @if(filled($message))
        <div class="p-10 text-center">
            <p>{{ $message }}</p>
        </div>
    @endif
</div>
