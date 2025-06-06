<?php
session_start();
require_once '../includes/database.php';

if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
    header('location: index');
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ReportRater</title>
    <!-- tab icon -->
    <link rel="shortcut icon" href="">
    <!-- bootstrap ui -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- htmx -->
    <script src="../node_modules/htmx.org/dist/htmx.min.js" crossorigin="anonymous"></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <header class="bg-dark py-3 text-white text-center mb-2">
        <div class="float-start ms-3">
            <button class="btn btn-dark pt-0" data-bs-toggle="modal" data-bs-target="#manage">
                <span><i class="bi bi-person-fill-gear"></i></span>
                Manage Students
            </button>
        </div>
        ReportRater
        <a href="../logout" type="button"
            class="text-decoration-none text-white float-end h5 me-3 p-1 text-capitalize mt-0 pt-0">
            <span><i class="bi bi-box-arrow-right"></i>logout</span>
        </a>
    </header>

    <div class="container-fluid">

        <form hx-post="add-user" hx-target="#participant-list" hx-swap="beforeend">
            <div class="row g-4">
                <div class="col-md-2">
                    <select class="form-select form-select-sm text-capitalize" name="participant" hx-get="get-users"
                        hx-trigger="load" hx-target="this">
                        <!-- Options will be dynamically loaded here -->
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="add-participant" class="btn btn-success btn-sm">Add Student</button>
                </div>
            </div>
        </form>

        <h3 class="mt-2 ms-2 bg-success text-white">Participant</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 shadow-sm" id="participant-list" hx-get="get-participants"
                    hx-trigger="load, every 2s">

                </div>
                <div class="col-md-2 shadow-sm">
                <i class="bi bi-circle-fill text-success">Online</i>
                <i class="bi bi-circle-fill text-danger">Offline</i>
                    <div class="offcanvas-body mt-2" id="participant-list-update" hx-get="participant-list-update"
                        hx-trigger="load, every 1s">
                        <!-- this shows the update -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal para sa bawat user -->
    <div class="modal fade" id="showEachCard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- mag add ng id kagaya ng "modalBody" para sa handle ng parameter -->
                <div class="modal-body" id="modalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for management -->
    <div class="modal fade" id="manage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Manage Users</h1>
                            </div>
                            <div class="col-1 text-end">
                                <span><i class="bi bi-search fs-5"></i></span>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-sm" name="search" id="search"
                                    type="search" placeholder="Search" hx-post="search-users"
                                    hx-trigger="input changed delay:500ms, search" hx-target="#search-results">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Group</th>
                                    <th>Year/Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="search-results" hx-get="manage" hx-trigger="load" hx-target>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>