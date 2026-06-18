<div
    x-data="recaptchaSearch(@this)"
    class="mb-3"
>
    <div class="input-group">

        <input
            class="form-control"
            wire:model.live="code"
            placeholder="Masukkan kode barang"
        >

       <button
    type="button"
    class="btn btn-primary"
    wire:click="search"
>
    Cari
</button>

    </div>

    @error('code')
        <div class="text-danger mt-2">{{ $message }}</div>
    @enderror

</div>