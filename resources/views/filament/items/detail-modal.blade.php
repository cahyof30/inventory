{{-- resources/views/filament/items/detail-modal.blade.php --}}

<style>
.asset-detail {
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
}

.asset-detail__header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.asset-detail__logo {
    display: block;
    max-width: 180px;
    width: 100%;
    height: auto;
    margin: 0 auto 1rem;
}

.asset-detail__image {
    display: block;
    max-width: 320px;
    width: 100%;
    height: auto;
    margin: 0 auto 1rem;
    border-radius: 8px;
}

.asset-detail__title {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}

.asset-detail__table {
    width: 100%;
    border-collapse: collapse;
}

.asset-detail__table tr {
    border-bottom: 1px solid #e5e7eb;
}

.asset-detail__table td {
    padding: .75rem 0;
    vertical-align: top;
}

.asset-detail__label {
    width: 180px;
    font-weight: 600;
    white-space: nowrap;
}

.asset-detail__value {
    word-break: break-word;
}

.asset-detail__status {
    display: inline-flex;
    align-items: center;
    padding: .25rem .75rem;
    border-radius: 999px;
    font-size: .875rem;
    font-weight: 600;
}

.asset-detail__status--verified {
    background: #dcfce7;
    color: #166534;
}

@media (max-width: 640px) {
    .asset-detail__label {
        width: 120px;
    }

    .asset-detail__title {
        font-size: 1.25rem;
    }

    .asset-detail__logo {
        max-width: 140px;
    }

    .asset-detail__image {
        max-width: 220px;
    }
}
</style>

<div class="asset-detail">

    <div class="asset-detail__header">

        @if($record->company?->logo)
            <img
                src="{{ asset('storage/' . $record->company->logo) }}"
                alt="{{ $record->company->company_name }}"
                class="asset-detail__logo"
            >
        @endif

        <img
            src="{{ $record->image
                ? asset('storage/' . $record->image)
                : asset('assets/no_picture.png') }}"
            alt="{{ $record->name }}"
            class="asset-detail__image"
        >

        <h2 class="asset-detail__title">
            Informasi Aset SGM Group
        </h2>

    </div>

    <table class="asset-detail__table">
        <tbody>
            <tr>
                <td class="asset-detail__label">Kode Barang</td>
                <td class="asset-detail__value">{{ $record->code }}</td>
            </tr>

            <tr>
                <td class="asset-detail__label">Nama Barang</td>
                <td class="asset-detail__value">{{ $record->name }}</td>
            </tr>

            <tr>
                <td class="asset-detail__label">Perusahaan</td>
                <td class="asset-detail__value">
                    {{ $record->company?->company_name ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="asset-detail__label">Lokasi</td>
                <td class="asset-detail__value">
                    {{ $record->location?->name ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="asset-detail__label">Status</td>
                <td class="asset-detail__value">
                    <span class="asset-detail__status asset-detail__status--verified">
                        Verified
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

</div>