<?php
// beim Ändern existiert $user, bei Eingabe eines neuen users nicht, deshalb Leerstrings als Vorbelegung
if (!isset($user)) {
    $user = ['firstname' => '', 'lastname' => '', 'age' => '', 'department' => ''];
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Mitarbeiter</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        table {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049;
        }

        pre {
            display: none; /* Nur für Debug-Zwecke */
        }
    </style>
</head>
<body>
<?php
echo '<pre>';
print_r($user);
echo '</pre>'
?>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="eingabe">
    <table>
        <tr>
            <td><label for="firstName">Vorname:</label></td>
            <td><input type="text" id="firstName" name="firstName" value="<?php echo $user['firstname']; ?>"></td>
        </tr>
        <tr>
            <td><label for="lastName">Nachname:</label></td>
            <td><input type="text" id="lastName" name="lastName" value="<?php echo $user['lastname']; ?>"></td>
        </tr>
        <tr>
            <td><label for="age">Alter:</label></td>
            <td><input type="text" id="age" name="age" value="<?php echo $user['age']; ?>"></td>
        </tr>
        <tr>
            <td><label for="department">Abteilung:</label></td>
            <td><input type="text" id="department" name="department" value="<?php echo $user['department']; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="OK"><input type="reset" value="Zurücksetzen"></td>
        </tr>
    </table>
</form>
</body>
</html>