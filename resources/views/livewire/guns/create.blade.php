<div>
    @if (session()->has('message'))
        <div class="alert alert-success col-md-3 mx-auto mt-3 text-center">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('updated'))
        <div class="alert alert-warning col-md-3 mx-auto mt-3 text-center">
            {{ session('updated') }}
        </div>
    @endif

    @if (session()->has('deleted'))
        <div class="alert alert-danger col-md-3 mx-auto mt-3 text-center">
            {{ session('deleted') }}
        </div>
    @endif


    <div wire:ignore.self class="modal fade" id="addGun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addGunLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h1 class="modal-title fs-5" id="addGunLabel">Import New Gun</h1>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input wire:model="model" type="text" class="form-control" id="model">
                        <label for="model" class="form-label text-dark">Model</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select wire:model="type" class="form-select">
                            <option disabled>Weapon Type</option>
                            <option hidden></option>
                            <option value="Pistol">Pistol</option>
                            <option value="Sub-machine Gun">Sub-machine Gun</option>
                            <option value="Machine Gun">Machine Gun</option>
                            <option value="Shotgun">Shotgun</option>
                            <option value="Sawed-off Shotgun">Sawed-off Shotgun</option>
                            <option value="Rifle">Rifle</option>
                            <option value="Sniper Rifle">Sniper Rifle</option>
                            <option value="Assault Rifle">Assault Rifle</option>
                            <option value="Grenade Launcher">Grenade Launcher</option>
                            <option value="Minigun">Minigun</option>
                        </select>
                        <label for="type" class="form-label text-dark">Weapon Type</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select wire:model="caliber" class="form-select">
                            <option value="" disabled>Caliber</option>
                            <option hidden value=""></option>
                            <option value=".22 LR">.22 Lr</option>
                            <option value=".380 CP">.380 CP</option>
                            <option value="9mm">9mm</option>
                            <option value=".40 S&W">.40 S&W</option>
                            <option value=".45 ACP">.45 ACP</option>
                            <option value="10mm">10mm</option>
                            <option value="5.7 FN">5.7 FN</option>
                            <option value=".38 SPL">.38 SPL</option>
                            <option value=".357 MAG">.357 MAG</option>
                            <option value="5.56 / .233">5.56 / .233</option>
                        </select>
                        <label for="caliber" class="form-label text-dark">Caliber</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input wire:model="country" type="text" class="form-control" id="country">
                        <label for="country" class="form-label text-dark">Country</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="resetFields()" class="btn btn-dark" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                    <button wire:click.prevent="store()" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-circle-plus"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 mx-auto col-md-6">
        <div class="card-header bg-secondary">
            <h3 class="text-center">Gun List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped border-dark table-hover">
                <thead class="bg-dark text-secondary">
                    <tr>
                        <th>Model</th>
                        <th>Weapon Type</th>
                        <th class="text-center">Caliber</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">.....</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guns as $gn )
                        <tr>
                            <td>{{ $gn->model }}</td>
                            <td>{{ $gn->type }}</td>
                            <td class="text-center">{{ $gn->caliber }}</td>
                            <td class="text-center">{{ $gn->country }}</td>
                            <td class="text-center">
                                <button wire:click="edit({{ $gn->id }})" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editGun"><i class="fa-regular fa-pen-to-square"></i></button>
                                <button wire:click="deleteGun({{ $gn->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeGun"><i class="fa-solid fa-delete-left"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @error('editModel')<span class="text-danger">No changes saved. {{ $message }}</span>@enderror
                @error('editType')<span class="text-danger">No changes saved. {{ $message }}</span>@enderror
                @error('editCaliber')<span class="text-danger">No changes saved. {{ $message }}</span>@enderror
                @error('editCountry')<span class="text-danger">No changes saved. {{ $message }}</span>@enderror
            </table>
            <button type="submit" class="btn btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#addGun"><i class="fa-regular fa-square-plus"></i> Gun</button>
            <div class="col-md-8 mx-auto">
                @error('model')<span class="text-danger">{{ $message }}</span>@enderror
                @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                @error('caliber')<span class="text-danger">{{ $message }}</span>@enderror
                @error('country')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editGun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editGunLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-secondary">
              <h1 class="modal-title fs-5" id="editGunLabel">Gun details</h1>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input wire:model="editModel" type="text" class="form-control" id="model">
                    <label for="model" class="form-label text-dark">Model</label>
                </div>
                <div class="form-floating mb-3">
                    <select wire:model="editType" class="form-select">
                        <option value="Pistol">Pistol</option>
                        <option value="Sub-machine Gun">Sub-machine Gun</option>
                        <option value="Machine Gun">Machine Gun</option>
                        <option value="Shotgun">Shotgun</option>
                        <option value="Sawed-off Shotgun">Sawed-off Shotgun</option>
                        <option value="Rifle">Rifle</option>
                        <option value="Sniper Rifle">Sniper Rifle</option>
                        <option value="Assault Rifle">Assault Rifle</option>
                        <option value="Grenade Launcher">Grenade Launcher</option>
                        <option value="Minigun">Minigun</option>
                    </select>
                    <label for="type" class="form-label text-dark">Weapon Type</label>
                </div>
                <div class="form-floating mb-3">
                    <select wire:model="editCaliber" class="form-select">
                        <option value=".22 LR">.22 LR</option>
                        <option value=".380 CP">.380 CP</option>
                        <option value="9mm">9mm</option>
                        <option value=".40 S&W">.40 S&W</option>
                        <option value=".45 ACP">.45 ACP</option>
                        <option value="10mm">10mm</option>
                        <option value="5.7 FN">5.7 FN</option>
                        <option value=".38 SPL">.38 SPL</option>
                        <option value=".357 MAG">.357 MAG</option>
                        <option value="5.56 / .233">5.56 / .233</option>
                    </select>
                    <label for="caliber" class="form-label text-dark">Caliber</label>
                </div>
                <div class="form-floating mb-3">
                    <input wire:model="editCountry" type="text" class="form-control" id="country">
                    <label for="country" class="form-label text-dark">Country</label>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-eject"></i></button>
              <button wire:click.prevent="update()" type="button" class="btn btn-warning" data-bs-dismiss="modal"><i class="fa-solid fa-floppy-disk"></i></button>
            </div>
          </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="removeGun" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="removeGunLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h6 class="modal-title fs-5" id="removeGunLabel">Removal confirmation</h6>
                </div>
                <div class="modal-body text-center">
                    <h6>Are you sure you want to remove this gun from the list?</h6>
                    <p>Model</p>
                    <input type="text" wire:model="deleteModel" class="col-md-2 float-center text-center" readonly>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-eject"></i></button>
                    <button wire:click="destroy()" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
