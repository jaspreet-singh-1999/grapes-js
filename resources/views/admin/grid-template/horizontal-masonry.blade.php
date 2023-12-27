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
    .grid-wrapper {
      display: grid;
      grid-gap: 10px;
      grid-template-columns: repeat(5, 1fr);
    }
    .grid-wrapper > div {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 200px;
    }
    .grid-wrapper > div > img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
  
  <div class="grid-wrapper">
    @forEach($pageDetail as $details)
        @php
            $filedData= json_decode($details['field_data']);   
        @endphp
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
    
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}}" alt="" />
        </div>
        <div>
            <img src="{{asset($filedData->image)}} " alt="" />
        </div>
    @endforeach
  </div>