<a href="{{ route('subforum', $subforum->id) }}" class="text-dark"
   data-bs-toggle="popover" data-bs-title="{{ DB::table('subforums')->where('id', $subforum->id)->value('name') }}"
   data-bs-content="{{ DB::table('subforums')->where('id', $subforum->id)->value('description') }}">
    <img src="{{ asset('storage/' . DB::table('subforums')->where('id', $subforum->id)->value('image')) }}"
         style="width: 20px; height: 20px;" alt="Subforum Image">
    {{ DB::table('subforums')->where('id', $subforum->id)->value('name') }}
</a>
