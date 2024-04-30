@extends('layouts.app')

@section('title')
    Edit Todo
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Todos</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Todo</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('todos.update', $todo) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label class="mb-1">Name</label>
                        <input class="form-control  @error('name') is-invalid @enderror" id="inputName" type="text"
                            name="name" placeholder="Enter name" value="{{ $todo->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="mb-1">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="inputDescription" name="description"
                            placeholder="Enter description">{{ $todo->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="mb-1">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="inputStatus" name="status">
                            <option value="On Progress" {{ $todo->status == 'On Progress' ? 'selected' : '' }}>On Progress
                            </option>
                            <option value="Done" {{ $todo->status == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="btn btn-success" type="submit">Update</button>
                </form>
            </div>
        </div>

    </div>
@endsection
