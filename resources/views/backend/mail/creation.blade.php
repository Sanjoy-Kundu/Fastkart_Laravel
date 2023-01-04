<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    {{--  <p>{{ print_r($information) }}</p> --}}
    {{--   <h1>Wellcome to FastKart</h1>
    <h2>Name: {{ $information['name'] }}</h2>
    <h3>Email: {{ $information['email'] }}</h3>
    <h3>Password: {{ $information['password'] }}</h3>
    <h4>Role: {{ $information['password'] }}</h4> --}}
    <header>
        <h1>Wellcome to <span style="color:blue;">FastKart</span></h1>
        <table border="1">
            <caption style="text-align: center">Wellcome to FastKar</caption>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <td>Role</td>
                <td>Login</td>
            </tr>
            <tr>
                <td>{{ $information['name'] }}</td>
                <td>{{ $information['email'] }}</td>
                <td>{{ $information['password'] }}</td>
                <td>{{ $information['role'] }}</td>
                <td><a href="{{ url('login') }}"
                        style="background-color:green; padding:3px 3px; color:white; text-decoration:none">Login</a>
                </td>
            </tr>
        </table>
    </header>


</body>

</html>
