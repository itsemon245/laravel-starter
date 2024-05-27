@extends('layouts.admin.app')

@section('content')
@php
    $users = \App\Models\User::take(5)->get();
 
    $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Nice Name'],
    ];
@endphp
{{-- --}}
<livewire:modal/>
{{-- You can use any `$wire.METHOD` on `@row-click` --}}
{{-- <x-table :headers="$headers" :rows="$users" striped @row-click="alert($event.detail.name)" /> --}}
@endsection
