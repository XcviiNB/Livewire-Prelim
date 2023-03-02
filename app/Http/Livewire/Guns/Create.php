<?php

namespace App\Http\Livewire\Guns;

use App\Models\Gun;
use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{
    public $model, $type, $caliber, $country, $gunID, $gunSearch;
    public $editModel, $editType, $editCaliber, $editCountry;
    public $deleteModel, $deleteType, $deleteCaliber, $deleteCountry;
    public $sortGun = 'all', $sortCaliber = 'all';
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

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
        $this->gunID            = $id;
        $this->deleteModel      = $gun->model;
        $this->deleteType       = $gun->type;
        $this->deleteCaliber    = $gun->caliber;
        $this->deleteCountry    = $gun->country;
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

    public function sortGuns() {
        $query = Gun::orderBy('model')->search($this->gunSearch);
        if ($this->sortGun != 'all') {
            $query->where('type', $this->sortGun);
        }

        if ($this->sortCaliber != 'all') {
            $query->where('caliber', $this->sortCaliber);
        }

        $guns = $query->paginate(9);
        return compact('guns');

    }

    public function render()
    {


        return view('livewire.guns.create', $this->sortGuns());
    }

    public $listeners = ['removeGun'=>'destroy'];
}
