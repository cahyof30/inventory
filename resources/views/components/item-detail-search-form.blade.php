<div
    x-data="searchItem($wire)"
    class="mb-3">

    <div class="input-group">

        <input
            class="form-control"
            wire:model.defer="code"
            placeholder="Masukkan kode barang">

        <button
            type="button"
            class="btn btn-primary"
            x-on:click="search()">

            Cari

        </button>

    </div>

    @error('code')

        <div class="text-danger mt-2">

            {{ $message }}

        </div>

    @enderror

</div>