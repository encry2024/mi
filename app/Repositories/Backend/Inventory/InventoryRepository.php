<?php

namespace App\Repositories\Backend\Inventory;

use App\Models\Inventory\Inventory;
use App\Models\Request\Request;
use App\Models\Inventory\Size;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use App\Events\Backend\Inventory\InventoryCreated;
use App\Events\Backend\Inventory\InventoryUpdated;
use App\Events\Backend\Inventory\InventoryRestored;
use App\Events\Backend\Inventory\InventoryPermanentlyDeleted;
use App\Events\Backend\Size\SizeCreated;
use App\Events\Backend\Size\SizeUpdated;
use App\Events\Backend\Size\SizeRestored;
use App\Events\Backend\Size\SizePermanentlyDeleted;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class InventoryRepository.
 */
class InventoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Inventory::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getInventoryPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Inventory
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Inventory
    {
        return DB::transaction(function () use ($data) {
            $item = parent::create([
                'name'          => $data['name'],
                'description'   => $data['description'],
                'quantity'      => $data['quantity'] ? $data['quantity'] : '0',
                'size_quantity' => $data['quantity'] ? $data['quantity'] : '0',
                'price'         => $data['price'] ? $data['price'] : '0.00'
            ]);

            if ($item) {
                $auth_link  = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.inventory.item.show', $item->id)."'>".$item->name.'</a>';

                event(new InventoryCreated($auth_link, $asset_link));

                return $item;
            }

            throw new GeneralException(__('exceptions.backend.inventories.create_error'));
        });
    }

    /**
     * @param Inventory  $item
     * @param array $data
     *
     * @return Inventory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Inventory $item, array $data) : Inventory
    {
        return DB::transaction(function () use ($item, $data) {
            if ($item->update([
                'name'          => $data['name'],
                'description'   => $data['description'],
                'quantity'      => $data['quantity'] ? $data['quantity'] : '0',
                'price'         => $data['price'] ? $data['price'] : '0.00'
            ]))

            {
                $auth_link  = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.inventory.item.show', $item->id)."'>".$item->name.'</a>';

                event(new InventoryUpdated($auth_link, $asset_link));

                return $item;
            }

            throw new GeneralException(__('exceptions.backend.inventories.update_error', ['item' => $item->name]));
        });
    }

    /**
     * @param Inventory $item
     *
     * @return Inventory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Inventory $item) : Inventory
    {
        if (is_null($item->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.delete_first'));
        }

        return DB::transaction(function () use ($item) {
            // Delete associated relationships
            $item->delete();

            if ($item->forceDelete()) {
                $auth_link  = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
                $asset_link = "<a href='".route('admin.inventory.item.show', $item->id)."'>".$item->name.'</a>';

                event(new InventoryPermanentlyDeleted($auth_link, $asset_link));

                return $item;
            }

            throw new GeneralException(__('exceptions.backend.inventories.delete_error'));
        });
    }

    /**
     * @param Inventory $item
     *
     * @return Inventory
     * @throws GeneralException
     */
    public function restore(Inventory $item) : Inventory
    {
        if (is_null($item->deleted_at)) {
            throw new GeneralException(__('exceptions.backend.inventories.cant_restore'));
        }

        if ($item->restore()) {
            $auth_link  = "<a href='".route('admin.auth.user.show', auth()->id())."'>".Auth::user()->full_name.'</a>';
            $asset_link = "<a href='".route('admin.inventory.item.show', $item->id)."'>".$item->name.'</a>';

            event(new InventoryRestored($auth_link, $asset_link));

            return $item;
        }

        throw new GeneralException(__('exceptions.backend.inventories.restore_error'));
    }

    // public function updateSize(Size $size, $data) : Size
    // {
    //    return DB::transaction(function () use ($size, $data) {
    //         if ($size->update([
    //             'type'   => $data['type'],
    //             'name'   => $data['name'],
    //         ]))

    //         {
    //             $auth_link  = '<a href="'.route('admin.auth.user.show', auth()->id()).'">'.Auth::user()->full_name.'</a>';
    //             $asset_link = $size->name;

    //             event(new SizeUpdated($auth_link, $asset_link));

    //             return $size;
    //         }

    //         throw new GeneralException(__('exceptions.backend.inventories.sizes.update_error'));
    //     });
    // }

    // public function deleteSize(Size $size, $data) : Size
    // {
    //    return DB::transaction(function () use ($size, $data) {
    //         if ($size->update([
    //             'type'   => $data['type'],
    //             'name'   => $data['name'],
    //         ]))

    //         {
    //             $auth_link  = '<a href="'.route('admin.auth.user.show', auth()->id()).'">'.Auth::user()->full_name.'</a>';
    //             $asset_link = $size->name;

    //             event(new SizeUpdated($auth_link, $asset_link));

    //             return $size;
    //         }

    //         throw new GeneralException(__('exceptions.backend.inventories.sizes.update_error'));
    //     });
    // }

    public function requestItem(Inventory $item, $data) : Request
    {
        return DB::transaction(function () use ($item, $data) {
            $remaining_quantity = $item->quantity - $data['request_stock'];

            if ($item->update([
                'quantity'  => $remaining_quantity
            ]))

            {
                $request_item                   = new Request();
                $request_item->user_id          = Auth::user()->id;
                $request_item->inventory_id     = $item->id;
                $request_item->date_requested   = date('Y-m-d');
                $request_item->quantity         = $data['request_stock'];
                $request_item->requested_by     = $data['requested_by'];

                if ($request_item->save()) {
                    return $request_item;
                }
            }

            throw new GeneralException('Request item failed');
        });
    }
}
