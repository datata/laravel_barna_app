<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function getAllContacts()
    {
        try {
            // QUERY BUILDER
            // $contacts = DB::table('contacts')->select('name', 'email')->get()->toArray();

            // MODEL
            $contacts = Contact::query()
                ->get()
                ->toArray();    

            return response()->json(
                [
                    'success' => true,
                    'message' => "Get all contacts retrieved.",
                    'data' => $contacts
                ],
                200
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting contacts: ".$exception->getMessage()
                ],
                500
            );
        }
    }

    public function getContactById($id)
    {
        return 'Contact by id ' . $id;
    }

    public function createContact()
    {
        return "Create contact by id";
    }

    public function updateContact($id)
    {
        return "Update contact by id" . $id;
    }

    public function deleteContact($id)
    {
        return "Delete contacty by id" . $id;
    }
}
