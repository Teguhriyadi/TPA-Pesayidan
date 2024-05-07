<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

    <center>
        <h3>
            Login Application
        </h3>
        <form action="{{ route('authorization.process') }}" method="POST">
            @csrf
            <table border="1" cellpadding="10" cellspacing="0">
                <tbody>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td>
                            <input type="text" name="username" id="username" placeholder="Masukkan Username">
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td>
                            <input type="password" name="password" id="password" placeholder="Masukkan Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="reset">
                                Batal
                            </button>
                            <button type="submit">
                                Login
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </center>

</body>
</html>
