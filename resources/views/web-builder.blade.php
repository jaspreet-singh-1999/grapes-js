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
        <script src="{{asset('grapes-js/grapesjs-plugin-forms.js')}}"></script>
        
        {{-- include grapesjs countdown plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-component-countdown.js')}}"></script>
        
        {{-- include grapesjs-tabs plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-tabs.js')}}"></script>
        
        {{-- include grapesjs-tooltip plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-tooltip.js')}}"></script>

        {{-- include grapesjs-typed plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-typed.js')}}"></script>

        {{-- include grapesjs-custom-code plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-custom-code.js')}}"></script>

        {{-- include grapesjs-ckeditor plugin library --}}
        <script src="{{asset('grapes-js/grapesjs-plugin-ckeditor.js')}}"></script>
     
    </head>
    <body>
        <!-- GrapesJS Editor Container -->
        <div id="gjs"></div>
        <button id="saveButton" class=''>Save</button>
        <script>
            let html = `{!!html_entity_decode($html)!!}`;
            let css = `{{$css}}`;
 
            // Initialize GrapesJS
            let editor = grapesjs.init({
                container: '#gjs',
                components: '',
                width: 'auto',
                plugins: ['grapesjs-preset-webpage','gjs-blocks-basic','grapesjs-plugin-forms','grapesjs-component-countdown','grapesjs-tabs','grapesjs-tooltip','grapesjs-typed','grapesjs-custom-code','custom-plugin','dropdownOptionPlugin'],
                storageManager: {  autoload: false },
    
            });

            //Set web-page html & css 
            editor.setComponents(html);
            editor.setStyle(css);

            $('#saveButton').on('click',function(e){
                let html= editor.getHtml()
                let css= editor.getCss()
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('save-page-data') }}",
                    type: "POST",
                    data: {
                        id: {{$id}},
                        html:html,
                        css:css
                    },
                    success: function(response) {
                        if(response.success == true){
                            window.location.href= "{{route('pages-list')}}"
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