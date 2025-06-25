@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Testimoni</h1>

    <form action="{{ route('testimonis.update', $testimoni->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Form fields sama seperti create.blade.php -->
        <!-- Tapi dengan value="{{ $testimoni->field }}" -->
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection