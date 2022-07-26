<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getAllContacts ()
    {
        return 'Get All contacts ';
    }

    public function getContactById ($id)
    {
        return 'Contact by id ' . $id;
    }

    public function createContact ()
    {
        return "Create contact by id";
    }

    public function updateContact ($id)
    {
        return "Update contact by id" . $id;
    }

    public function deleteContact ($id)
    {
        return "Delete contacty by id" . $id;
    }
}
