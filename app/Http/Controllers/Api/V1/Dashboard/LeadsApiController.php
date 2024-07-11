<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeadStoreRequest;
use App\Http\Resources\Dashboard\LeadResource;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Dashboard\BaseController;


class LeadsApiController extends BaseController
{


    public function index(){
        $query = Contact::orderBy('name')->orderBy('priority');
        $query->where('is_lead' , "yes");
        if ($search = request()->search)
            $query->where('name' , 'like' , "%$search%")
            ->orWhere('email' , 'like' , "$search%")
            ->orWhere('mobile' , 'like' , "%$search%")
            ->orWhere('country' , 'like' , "%$search%")
            ->orWhere('city' , 'like' , "%$search%")
            ->orWhere('preferred_languages' , 'like' , "%$search%")
            //->orWhere('campaign_id' , 'like' , "%$search%")
            ;
        if(auth()->user()->isAgent){
            $items = $query
            ->whereRelation('agents', 'id', auth()->user()->id)
            ->paginate(100)->appends([
                'search' => $search
            ]);
        }else{
            $items = $query->paginate(100)->appends([
                'search' => $search,
            ]);
        }
        
        return (new LeadResource($items))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    public function store(LeadStoreRequest $request)
    {
        $lead = Contact::create($request->all());

        $tagArray = $this->createTags($request->tags);
        $languages = $this->createTags($request->language_tags , 'languages');
        $lead = Contact::create($request->all());
        $lead->tags()->sync(array_merge($tagArray , $languages));
        $lead->agents()->sync($request->agents);

        $cities = $this->createCities($request->cities);
        $lead->cities()->sync($cities);

        if($request->content){
            $comment = Comment::create([
                'content'      => $request->content,
                'publish_date' => date('Y-m-d H:i:s'),
                'author'       => auth()->user()->id,
                'contact_id'   => $lead->id
            ]);
        }
        return (new LeadResource($lead))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
