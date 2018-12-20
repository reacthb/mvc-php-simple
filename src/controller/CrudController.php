<?php

require __DIR__ . '/../../config/config.php';
require __DIR__ . '/../model/CrudManager.php';
require __DIR__ . '/../common.php';

function createController() {
    $ok = false;
    if (isset($_POST['submit'])) {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $location = $_POST['location'];
        $ok = createManager($firstName, $lastName, $email, $age, $location);
    }
    require(__DIR__ . '/../view/createView.php');
}

function readController() {
    $result = false;
    $submitted = false;

    if (isset($_POST['submit'])) {
        $submitted = true;
        $location = $_POST['location'];
        $result = readManager($location);
    }
    require(__DIR__ . '/../view/readView.php');
}

function updateController() {
    $result = updateManager();
    require(__DIR__ . '/../view/updateView.php');
}

function updateSingleController($id) {
    $submitted = false;
    $user = getUserManager($id);

    if (isset($_POST['submit'])) {
        $submitted = true;
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $location = $_POST['location'];
        $date = $_POST['date'];
        $ok = updateSingleManager($id, $firstName, $lastName, $email, $age, $location, $date);
    }
    require(__DIR__ . '/../view/updateSingleView.php');
}

function deleteController() {

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        $id = 0;
    }
    $resTab = deleteManager($id);
    $success = $resTab[0];
    $result = $resTab[1];

    require(__DIR__ . '/../view/deleteView.php');
}
