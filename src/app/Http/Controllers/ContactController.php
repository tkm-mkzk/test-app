<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        // 電話番号の結合
        $tel = $request->input('phone1') . $request->input('phone2') . $request->input('phone3');
        // 結合した電話番号をフォームデータに追加
        $request->merge(['tel' => $tel]);

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'phone1', 'phone2', 'phone3', 'tel', 'address', 'building', 'category_id', 'detail']);
        $contact['full_name'] = $contact['last_name'] . '　' . $contact['first_name'];

        $genders = ['男性', '女性', 'その他'];
        $contact['gender_text'] = $genders[$contact['gender']];

        $category = Category::findOrFail($contact['category_id']);
        $contact['category_content'] = $category->content;

        session()->flash('contact', $contact);

        return view('confirm', compact('contact'));
    }

    public function fix()
    {
        return redirect()->route('contacts.index')->withInput(session('contact'));
    }

    public function store(ContactRequest $request)
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
        $contact->gender_text = $contact->gender_text;
        return response()->json($contact);
    }
}
