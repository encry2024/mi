<?php

namespace App\Http\Controllers\Backend\Inventory;

use App\Models\Inventory\Inventory;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Inventory\InventoryRepository;
use App\Http\Requests\Backend\Inventory\RestoreInventoryRequest;
use App\Http\Requests\Backend\Inventory\ForceDeleteInventoryRequest;
use App\Http\Requests\Backend\Inventory\ViewInventoryRequest;
use App\Events\Backend\Inventory\InventoryDeleted;

/**
 * Class InventoryStatusController.
 */
class InventoryStatusController extends Controller
{
    /**
     * @var InventoryRepository
     */
    protected $inventoryRepository;

    /**
     * @param InventoryRepository $inventoryRepository
     */
    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ViewInventoryRequest $request)
    {
        return view('backend.inventory.deleted')
            ->withInventories($this->inventoryRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param Inventory              $deletedInventory
     * @param ManageInventoryRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Inventory $deletedItem, ForceDeleteInventoryRequest $request)
    {
        $item = $this->inventoryRepository->forceDelete($deletedItem);

        return redirect()->route('admin.inventory.item.deleted')->withFlashSuccess(__('alerts.backend.inventories.deleted_permanently', ['item' => $item->name]));
    }

    /**
     * @param Inventory              $deletedItem
     * @param ManageInventoryRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(Inventory $deletedItem, RestoreInventoryRequest $request)
    {
        $item = $this->inventoryRepository->restore($deletedItem);

        return redirect()->route('admin.inventory.item.index')->withFlashSuccess(__('alerts.backend.inventories.restored', ['item' => $item->name]));
    }
}
