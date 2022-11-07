<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\TendersListRequest;
use App\Models\Tender;

final class TenderService
{
    function getItems(TendersListRequest $request)
    {
        $data = $request->validated();
        $perPage = $data['per_page'] ?? null;
        $tenders = new Tender();
        if (!empty($data['date'])) $tenders = $tenders->where('date', 'like', "%{$data['date']}%");
        if (!empty($data['name'])) $tenders = $tenders->where('name', 'like', "%{$data['name']}%");
        return $tenders->paginate($perPage);
    }
}
