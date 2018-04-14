<?php

namespace App\Models\Inventory\Traits\Attribute;

/**
 * Trait InventoryAttribute.
 */
trait InventoryAttribute
{
    /**
     * @return string
     */
    public function getRequestButtonAttribute()
    {
        return 
        '<a class="btn btn-dark text-white"
            onclick="requestItem('.$this->id.',\''.$this->size_quantity . ' ' . $this->size->type.'\', '.'\''.$this->name.'\')" data-toggle="modal" data-target="#request-item-modal">
            <i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Pull-Out"></i>
        </a>';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.inventory.item.show', $this).'" class="btn btn-info text-white"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can('edit item'))
            return '<a href="'.route('admin.inventory.item.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (auth()->user()->can('delete item')) {
            return '<a href="'.route('admin.inventory.item.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                 class="btn btn-danger text-white"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        if (auth()->user()->can('delete item')) {
            return '<a href="' . route('admin.inventory.item.delete-permanently', $this) . '" 
            data-trans-button-cancel="Cancel"
            data-trans-button-confirm="Yes, Delete Permanently"
            data-trans-title="Are you sure you want to delete this item permanently?"
            name="confirm_item" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        if (auth()->user()->can('restore item'))
            return '<a href="'.route('admin.inventory.item.restore', $this).'" 
            data-trans-button-cancel="Cancel"
            data-trans-button-confirm="Yes, Restore"
            data-trans-title="Are you sure you want to restore this item?"
        name="confirm_item" class="btn btn-info text-white"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Inventory"></i></a> ';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Inventory Actions">
                  '.$this->restore_button.'
                  '.$this->delete_permanently_button.'
                </div>';
        }

        return '
            <div class="btn-group btn-group-sm" role="group" aria-label="Inventory Actions">
            '.$this->request_button.'
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->delete_button.'
            </div>';
    }
}
