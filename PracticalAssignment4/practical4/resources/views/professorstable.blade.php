@extends('layouts.master')
@section('title', 'Professors List')

@section('content')
<h2>Professors List</h2>

<form action="/professors" method="GET">
    <label for="txtFirstName">First name</label>
    <input id="txtFirstName" name="firstName" value="{{ $firstName }}" />
    <label for="txtLastName">Last name</label>
    <input id="txtLastName" name="lastName" value="{{ $lastName }}" />
    <label for="txtCity">City</label>
    <input id="txtCity" name="city"  value="{{ $city }}" />
    <label for="txtAddress">Address</label>
    <input id="txtAddress" name="address" value="{{ $address }}" />
    <label for="txtSalary">Salary</label>
    <input id="txtSalary" name="salary" value="{{ $salary }}" />
    <input type="submit" value="Search" />
</form>

<table class="table table-dark table-striped table-hover">
    <thead>
        <tr>
            <th>
                First name
            </th>
            <th>
                Last name
            </th>
            <th>
                City
            </th>
            <th>
                Address
            </th>
            <th>
                 Salary
            </th>
        </tr>
    </head>
    <tbody>
        @foreach ($professors as $professor)
        <tr>
            <td>
                {{ $professor->firstName }}
            </td>
            <td>
                {{ $professor->lastName }}
            </td>
            <td>
                {{ $professor->city }}
            </td>
            <td>
                {{ $professor->address }}
            </td>
            <td>
                {{ $professor->salary }}
            </td>
            <td>
                <a href="/professors/{{ $professor->id }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="/professoradd" class="btn btn-dark">New professor</a>
@stop