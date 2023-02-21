<?php

namespace App\Http\Livewire\Guns;

use App\Models\Gun;
use Livewire\Component;

class Create extends Component
{
    public $model, $type, $caliber, $country, $guns, $gunID;
    public $editModel, $editType, $editCaliber, $editCountry;
    public $deleteModel;

    public function resetFields() {
        $this->model    = '';
        $this->type     = '';
        $this->caliber  = '';
        $this->country  = '';
    }

    public function store() {
        $validatedDate = $this->validate([
            'model'     => 'required',
            'type'      => 'required',
            'caliber'   => 'required',
            'country'   => 'required'
        ]);

        Gun::create($validatedDate);

        session()->flash('message', 'Gun added to the list.');

        $this->resetFields();
    }

    public function edit($id) {
        $gun = Gun::findOrFail($id);
        $this->gunID        = $id;
        $this->editModel    = $gun->model;
        $this->editType     = $gun->type;
        $this->editCaliber  = $gun->caliber;
        $this->editCountry  = $gun->country;
    }

    public function deleteGun($id) {
        $gun = Gun::findOrFail($id);
        $this->gunID        = $id;
        $this->deleteModel  = $gun->model;
    }

    public function update() {
        $this->validate([
            'editModel'     => 'required',
            'editType'      => 'required',
            'editCaliber'   => 'required',
            'editCountry'   => 'required'
        ]);

        $gun = Gun::find($this->gunID);
        $gun->update([
            'model'     => $this->editModel,
            'type'      => $this->editType,
            'caliber'   => $this->editCaliber,
            'country'   => $this->editCountry
        ]);

        session()->flash('updated', 'Gun details updated.');
        $this->resetFields();
    }

    public function destroy() {
        $gun = Gun::find($this->gunID);
        $gun->delete();
        session()->flash('deleted', 'Gun removed from list.');
    }

    public function render()
    {
        $this->guns= Gun::all();
        return view('livewire.guns.create');
    }

    public $listeners = ['removeGun'=>'destroy'];
}
