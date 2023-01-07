<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invite;
use Validator;
use Hash;
use Illuminate\Support\Str;
use App\Jobs\InviteeEmailJob;
// use App\Http\Controllers\CustomAuthController;

use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Auth\Authenticatable;


use App\Models\User;

class InviteController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $invite = '';
        return view('invite/index', compact('invite'));
    }
	public function accept()
    {        
        if (!$invite = Invite::where('token', $this->request->token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }
         
        $user = User::create(['email' => $invite->email,'password'=> Hash::make($this->request->token)] );     
        
        $invite->delete();

        Auth::login($user);
        return redirect("dashboard")->withSuccess('Signed in');        
    }  
    
    public function destroy(Invite $Invite)
    {
        $Invite=Invite::find($this->request->id);        
        $Invite->delete();
        return response()->json(['success' => 'Invitee deleted successfully.']);
    }

    public function store_test(Request $request)
    {
        $invite = Invite::where('email', $request->email )->first();
        
        if($invite){
            InviteeEmailJob::dispatchNow($invite,$MailData);
            // InviteeEmailJob::dispatch($client,$mailInfo);            
        }
    }

    public function store(Request $request)
    {        
        $validator = Validator::make(
            $request->all(), [                
                'email' => 'required|email|unique:invites|email:rfc,dns|max:255',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
  
        do {            
            $token = Str::random(14);
        } 
        while (Invite::where('token', $token)->first());
     
        //create a new invite record
        $invite = Invite::create([
            'email' => $request->email,
            'user_id' => auth()->check() ? auth()->user()->id : 0,
            'token' => $token
        ]);

        $MailData['subject'] = 'Invitee Mail';
        $MailData['url'] = route('invites.accept', $invite['token']);

        if($invite){
            // InviteeEmailJob::dispatchNow($invite,$MailData);
            InviteeEmailJob::dispatch($invite,$MailData);            
        }

        return response()->json(['success' => 'Invitee mail send successfully.']);
    }

    public function list()
    {
        $filterData = [];
        $filterData['searchValue'] = $this->request->search['value'];
        $filterData['length'] = $this->request->length;
        $filterData['start'] = $this->request->start;
        $filterData['sortable'] = isset($this->request->order['0']['column']) ? $this->request->order['0']['column'] : 0;
        $filterData['direction'] = isset($this->request->order['0']['dir']) ? $this->request->order['0']['dir'] : 'asc';
       
	    $result = Invite::getAlldata($filterData);
        $count = Invite::getAlldata($filterData, true);

        $response = array(
            "draw" => $this->request->draw,
            "recordsTotal" => count($result),
            "recordsFiltered" => $count
        );

        $responseArray = array();
        $actions = '';
        foreach ($result as $data) 
        {              
            $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$data->id."'>Delete</button>";
          
            $dataTemp = [
                "index" => $data->id,                                
				"email" => $data->email,
                "created_at" => $data->created_at,
                "action" => $deleteButton,

            ];
            $responseArray[] = $dataTemp;
        }
        $response['data'] = $responseArray;
        return json_encode($response);
    }

}
