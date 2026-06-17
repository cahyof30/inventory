<x-item-detail-style />

<div class="card-wrapper">

    <x-search-item />

    @if($item)

        <div class="card">

            <x-item-detail-header
                :item="$item" />

            <x-item-detail-public-information
                :item="$item" />

            <x-item-detail-confidential-information
                :item="$item" />

            <x-item-detail-action-button
                :item="$item" />

        </div>

    @endif

</div>

<x-item-detail-scripts />