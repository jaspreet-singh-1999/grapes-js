<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GrapesJS Editor</title>
        {{-- jquery for ajax --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
        <!-- Include GrapesJS JS library start-->
        <link href="{{ asset('grapes-js/css/grapes.min.css') }}" rel="stylesheet">
        <script src="{{ asset('grapes-js/grapes.min.js') }}"></script>
        
        {{-- include grapes-js-preset-webpage plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-preset-webpage.min.js')}}"></script>
        
        <link rel="stylesheet" href="{{ asset('grapes-js/css/grapesjs-preset-webpage.min.css') }}">

        {{-- include grapesjs-blocks-basic plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-blocks-basic.min.js')}}"></script>

        {{-- include grapesjs-plugin-forms library --}}
        <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-forms@2.0.6/dist/index.min.js"></script>

        {{-- include grapesjs countdown plugin library --}}
        <script src="https://cdn.jsdelivr.net/npm/grapesjs-component-countdown@1.0.2/dist/index.min.js"></script> 
        
        {{-- include grapesjs-tabs plugin library --}}
        <script src=" https://cdn.jsdelivr.net/npm/grapesjs-tabs@1.0.6/dist/grapesjs-tabs.min.js "></script>

        {{-- include grapesjs-tooltip plugin library --}}
        <script src="https://cdn.jsdelivr.net/npm/grapesjs-tooltip@0.1.8/dist/index.min.js
        "></script>

        {{-- include grapesjs-typed plugin library --}}
        <script src="https://cdn.jsdelivr.net/npm/grapesjs-typed@2.0.1/dist/index.min.js
        "></script>

        {{-- include grapesjs-custom-code plugin library --}}
        <script src="https://cdn.jsdelivr.net/npm/grapesjs-custom-code@1.0.2/dist/index.min.js
        "></script>
     
    </head>
    <body>
        <!-- GrapesJS Editor Container -->
        <div id="gjs"></div>
        <button id="saveButton" class=''>Save</button>
        <script>

            // Initialize GrapesJS
            var editor = grapesjs.init({
                container: '#gjs',
                components: '',
                width: 'auto',
                plugins: ['grapesjs-preset-webpage','gjs-blocks-basic','grapesjs-plugin-forms','grapesjs-component-countdown','grapesjs-tabs','grapesjs-tooltip','grapesjs-typed','grapesjs-custom-code'],
                pluginsOpts:{
                'grapesjs-preset-webpage': {},
                'gjs-blocks-basic': {},
                'grapesjs-plugin-forms': {},
                'grapesjs-component-countdown':{},
                'grapesjs-tabs': {},
                'grapesjs-tooltip': {},
                'grapesjs-typed': {},
                'grapesjs-custom-code': {}
                },
                storageManager: {  autoload: false },

            });

            editor.DomComponents.addType('Page-type', {
                model: {
                    defaults: {
                        tagName: 'select',
                        components: `
                            <option id="select"selected value="">Select Page type</option>
                            @foreach($pageTypes as $type)
                                <option value="{{$type->id}}">{{$type->page_type}}</option>
                            @endforeach
                        `,
                    },
                },
            });

            editor.DomComponents.addComponent({ type: 'Page-type'});
           
            $('#saveButton').on('click',function(e){
                let html= editor.getHtml() 
                let css= editor.getCss()
                let pageType_id= $('#select').val()
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('save_tempate_data') }}",
                    type: "POST",
                    data: {
                        pageType_id: pageType_id,
                        html:html,
                        css:css
                    },
                    success: function(response) {
                        if(response.success == true){

                            toastr.success(response.message)
                        }else{
                            toastr.error(response.message)
                        }
                    },
                    error: function(error) {
                        console.error('Error saving data:', error);
                    }
                });
            });
        </script>
    </body>
</html>