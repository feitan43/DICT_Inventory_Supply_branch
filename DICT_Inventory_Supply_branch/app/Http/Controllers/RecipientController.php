<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;

class RecipientController extends Controller
{
    /**
     * Display a listing of the recipients.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = [];
        $query = null; // Initialize the $query variable
        $search = $request->input('search', ''); // Initialize the $search variable
    
        // Retrieve all recipients
        $data = Recipient::orderBy('id', 'DESC');
    
        // Apply search filter if a search term is provided
        if ($search) {
            $data->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }
    
        $data = $data->paginate(5);
    
        return view('recipients.index', compact('data', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new recipient.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('recipients.create');
    }

    /**
     * Store a newly created recipient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:recipients',
            'address' => 'nullable',
            'contact' => 'nullable',
        ]);

        Recipient::create($request->all());

        return redirect()->route('recipients.index')
            ->with('success', 'Recipient created successfully.');
    }

    /**
     * Display the specified recipient.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $recipient = Recipient::findOrFail($id);

        return view('recipients.show', compact('recipient'));
    }

    /**
     * Show the form for editing the specified recipient.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $recipient = Recipient::findOrFail($id);

        return view('recipients.edit', compact('recipient'));
    }

    /**
     * Update the specified recipient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:recipients,email,'.$id,
            'address' => 'required',
            'contact' => 'required'
        ]);

        $input = $request->all();

        $recipient = Recipient::find($id);

        $recipient->update($input);

        return redirect()->route('recipients.index')
            ->with('update', 'Recipient updated successfully');
    }

    /**
     * Remove the specified recipient from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Recipient::destroy($id);

        return redirect()->route('recipients.index')
            ->with('success', 'Recipient deleted successfully.');
    }
}
