<html>
    <head>
        <style>
            .grid-wrapper {
                display: grid;
                grid-template-columns: repeat({{ $rowColumn['noOfColumn'] }}, minmax(0, 1fr));
                gap: 10px;
               
            }
            .grid-wrapper img {
                width: 100%; 
                height: 150px; 
                /* object-fit: cover;  */
                object-fit: contain;
            }

        </style>
    </head>
    <body>
        <div class="grid-wrapper">
            @foreach($pageDetail as $details)
                @php
                    $items= json_decode($details['field_data']);  
                @endphp
                <img src="{{asset('storage/'.$items->image) }}" alt="">
            @endforeach
        </div>
    </body>
</html>