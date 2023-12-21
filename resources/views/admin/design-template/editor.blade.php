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
        <button id="saveButton" class=''>Save</button>
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
           

            editor.on('component:selected', (component) => {
                let getType = component.get('type');
                if(getType == 'css-grid'){
                    const traitOptions = [
                        {
                            type: 'number',
                            label: 'Recent',
                            name: 'recent',
                            placeholder: 'Recent post'
                        },
                        {
                            type: 'select',
                            label: 'Category',
                            name: 'category',
                            options:[
                                { id: 'select', name: 'select', value: '1'},
                                { id: 'demo1', name: 'demoCateg1', value: '1'},
                                { id: 'demo1', name: 'demoCateg2', value: '2'},
                                { id: 'demo1', name: 'demoCateg3', value: '3'},
                            ]
                        },
                        {
                            type: 'select',
                            label: 'PageType',
                            name: 'pageType',
                            options:[
                                { id: 'select', name: 'select', value: '1'},
                                { id: 'cars', name: 'cars', value: '1'},
                                { id: 'blog', name: 'blog', value: '2'},
                                { id: 'news', name: 'news', value: '3'},
                            ]
                        }
                    ];
                    const existingTrait = component.getTraits().find(trait => trait.get('name') === traitOptions.name);
                    if (!existingTrait) {
                        component.addTrait(traitOptions);
                        // console.log(`Trait added to the component: ${traitOptions.label}`);
                    } else {
                        // console.log('Trait already exists for this component.');
                    }
                }
            });

            // editor.DomComponents.addType('css-grid', {
            //     isComponent: el => el.type == 'css-grid',
            //     model: {
            //         defaults: {
            //             traits: [
                           
            //                 {
            //                     type: 'select', 
            //                     label: 'category', 
            //                     name: 'category', 
            //                     options: [
            //                         { id: 'select', name: 'select'},
            //                         { id: 'cars', name: 'Cars'},
            //                         { id: 'blog', name: 'blog'},
            //                         { id: 'news', name: 'news'},
            //                         { id: 'company', name: 'company'},
            //                     ]
            //                 }, 
            //                 {
            //                     type: 'number', 
            //                     label: 'Recent', 
            //                     name: 'recent',
            //                     placeholder: 'Recent post' 
            //                 }, 
            //                 {
            //                     type: 'select',
            //                     label: 'PageType', 
            //                     name: 'pageType', 
            //                     options: [
            //                         { id: "select", name: 'select', value: '0'},
            //                         { id: "demo1", name: 'DemoType1', value: '1'},
            //                         { id: "demo2", name: 'DemoType2', value: '2'},
            //                         { id: "demo3", name: 'DemoType3', value: '3'},
            //                         { id: "demo4", name: 'DemoType4', value: '4'},
            //                     ]
            //                 },
            //                 {
            //                     type: 'number', 
            //                     label: 'row', 
            //                     name: 'row'
                        
            //                 }, 
            //             ],
                    
            //             attributes: { type: 'text', required: true },
            //         },
            //     },
            // });

            function myPlugin(editor) {
                editor.Blocks.add('block', {
                    label: 'Select Page type',
                    content: {
                        type: 'Select',
                        content: `
                            <select name="page_type" id="select-option" class="form-control">
                                <option selected value="">Select type</option>
                                ${editorOptions.map(option => `<option value="${option.id}">${option.page_type}</option>`)}
                            </select>
                        `,
                    },
                });
            }

            $('#saveButton').on('click',function(e){
                let html= editor.getHtml();
                let css= editor.getCss();
                let id= $('#sel_post_type_').val();
                console.log(id);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('save_tempate_data') }}",
                    type: "POST",
                    data: {
                        html:html,
                        css:css
                    },
                    success: function(response) {
                        if(response.success == true){
                            console.log(response.message);
                           
                        }else{
                            console.log(response.message);
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