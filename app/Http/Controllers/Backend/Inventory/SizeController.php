<?php

namespace App\Http\Controllers\Backend\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Size;
use App\Repositories\Backend\Inventory\InventoryRepository;
use App\Http\Requests\Backend\Size\UpdateSizeRequest;
use App\Http\Requests\Backend\Size\StoreSizeRequest;
use App\Http\Requests\Backend\Size\ViewSizeRequest;
use App\Events\Backend\Size\SizeDeleted;
use Auth;

class SizeController extends Controller
{
    protected $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ViewSizeRequest $request)
    {
        $sizes = Size::all();

        return view('backend.inventory.size.index')->withSizes($sizes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSizeRequest $request)
    {
        $size = $this->inventoryRepository->createSize($request->only('type', 'name'));

        return redirect()->route('admin.inventory.item.size.index')->withFlashSuccess('You have successfully created Inventory Size "'.$size->name.'".');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Size $size, UpdateSizeRequest $request)
    {
        $size = $this->inventoryRepository->updateSize($size, $request->only(
            'type',
            'name'
        ));

        return redirect()->route('admin.inventory.item.size.index')->withFlashSuccess('You have successfully updated InventorySize "'.$size->name.'".');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size_name = $size->name;

        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.inventory.item.size.show', $size->id)."'>".$size->name.'</a>';

        $size = $size->delete();

        event(new SizeDeleted($auth_link, $asset_link));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.inventories.sizes.deleted', ['size' => $size_name]));
    }
}
