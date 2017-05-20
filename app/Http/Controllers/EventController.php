<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

//use App\Http\Requests;
use EllipseSynergie\ApiResponse\Contracts\Response;
use App\Transformer\EventTransformer;

class EventController extends Controller
{

    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(10);
        return $this->response->withPaginator($events, new  EventTransformer());
    }


    public function show(Event $event)
    {
        //$event = Event::find($id);
        if (!$event) {
            return $this->response->errorNotFound('Event Not Found');
        }
        return $this->response->withItem($event, new  EventTransformer());
    }
    
    public function store(Request $request)
    {
        if ($request->isMethod('put')) {
            $event = Event::find($request->id);
            if (!$event) {
                return $this->response->errorNotFound('Event Not Found');
            }
        } else {
            $event = new Event;
        }
 
        //$event->id = $request->input('id');
        $event->user_id =  1; //$request->user()->id;
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->location = $request->input('location');
        $event->start  = $request->input('start');
        $event->end  = $request->input('end');        
 
        if($event->save()) {
            return $this->response->withItem($event, new  EventTransformer());
        } else {
             return $this->response->errorInternalError('Could not updated/created a event');
        }
    }


    public function destroy(Event $event)
    {
        if (!$event) {
            return $this->response->errorNotFound('Event Not Found');
        }
        if($event->delete()) {
             return $this->response->withItem($event, new  EventTransformer());
        } else {
            return $this->response->errorInternalError('Could not delete a event');
        }
    }
}
