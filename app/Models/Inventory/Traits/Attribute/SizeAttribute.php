<?php

namespace App\Models\Inventory\Traits\Attribute;

/**
 * Trait SizeAttribute.
 */
trait SizeAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (auth()->user()->can('update size'))
            return '<a href="#" class="btn btn-primary" 
                    data-toggle="modal" data-target="#edit-size-modal"
                    onclick="getSize('.$this->id.',\''.$this->type.'\', \''.$this->name.'\')"
                    >
                    <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i>
                    </a>';
        else
            return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (auth()->user()->can('delete size')) {
            return '<a href="'.route('admin.inventory.item.size.destroy', $this).'"
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
        if (auth()->user()->can('force delete size')) {
            return '<a href="' . route('admin.inventory.item.size.delete-permanently', $this) . '" 
            data-trans-button-cancel="Cancel"
            data-trans-button-confirm="Yes, Delete Permanently"
            data-trans-title="Are you sure you want to delete this item size permanently?"
            name="confirm_item" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        if (auth()->user()->can('restore size'))
            return '<a href="'.route('admin.inventory.item.size.restore', $this).'" 
            data-trans-button-cancel="Cancel"
            data-trans-button-confirm="Yes, Restore"
            data-trans-title="Are you sure you want to restore this item?"
        name="confirm_item" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Inventory Size"></i></a> ';
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
                <div class="btn-group btn-group-sm" role="group" aria-label="Inventory Size Actions">
                  '.$this->restore_button.'
                  '.$this->delete_permanently_button.'
                </div>';
        }

        return '
            <div class="btn-group btn-group-sm" role="group" aria-label="Inventory Size Actions">
            '.$this->edit_button.'
            '.$this->delete_button.'
            </div>';
    }
}
