<style>
    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    html,
    body {
        
        padding: 15px;
    }
    img {
        max-width: 100%;
        height: auto;
        vertical-align: middle;
        display: inline-block;
    }

    /* Main CSS */
    .grid-wrapper > div {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .grid-wrapper > div > img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }

    .grid-wrapper {
        display: grid;
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        grid-auto-rows: 200px;
        grid-auto-flow: dense;
    }
    .grid-wrapper .wide {
        grid-column: span 2;
    }
    .grid-wrapper .tall {
        grid-row: span 2;
    }
    .grid-wrapper .big {
        grid-column: span 2;
        grid-row: span 2;
    }
</style>

<div class="grid-wrapper">
    @forEach($pageDetail as $details)
        @php
            $items= json_decode($details['field_data']);  
        @endphp
        <div>
            <img src="{{ asset('storage/'.$items->image) }}" alt="" />
        </div>
       
        <div class="wide">
            <img src="{{ asset('storage/'.$items->image) }}" alt="" />
        </div>
    @endforeach     
</div>