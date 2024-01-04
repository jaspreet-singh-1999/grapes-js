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
        <button id="load" class=''>Load </button>
        <script>
            let pageTypeOptions= @json($option);

            // Initialize GrapesJS
            let editor = grapesjs.init({
                container: '#gjs',
                width: 'auto',
                plugins: ['grapesjs-preset-webpage','gjs-blocks-basic','grapesjs-plugin-forms','grapesjs-component-countdown','grapesjs-tabs','grapesjs-tooltip','grapesjs-typed','grapesjs-custom-code','myPlugin','grapesjs-plugin-ckeditor'],
                storageManager: {  autoload: false },
            }); 

            function myPlugin(editor) {
                editor.Blocks.add('my-first-block', {
                    type: 'grid',
                    label: 'Select Grid',
                    content: `<div class="grid-wrapper" id="grid"> Grid </div>`,  
                });
            }

            editor.on('component:selected', (component) => {
                let getType = component.getClasses();
                if(getType == 'grid-wrapper'){
                    const traitOptions = [
                        {
                            type: 'number',
                            label: 'Columns',
                            name: 'columns',
                            value: '',
                        },

                        // {
                        //     type: 'select',
                        //     id: 'pageType',
                        //     label: 'PageType',
                        //     name: 'pageType',
                        //     options: [

                        //         { id: 'select', name: 'select', value: '0'},
                        //         { id: 'cars', name: 'cars', value: '1'},
                        //         { id: 'blog', name: 'blog', value: '2'},
                        //         { id: 'news', name: 'news', value: '3'},
                        //     ]
                        // },

                        {
                            type: 'select',
                            id: 'pageType',
                            label: 'PageType',
                            name: 'pageType',
                            options: pageTypeOptions.map(options => ({
                                name:options.page_type,
                                value:options.id
                            }))
                        },

                        {
                            type: 'number',
                            label:'Post Count',
                            name: 'postCount',
                            value: '',
                        },
                        
                        {
                            type: 'checkbox',
                            id: 'recent',
                            label: 'Recent Post',
                            name: 'recent',
                            placeholder: 'Recent post',
                            value: false
                        },

                        {
                            type: 'checkbox',
                            label: 'Simple Grid ',
                            name: 'horiMasonry',
                            value: false
                        },

                        {
                            type: 'checkbox',
                            label: 'Masonry',
                            name: 'masonry',
                            value: false
                        },
                    ];
                    
                    traitOptions.forEach(traitOption => {
                        const existingTrait = component.getTrait(traitOption.name);
                        if (!existingTrait) {
                            component.addTrait(traitOption);
                        } else {
                            console.log('Trait already exists for this component.');
                        }
                    });
                }
            });

            $('#load').click(function(){
                let selectedComponent = editor.getSelected();
                if(selectedComponent){
                    let pageType_v = selectedComponent.getTrait('pageType');
                    let postCount_v = selectedComponent.getTrait('postCount');
                    let recentPost_v = selectedComponent.getTrait('recent');
                    let horiMasonryGrid_v = selectedComponent.getTrait('horiMasonry');
                    let masonryGrid_v = selectedComponent.getTrait('masonry');
                    let verticalGrid_v = selectedComponent.getTrait('varticalGrid');
                    let columns_v = selectedComponent.getTrait('columns');

                    $.ajax({
                        url:"{{route('get-page-details')}}",
                        type:"Get",
                        data:{
                            pageType: pageType_v.getValue(),
                            postCount: postCount_v.getValue(),
                            recentPost: recentPost_v.getValue(),
                            horiMasonryGrid: horiMasonryGrid_v.getValue(),
                            masonry: masonryGrid_v.getValue(),
                            column: columns_v.getValue(),
                        },

                        success:function(response){
                            console.log(response.pageDetails);
                            // editor.getSelected().components(response.gridHtml)
                            editor.setComponents(response.gridHtml);
                            toastr.success(response.message);
                        },
                        error:function(error){
                            console.error('Ajax request failed:',error);
                        }
                    });
                }
            });
        </script>
    </body>
</html>