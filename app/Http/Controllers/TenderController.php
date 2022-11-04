<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTenderRequest;
use App\Models\Tender;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $perPage = request()->all()['per_page'] ?? null;
            return response()->json(Tender::paginate($perPage));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        $msg = Response::$statusTexts[$code];

        return response()->json(['errors' => [$msg]], $code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTenderRequest $request
     * @return JsonResponse
     */
    public function store(StoreTenderRequest $request)
    {
        try {
            $data = $request->validated();

            // если клиент не отправил поле date - ставим текущие дату и время
            $data['date'] = empty($data['date']) ? date('Y-m-d H:i:s') : $data['date'];

            return response()->json(Tender::create($data));
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            $code = Response::HTTP_BAD_REQUEST;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        $msg = Response::$statusTexts[$code];

        return response()->json(['errors' => [$msg]], $code);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id)
    {
        try {
            return response()->json(Tender::findOrFail($id));
        } catch (ModelNotFoundException) {
            $code = Response::HTTP_NOT_FOUND;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        $msg = Response::$statusTexts[$code];

        return response()->json(['errors' => [$msg]], $code);
    }
}
