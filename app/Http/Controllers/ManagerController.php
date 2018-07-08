<?php

namespace App\Http\Controllers;

use App\UserRequest;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Отоброжаем список заявок пользователей
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [];

        //если получили не пустой массив то добавляем запросы
        if (count($requests = UserRequest::getAllProcessing())) {
            //в этот массив кладем не обработанные запросы
            $data['requests_processing'] = $requests;
        }

        //если получили не пустой массив то добавляем запросы
        if (count($requests = UserRequest::getAllProcessed())) {
            //в этот массив кладем обработанные запросы
            $data['requests_processed'] = $requests;
        }

        return view('manager.index', $data);
    }

    /**
     * Обновляем статус заявки и редиректим на список заявок
     *
     * @param $request_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($request_id)
    {
        UserRequest::updateRequest($request_id);
        return redirect()->route('manager.index');
    }
}
