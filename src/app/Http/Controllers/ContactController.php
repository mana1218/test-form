<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);

        $category = Category::find($contact['category_id']);
        return view('confirm', compact('contact', 'category'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        
        Contact::create($contact);
        return view('thanks');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
