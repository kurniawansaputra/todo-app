@extends('layouts.app')

@section('title')
    Detail Todo
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Todos</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Todo</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="mb-1">Name</label>
                    <input class="form-control id="inputName" type="text" name="name" placeholder="Enter name"
                        value="{{ $todo->name }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="mb-1">Description</label>
                    <textarea class="form-control" id="inputDescription" name="description" placeholder="Enter description" readonly>{{ $todo->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="mb-1">Status</label>
                    <input class="form-control id="inputName" type="text" name="name" placeholder="Enter name"
                        value="{{ $todo->status }}" readonly>
                </div>

            </div>
        </div>

    </div>
@endsection
