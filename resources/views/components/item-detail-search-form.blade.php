<div x-data="recaptchaSearch(@this)" class="mb-3">
    <div class="input-group">
        <form wire:submit="search" class="d-flex w-100">

            <input
                class="form-control"
                wire:model.live="code"
                placeholder="Masukkan kode barang"
            >

            <button type="submit" class="btn btn-primary">
                Cari
            </button>
        </form>
    </div>

    @error('code')
        <div class="text-danger mt-2">{{ $message }}</div>
    @enderror
</div>