 <div style="display: flex; gap: 10px; width: 100%; box-sizing: border-box; margin-top: 20px;">
        
        <a href="{{ route('items.scan-camera') }}"
           style="
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 10px 20px;
                background: #007BFF;
                color: white;
                text-decoration: none;
                border-radius: 4px;
           ">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M17 12v4a1 1 0 0 1-1 1h-4m5-14h2a2 2 0 0 1 2 2v2m-4 1V7m4 10v2a2 2 0 0 1-2 2h-2M3 7V5a2 2 0 0 1 2-2h2m0 14h.01M7 21H5a2 2 0 0 1-2-2v-2" />
                    <rect width="5" height="5" x="7" y="7" rx="1" />
                </g>
            </svg>
            &nbsp;Scan QR Lain
        </a>

        @if(auth()->check())

<a href="{{ url('/admin') }}"
   style="
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 20px;
        background: #343a40;
        color: white;
        text-decoration: none;
        border-radius: 4px;
   ">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="M9 14L4 9l5-5"/>
            <path d="M4 9h11a5 5 0 0 1 5 5v3"/>
        </g>
    </svg>
    &nbsp;Dashboard Admin
</a>

@endif
</div>