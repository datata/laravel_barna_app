<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
            Log::error('Error getting contacts: ' . $exception->getMessage());

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
            Log::error('Error getting task: ' . $exception->getMessage());

            if ($exception->getMessage() === "No query results for model [App\Models\Contact].") {
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

    public function createContact(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email'

            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };    

            $name = $request->input('name');
            $email = $request->input('email');
            // $phoneNumber = $request->input('phone_number');
            $birthday = $request->input('birthday');
            $userId = $request->input('user_id');

            $newContact = new Contact();

            $newContact->name = $name;
            $newContact->email = $email;
            $newContact->phone_number = $request->input('phone_number');
            $newContact->birthday = $birthday;
            $newContact->user_id = $userId;

            $newContact->save();

            return response()->json(
                [
                    "success" => true,
                    "messagge" => "Contact created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error('Error creating user: ' . $exception->getMessage());

            return response()->json(
                [
                    "success" => true,
                    "messagge" => "Error creating contact"
                ],
                500
            );
        }
    }

    public function updateContact(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'email' => 'email',
                'phone_number' => 'string'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };    

            $contact = Contact::query()->findOrFail($id);

            $name = $request->input('name');
            $email = $request->input('email');
            $phoneNumber = $request->input('phone_number');


            if(isset($name)) {
                $contact->name = $name;
            }

            if(isset($email)) {
                $contact->email = $request->input('email');
            }

            if (isset($phoneNumber)) {
                $contact->phone_number = $request->input('phone_number');
            }

            $contact->save();

            // Contact::where('id','=' ,$id)->update(
            //     [
            //         'name' => $request->input("name"),
            //         'email' => $request->input("email"),
            //         'phone_number' => $request->input("phone_number")
            //     ]
            // );

            return response()->json(
                [
                    "success" => true,
                    "messagge" => "Contact updated"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error('Error updating contact: ' . $exception->getMessage());

            return response()->json(
                [
                    "success" => true,
                    "messagge" => "Error updateing contact"
                ],
                500
            );
        }
    }

    public function deleteContact($id)
    {
        try {
            Contact::query()->find($id)->delete();

            return response()->json(
                [
                    "success" => true,
                    "messagge" => "Contact created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error('Error deleting Exception contact: '.$exception->getMessage());

            return response()->json(
                [
                    "success" => true,
                    "messagge" => "Error deleting contact"
                ],
                500
            );
        } catch (\Throwable $throwable) {
            Log::error('Error deleting Throwable contact: '.$throwable->getMessage());

            return response()->json(
                [
                    "success" => true,
                    "messagge" => "Error deleting contact"
                ],
                500
            );
        }
    }
}
