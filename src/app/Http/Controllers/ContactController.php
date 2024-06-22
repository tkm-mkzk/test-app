<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        // 電話番号の結合
        $tel = $request->input('phone1') . $request->input('phone2') . $request->input('phone3');
        // 結合した電話番号をフォームデータに追加
        $request->merge(['tel' => $tel]);

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        $contact['full_name'] = $contact['last_name'] . '　' . $contact['first_name'];

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }

    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        return view('admin', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        $contact->gender_text = $contact->gender_text;  // Optional: to ensure gender_text is included
        return response()->json($contact);
    }
}
