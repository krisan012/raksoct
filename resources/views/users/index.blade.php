@extends('layouts.app')

<div class="container">
    <h1>Users List</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr></tr>
        @endforeach
        </tbody>
    </table>
</div>
