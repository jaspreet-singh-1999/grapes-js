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

        {{-- include grapesjs-toolbox plugin library --}}
        <link href=" https://cdn.jsdelivr.net/npm/grapesjs-plugin-toolbox@1.0.15/dist/grapesjs-plugin-toolbox.min.css " rel="stylesheet">
       
        {{-- <script src=" https://cdn.jsdelivr.net/npm/grapesjs-plugin-toolbox@1.0.15/dist/grapesjs-plugin-toolbox.min.js"></script>
     --}}

        {{-- include grapesjs-ckeditor plugin library --}}
        <script src=" https://cdn.jsdelivr.net/npm/grapesjs-plugin-ckeditor@1.0.1/dist/index.min.js
        "></script>

        <script src="{{asset('grapes-js/custom-plugin.js')}}"></script>
     
    </head>
    <body>
        <!-- GrapesJS Editor Container -->
        <div id="gjs"></div>
        <button id="load" class=''>Load </button>
        <script>

            // Initialize GrapesJS
            let editor = grapesjs.init({
                container: '#gjs',
                width: 'auto',
                plugins: ['grapesjs-preset-webpage','gjs-blocks-basic','grapesjs-plugin-forms','grapesjs-component-countdown','grapesjs-tabs','grapesjs-tooltip','grapesjs-typed','grapesjs-custom-code','myPlugin','grapesjs-plugin-ckeditor','custom-grid-plugin','grapesjs-plugin-toolbox','myPlugin','custom-plugin.js'],
                pluginsOpts:{
                    'grapesjs-preset-webpage': {},
                    'gjs-blocks-basic': {},
                    'grapesjs-plugin-forms': {},
                    'grapesjs-component-countdown':{},
                    'grapesjs-tabs': {},
                    'grapesjs-tooltip': {},
                    'grapesjs-typed': {},
                    'grapesjs-custom-code': {},
                    'grapesjs-blocks-flexbox':{},
                    'custom-grid-plugin':{},
                    'grapesjs-plugin-toolbox':{},
                    'myPlugin':{}
                },

                storageManager: {  autoload: true },
            });   

            function myPlugin(editor) {
                editor.Blocks.add('my-first-block', {
                    type: 'grid',
                    label: 'Simple block',
                    content: '<div class="my-block">This is a simple block</div>',
                });
            }

            editor.on('component:selected', (component) => {
                let getType = component.get('type');
                if(getType == 'text'){
                    const traitOptions = [
                        {
                            type: 'number',
                            label: 'Columns',
                            name: 'columns',
                            value: '',

                        },
                        {
                            type: 'number',
                            label:'Row',
                            name: 'row',
                            value: '',

                        },
                        {
                            type: 'number',
                            label:'Columns Gap(px)',
                            name: 'columns_gap',
                            value: '',

                        },
                        {
                            type: 'number',
                            label:'Row Gap(px)',
                            name: 'row_gap',
                            value: '',

                        },
                        {
                            type: 'number',
                            id: 'recent',
                            label: 'Recent',
                            name: 'recent',
                            placeholder: 'Recent post',
                            value:''
                        },
                        {
                            type: 'select',
                            id: 'seleted-category',
                            label: 'Category',
                            name: 'category',
                            options: [
                                { id: 'select', name: 'select', value: '0'},
                                { id: 'demo1', name: 'demoCateg1', value: '1'},
                                { id: 'demo1', name: 'demoCateg2', value: '2'},
                                { id: 'demo1', name: 'demoCateg3', value: '3'},
                            ]
                        },
                        {
                            type: 'select',
                            id: 'pageType',
                            label: 'PageType',
                            name: 'pageType',
                            options: [
                                { id: 'select', name: 'select', value: '0'},
                                { id: 'cars', name: 'cars', value: '1'},
                                { id: 'blog', name: 'blog', value: '2'},
                                { id: 'news', name: 'news', value: '3'},
                            ]
                        },
                        {
                            type: 'checkbox',
                            label: 'Masonry Grid ',
                            name: 'masonry',
                            value: 'masonry',

                        },
                        {
                            type: 'checkbox',
                            label: 'Horizontal Grid ',
                            name: 'horizontal',
                            value: 'horizontal',

                        },
                    ];
        
                    const existingTrait = traitOptions.find(trait => component.getTrait(trait.name));
                    if (!existingTrait) {
                        component.addTrait(traitOptions);
                    } else {
                        // console.log('Trait already exists for this component.');
                    }
                }
            });

        </script>
    </body>
</html>