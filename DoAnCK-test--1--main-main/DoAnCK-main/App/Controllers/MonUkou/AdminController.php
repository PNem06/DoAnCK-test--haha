<?php
namespace App\Controllers\MonUkou;

class AdminController {

    public function dashboard() {
        include 'App/Views/Admin/dashboard.php';
    }
public function addpost() {
    require 'App/Views/Admin/addpost.php';
}

public function detailpost() {
    require 'App/Views/Admin/detailpost.php';
}

}