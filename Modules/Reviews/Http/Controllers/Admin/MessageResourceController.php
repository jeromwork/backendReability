<?php

namespace Modules\Reviews\Http\Controllers\Admin;

use App\Http\Requests\ApiDataTableRequest;
use App\Http\Resources\ApiCollectionResource;
use App\Services\ApiRequestHandlers\QueryBuilderHandleApiDataTableService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reviews\Entities\Review;
use Modules\Reviews\Entities\ReviewMessage;
use Modules\Reviews\Http\Requests\Admin\Messages\StoreRequest;
use Modules\Reviews\Http\Services\Target;

class MessageResourceController extends Controller
{

    private QueryBuilderHandleApiDataTableService $QueryBuilderByRequest;
    private Target $targetModel;

    public function __construct(QueryBuilderHandleApiDataTableService $apiHandler, Target $targetEntity)    {
        $this->QueryBuilderByRequest = $apiHandler;
        $this->targetModel = $targetEntity;
    }

    /**
     * Display a listing of the resource.
     * @param ApiDataTableRequest $request
     */
    public function index(ApiDataTableRequest $request)
    {
        $messages = ReviewMessage::query();

        $messages = $this->QueryBuilderByRequest->build( $messages, $request );
        $messages->with('content');

        //necessarily models to collection must get with pagination data:  collection($model->paginate())
        //ReviewResource
        return response()->apiCollection( ApiCollectionResource::collection($messages->paginate()) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $requestData = $request->validated();
        $message = new ReviewMessage($requestData);
        if(!$requestData['review_id'] ){
            return response()->error('Not set review_id.', 400);
        }
        if(!Review::where('id', $requestData['review_id'])->first()){
            return response()->error('Not found target review', 400);
        }

        $message->save();

        return response()->okMessage('Save new message.', 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}