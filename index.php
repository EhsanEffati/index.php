<?php
// nur zum Überprüfen der Variablen, welche Werte angekommen sind
echo '<pre>';
//print_r($_POST);
echo '</pre>';
include 'config.php';
include 'htmlFunctions/functions.php';
include 'backendFunctions/functions.php';

// Variablenempfang
$firstName = $_POST['firstName'] ?? '';
$lastName = $_POST['lastName'] ?? '';
$age = $_POST['age'] ?? '';
$department = $_POST['department'] ?? '';
$action = $_REQUEST['action'] ?? 'zeigeliste';
$id = $_GET['id'] ?? 0;

$view = $action; // Standardwert
if ($action === 'eingabe') {
    // Überprüfen, daß kein Leerstring dabei ist
    if (checkValueGreaterZero($firstName) && checkValueGreaterZero($lastName) &&
        checkValueGreaterZero($age) && checkValueGreaterZero($department)) {
        // dann Eingabedaten in db speichern

        $dbcon = getDbConnection();
        $stmnt = "INSERT INTO user (firstname, lastname, age,department) 
                  VALUES (:firstname,:lastname,:age,:department)";
        $request = $dbcon->prepare($stmnt);
        $request->bindParam(":firstname", $firstName, PDO::PARAM_STR);
        $request->bindParam(":lastname", $lastName, PDO::PARAM_STR);
        $request->bindParam(":age", $age, PDO::PARAM_INT);
        $request->bindParam(":department", $department, PDO::PARAM_STR);
        $request->execute();
        $view = 'erfolg';
    } else {
        $view = 'fehler';
    }
} elseif ($action === 'zeigeliste') {
    $dbcon = getDbConnection();
    $stmnt = "SELECT * FROM user";
    $select_stm = $dbcon->prepare("SELECT * FROM user");
    $select_stm->execute();

    $users = $select_stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $key => $user) {
        // füe jedem Element von $users eine index 'delete' zu,
        // damit erstelle ich den Löschknopf
        $users[$key]['delete'] = '<a href="index.php?action=delete&id=' . $user['id'] . '"><button>LÖSCHEN</button></a>';
        $users[$key]['zeigeeingabe'] = '<a href="index.php?action=aendern&id=' . $user['id'] . '"><button>ändern</button></a>';
    }
    $tableHeadNames = ['Id', 'Vorname', 'Nachname', 'Alter', 'Abteilung', 'Löschen', 'Ändern'];
    $view = $action;
} elseif ($action === 'delete') {
    // Datensatz löschen
    $dbcon = getDbConnection();
    $stmnt = "DELETE FROM user WHERE id=:id";
    $request = $dbcon->prepare($stmnt);
    $request->bindParam(":id", $id, PDO::PARAM_INT);
    $request->execute();
    // Liste anzeigen
    $dbcon = getDbConnection();
    $stmnt = "SELECT * FROM user";
    $select_stm = $dbcon->prepare("SELECT * FROM user");
    $select_stm->execute();

    $users = $select_stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $key => $user) {
        // füe jedem Element von $users eine index 'delete' zu,
        // damit erstelle ich den Löschknopf
        $users[$key]['delete'] = '<a href="index.php?action=delete&id=' . $user['id'] . '"><button>LÖSCHEN</button></a>';
        $users[$key]['zeigeeingabe'] = '<a href="index.php?action=aendern&id=' . $user['id'] . '"><button>ändern</button></a>';
    }
    $tableHeadNames = ['Id', 'Vorname', 'Nachname', 'Alter', 'Abteilung', 'Löschen', 'Ändern'];
    $view = 'zeigeliste';
} elseif ($action === 'aendern') {
    $dbcon = getDbConnection();
    $stmnt = "SELECT * FROM user WHERE id=:id";
    $request = $dbcon->prepare($stmnt);
    $request->bindParam(":id", $id, PDO::PARAM_INT);
    $request->execute();

    $user = $request->fetch(PDO::FETCH_ASSOC);
    $view = 'zeigeeingabe';
}elseif ($action === 'update') {
    // Datensatz aktualisieren
    $dbcon = getDBconnection();
    $stmnt = "UPDATE user SET 
                firstName = :firstName,
                lastName = :lastName,
                age = :age,
                department = :department
              WHERE id = :id";
    $request = $dbcon->prepare($stmnt);
    $request->bindParam(":firstName", $firstName);
    $request->bindParam(":lastName", $lastName);
    $request->bindParam(":age", $age);
    $request->bindParam(":department", $department);
    $request->bindParam(":id", $id, PDO::PARAM_INT);
    $request->execute();

    $view = 'zeigeliste'; // Nach Update zurück zur Liste
}

// Am Ende: Die passende View einbinden
$viewFile = "views/" . $view . ".php";
if (file_exists($viewFile)) {
    include $viewFile;
} else {
    echo "<h3>❌ Fehler: '$viewFile' wurde nicht gefunden.</h3>";
    echo "<p>Bitte überprüfe, ob die Datei im views-Ordner existiert.</p>";
}

?>







