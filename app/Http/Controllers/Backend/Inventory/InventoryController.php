<?php

namespace App\Http\Controllers\Backend\Inventory;

# Facades
use Illuminate\Http\Request;
# Controllers
use App\Http\Controllers\Controller;
# Models
use App\Models\Inventory\Inventory;
use App\Models\Inventory\Size;
use Auth;
# Repositories
use App\Repositories\Backend\Inventory\InventoryRepository;
# Requests
use App\Http\Requests\Backend\Inventory\ViewInventoryRequest;
use App\Http\Requests\Backend\Inventory\CreateInventoryRequest;
use App\Http\Requests\Backend\Inventory\StoreInventoryRequest;
use App\Http\Requests\Backend\Inventory\EditInventoryRequest;
use App\Http\Requests\Backend\Inventory\UpdateInventoryRequest;
use App\Http\Requests\Backend\Inventory\DeleteInventoryRequest;
use App\Events\Backend\Inventory\InventoryDeleted;

class InventoryController extends Controller
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
    public function index(ViewInventoryRequest $request)
    {
        return view('backend.inventory.index')->withInventories(
            $this->inventoryRepository->getInventoryPaginated()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateInventoryRequest $request)
    {
        return view('backend.inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventoryRequest $request)
    {
        $item = $this->inventoryRepository->create($request->only(
            'name',
            'description',
            'quantity',
            'size_quantity',
            'price'
        ));

        return redirect()->route('admin.inventory.item.index')->withFlashSuccess(__('alerts.backend.inventories.created', ['item' => $item->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $item, ViewInventoryRequest $request)
    {
        return view('backend.inventory.show')->withModel($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $item, EditInventoryRequest $request)
    {
        $sizes = Size::all();

        return view('backend.inventory.edit')->withItem($item)->withSizes($sizes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request, Inventory $item)
    {
        $item = $this->inventoryRepository->update($item, $request->only(
            'name',
            'description',
            'size_quantity',
            'quantity',
            'price'
        ));

        return redirect()->back()->withFlashSuccess('You have successully updated Item "'.$item->name.'"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $item, DeleteInventoryRequest $request)
    {
        $this->inventoryRepository->deleteById($item->id);

        $auth_link = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
        $asset_link = "<a href='".route('admin.inventory.item.show', $item->id)."'>".$item->name.'</a>';

        event(new InventoryDeleted($auth_link, $asset_link));

        return redirect()->back()->withFlashSuccess(__('alerts.backend.inventories.deleted', ['item' => $item->name]));
    }

    public function request(Inventory $item, CreateInventoryRequest $request)
    {
        $request_item = $this->inventoryRepository->requestItem($item, $request->only(
            'request_stock',
            'requested_by'
        ));

        return redirect()->back()->withFlashSuccess('You have pulled out "'.$request_item->quantity . '" quantity of Item "'.$item->name.' - '.$item->size_quantity.' pc(s)" for "'.$request_item->requested_by.'"');
    }
}
