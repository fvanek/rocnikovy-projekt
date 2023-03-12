<x-layout>
    <x-slot name="title">
        Moje příspěvky
    </x-slot>
    <x-backbutton class="mb-2"/>
    <x-posts :posts="$posts" />
    <x-footer />
</x-layout>
