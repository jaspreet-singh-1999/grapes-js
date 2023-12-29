<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
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
            .grid-wrapper > div {
                display: flex;
                flex-direction: column; 
                align-items: center;
                margin-bottom: 10px; 
            }
        
            .grid-wrapper > div > img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 5px;
            }
        
            .grid-wrapper > div > p {
                margin-top: 5px; 
            }
        
            .grid-wrapper {
                display: grid;
                grid-gap: 10px;
                grid-template-columns: repeat({{ $rowColumn['noOfColumn'] }}, 1fr); 
                grid-auto-flow: dense; 
            }
        </style>
    
    </head>
    <body>
        <div class="grid-wrapper">
            @foreach($pageDetail as $details)
                @php
                    $items = json_decode($details['field_data']);  
                @endphp
                <div>
                    <img src="{{ asset('storage/'.$items->image) }}" alt="" />
                    <p>Demo Text Demo Text Demo </p>
                    <p>Demo Text Demo Text Demo </p>
                    <p>Demo Text Demo Text Demo </p>
                    <p>Demo Text Demo Text Demo </p>
                    <h1>{{$items->model}}</h1>

                </div>
                <div>
                    <img src="{{ asset('storage/'.$items->image) }}" alt="" />
                    {{-- <p>Demo Text Demo Text Demo </p> --}}
                    <h3>{{$items->model}}</h3>
                </div>
            @endforeach     
        </div>
    </body>
</html>