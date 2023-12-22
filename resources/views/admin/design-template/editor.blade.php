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

            editor.on('component:selected', (component) => {
                let getType = component.get('type');
                if(getType == 'css-grid'){
                    const traitOptions = [
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
                            options:[
                                { id: 'select', name: 'select', value: '1'},
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
                            options:[
                                { id: 'select', name: 'select', value: '1'},
                                { id: 'cars', name: 'cars', value: '1'},
                                { id: 'blog', name: 'blog', value: '2'},
                                { id: 'news', name: 'news', value: '3'},
                            ]
                        }
                    ];
                    const existingTrait = component.getTraits().find(trait => trait.get('name') === traitOptions.name);
                    if(!existingTrait) {
                        component.addTrait(traitOptions);
                        // console.log(`Trait added to the component: ${traitOptions.label}`);
                    }else{
                        // console.log('Trait already exists for this component.');
                    }
                }
            });

            function getGridSettingsFromEditor() {
                const selectedComponent = editor.getSelected();
                // Check if a component is selected
                if (selectedComponent) {
                    const columnCount = selectedComponent.getTraitValue('column-count');
                    console.log(columnCount);
                    const rowCount = selectedComponent.getTraitValue('row-count');
                    const columnSpace = selectedComponent.getTraitValue('column-space');
                    const rowSpace = selectedComponent.getTraitValue('row-space');
                    const recentPosts = selectedComponent.getTraitValue('recent');
                    const selectedPageType = selectedComponent.getTraitValue('pageType');

                    return {
                        columnCount,
                        rowCount,
                        columnSpace,
                        rowSpace,
                        recentPosts,
                        selectedPageType,
                    };
                } else {
                    console.error('No component selected.');
                    return null;
                }
            }

            // Function to handle the button click event
            function handleButtonClick() {
                const gridSettings = getGridSettingsFromEditor();

                if (gridSettings) {
                    // Send the settings to the controller using AJAX
                    $.ajax({
                        url: '/your-controller-endpoint',  // Replace with your actual controller endpoint
                        method: 'POST',
                        data: gridSettings,
                        success: function(response) {
                            console.log('Settings sent successfully:', response);
                        },
                        error: function(error) {
                            console.error('Error sending settings:', error);
                        }
                    });
                }
            }

            // Attach the function to the button click event using jQuery
            $('#load').on('click', handleButtonClick);

        </script>
    </body>
</html>