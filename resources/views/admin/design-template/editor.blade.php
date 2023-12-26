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
       
        <script src=" https://cdn.jsdelivr.net/npm/grapesjs-plugin-toolbox@1.0.15/dist/grapesjs-plugin-toolbox.min.js"></script>
    

        {{-- include grapesjs-ckeditor plugin library --}}
        <script src=" https://cdn.jsdelivr.net/npm/grapesjs-plugin-ckeditor@1.0.1/dist/index.min.js
        "></script>
     
    </head>
    <body>
        <!-- GrapesJS Editor Container -->
        <div id="gjs"></div>
        <button id="load" class=''>Load </button>
        <script>
            let editorOptions= @json($option);

            // Initialize GrapesJS
            let editor = grapesjs.init({
                container: '#gjs',
                width: 'auto',
                plugins: ['grapesjs-preset-webpage','gjs-blocks-basic','grapesjs-plugin-forms','grapesjs-component-countdown','grapesjs-tabs','grapesjs-tooltip','grapesjs-typed','grapesjs-custom-code','grapesjs-plugin-toolbox','myPlugin','grapesjs-plugin-ckeditor'],
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
                    'grapesjs-plugin-toolbox':{},
                },

                storageManager: {  autoload: true },
            }); 

            function myPlugin(editor) {
                editor.Blocks.add('my-first-block', {
                    type: 'grid',
                    label: 'Select Grid',
                    content: `
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
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div class="tall">
                                <img src=" " alt="" />
                            </div>
                            <div class="wide">
                                <img src=" " alt="" />
                            </div>
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div class="tall">
                                <img src=" " alt="" />
                            </div>
                            <div class="big">
                                <img src=" " alt="" />
                            </div>
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div class="wide">
                                <img src=" " alt="" />
                            </div>
                            <div class="big">
                                <img src=" " alt="" />
                            </div>
                            <div class="tall">
                                <img src=" " alt="" />
                            </div>
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div>
                                <img src=" " alt="" />
                            </div>
                            <div class="wide">
                                <img src=" " alt="" />
                            </div>
                        </div>
                    `,
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

                        {
                            type: 'number',
                            label:'Row',
                            name: 'row',
                            value: '',
                        },

                        {
                            type: 'number',
                            label:'Columns Gap(px)',
                            name: 'columnsGap',
                            value: '',
                        },

                        {
                            type: 'number',
                            label:'Row Gap(px)',
                            name: 'rowGap',
                            value: '',
                        },

                        {
                            type: 'select',
                            id: 'seleted-category',
                            label: 'Category',
                            name: 'category',
                            options: [
                                { id: 'select', name: 'select', value: '0'},
                                { id: 'demo1', name: 'categ1', value: '1'},
                                { id: 'demo1', name: 'categ2', value: '2'},
                                { id: 'demo1', name: 'categ3', value: '3'},
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
                            type: 'number',
                            label:'PostCount',
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

                        // {
                        //     type: 'checkbox',
                        //     label: 'Masonry Grid ',
                        //     name: 'masonry',
                        //     value: false
                        // },

                        {
                            type: 'checkbox',
                            label: 'Vertical Grid ',
                            name: 'varticalGrid',
                            value: false
                        },
                    ];
                    
                    traitOptions.forEach(traitOption => {
                        const existingTrait = component.getTrait(traitOption.name);
                        if (!existingTrait) {
                            component.addTrait(traitOption);
                        } else {
                            // console.log('Trait already exists for this component.');
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
                    // let masonryGrid_v = selectedComponent.getTrait('masonry');
                    let verticalGrid_v = selectedComponent.getTrait('varticalGrid');

                    $.ajax({
                        url:"{{route('get-page-details')}}",
                        type:"Get",
                        data:{
                            pageType: pageType_v.getValue(),
                            postCount: postCount_v.getValue(),
                            recentPost: recentPost_v.getValue(),
                            // masonryGrid: masonryGrid_v.getValue(),
                            verticalGrid: verticalGrid_v.getValue()
    
                        },
                        success:function(response){
                            if(response.success == true){
                                console.log(response.pageDetails);
                            }else{
                                console.log(response.message);
                            }
                        },
                        error:function(error){

                        }
                    });
                }
            });
        </script>
    </body>
</html>