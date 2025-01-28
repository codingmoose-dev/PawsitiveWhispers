<!DOCTYPE html>
<html>
<head>   
    <title>Login - Animal Care and Pet Adoption Platform</title>
</head>
<body>
<h1>Login to Animal Care and Pet Adoption Platform</h1>
<form action="../control/login_control.php" method="post">
    <fieldset>
        <legend>Login</legend>
        <table>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="Email" ></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="Password" ></td>
            </tr>
        </table>
    </fieldset>
    
    <fieldset>
        <input type="submit" name="Login" value="Login">
        <input type="reset" name="ClearForm" value="Clear Form">
    </fieldset>
</form>
</body>
</html>
