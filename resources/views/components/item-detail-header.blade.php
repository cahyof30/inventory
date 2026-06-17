<div class="title text-center">

    <img
        src="{{ asset('storage/'.$item->company?->logo) }}"
        style="height:100px;">

</div>

<div class="title text-center">

    <img
        src="{{ $item->image
            ? asset('storage/'.$item->image)
            : asset('assets/no_picture.png') }}"
        style="height:300px;">

</div>

<div class="title">

    Informasi Aset SGM Group

</div>