<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluation;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $repository;

    public function __construct(Evaluation $model)
    {
        $this->repository = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($company)
    {
        $evaluations = $this->repository->where('company', $company)->get();
        
        return EvaluationResource::collection($evaluations);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluation $request, $company)
    {
        // $response = $this->companyService->getCompany($company);
        // $status = $response->status();
        // if ($status != 200) {
        //     return response()->json([
        //         'message' => 'Invalid Company'
        //     ], $status);
        // }
        // $company = json_decode($response->body());

        $evaluation = $this->repository->create($request->validated());

        // EvaluationCreated::dispatch($company->data->email)->onQueue('queue_email');

        return new EvaluationResource($evaluation);
    }
}
