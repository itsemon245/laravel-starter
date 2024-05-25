@extends('layouts.admin.app')

@section('content')
<x-input wire:model="firstName" label="Name" placeholder="User's first name" />
<livewire:counter />
@endsection
