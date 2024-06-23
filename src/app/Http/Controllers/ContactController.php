<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;

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

    public function admin(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name_or_email')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name_or_email . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name_or_email . '%')
                    ->orWhere('email', 'like', '%' . $request->name_or_email . '%');
            });
        }

        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->paginate(7)->appends($request->all());

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }


    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        $contact->gender_text = $contact->gender_text;
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json(['status' => 'success', 'message' => 'Contact deleted successfully']);
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name_or_email')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name_or_email . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name_or_email . '%')
                    ->orWhere('email', 'like', '%' . $request->name_or_email . '%');
            });
        }

        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->with('category')->get();

        $filename = "contacts_" . now()->format('Ymd_His') . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->first_name . ' ' . $contact->last_name,
                $contact->gender_text,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content,
                $contact->detail,
            ]);
        }

        fclose($handle);

        return Response::download($filename)->deleteFileAfterSend(true);
    }
}
