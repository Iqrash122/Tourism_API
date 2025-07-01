<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\SupportQuery;
use App\Models\User;

class SupportController extends Controller
{
    public function support_index()
    {
        $queries = SupportQuery::with(['customer.user'])->latest()->get();
        return view('admin.support.index', compact('queries'));
    }

    public function create_support()
    {
        $customers = Customer::all();
        return view('admin.support.create', compact('customers'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|string|email|max:255',
            'type' => 'required|string',
            'query' => 'required|string',
            'status' => 'required|string|in:Open,Closed',
        ]);

        SupportQuery::create($request->all());

        return redirect()->route('support.index')->with('success', 'Support query submitted successfully.');
    }


    public function edit_support($id)
    {
        $query = SupportQuery::with('user')->findOrFail($id);
        return view('admin.support.edit', compact('query'));
    }

    public function update_support(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Open,Closed',
            'response' => 'nullable|string',
        ]);

        $query = SupportQuery::findOrFail($id);
        $query->update([
            'status' => $request->status,
            'response' => $request->response,
        ]);

        return redirect()->route('support.index')->with('success', 'Support request updated successfully.');
    }

    public function destroy_support($id)
    {
        $query = SupportQuery::findOrFail($id);
        $query->delete();

        return redirect()->route('support.index')->with('success', 'Support request deleted successfully.');
    }
}
