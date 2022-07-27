<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function getAllContacts()
    {
        try {
            Log::info('Getting all contacts');
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
            Log::error('Error getting contacts: '. $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting contacts"
                ],
                500
            );
        }
    }

    public function getContactById($id)
    {
        try {
            Log::info('Getting task by id');
            // $contact = Contact::query()->find($id);

            // $contact = Contact::query()->where('id', '<', $id)->first();

            $contact = Contact::query()->where('id', $id)->firstOrFail();            

            // if (!$contact) {
            //     return response()->json(
            //         [
            //             'success' => true,
            //             'message' => "Contact not found",
            //         ],
            //         404
            //     );
            // }

            return response()->json(
                [
                    'success' => true,
                    'message' => "Get contact by id.",
                    'data' => $contact
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error('Error getting task: '.$exception->getMessage());

            if($exception->getMessage() === "No query results for model [App\Models\Contact].")
            {
                return response()->json(
                    [
                        'success' => true,
                        'message' => "Contact not found",
                    ],
                    404
                );
            }
            
            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting task"
                ],
                500
            );
        }
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
