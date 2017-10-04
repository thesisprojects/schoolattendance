<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class CampaignController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company->with('campaigns')->first();
        return view('pages.campaigns.index')->with([
            'company' => $company
        ]);
    }

    public function postCreate(Request $request)
    {
        try {
            $this->validate($request, [
                'logo_address' => 'required|min:8',
                'name' => 'required|min:2|max:8',
                'telephone_number' => 'required',
                'address' => 'required|min:1|max:85',
                'country' => 'required|min:3|max:50',
                'dialler_database' => 'required|min:3|max:10',
            ]);
            $data = $request->all();
            $data['id'] = Uuid::uuid1();
            $campaign = new Campaign($data);
            $campaign->company_id = Auth::user()->company->id;
            $campaign->save();
            return back()->with('status', 'Campaign created.');
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Something fatal went up',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
