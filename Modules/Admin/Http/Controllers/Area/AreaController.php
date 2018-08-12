<?php

namespace Modules\Admin\Http\Controllers\Area;

use App\Repositories\Area\AreaRepository;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\BaseController;

class AreaController extends BaseController
{
    private $areas;

    public function __construct(AreaRepository $areas)
    {
        $this->areas = $areas;

    }


    /**
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Support\Collection
     */
    public function index(Request $request)
    {

    }

    public function getList(Request $request)
    {
        $parentId = $request->get('parent_id', 0);
        $areas = $this->areas->getAreas($parentId, ['id', 'name'],1);
        return $areas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
