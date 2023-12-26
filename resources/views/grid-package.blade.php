<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
        
       
        <style>
            * { box-sizing: border-box; }
    
            body {
            font-family: sans-serif;
            }
    
            /* ---- button ---- */
    
            .button {
            display: inline-block;
            padding: 0.5em 1.0em;
            background: #EEE;
            border: none;
            border-radius: 7px;
            background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
            color: #222;
            font-family: sans-serif;
            font-size: 16px;
            cursor: pointer;
            }
    
            .button:hover {
            background-color: #8CF;
            color: #222;
            }
    
            .button:active,
            .button.is-checked {
            background-color: #28F;
            }
    
            .button.is-checked {
            color: white;
            }
    
            .button:active {
            box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
            }
    
            /* ---- button-group ---- */
    
            .button-group {
            margin-bottom: 20px;
            }
    
            .button-group:after {
            content: '';
            display: block;
            clear: both;
            }
    
            .button-group .button {
            float: left;
            border-radius: 0;
            margin-left: 0;
            margin-right: 1px;
            }
    
            .button-group .button:first-child { border-radius: 0.5em 0 0 0.5em; }
            .button-group .button:last-child { border-radius: 0 0.5em 0.5em 0; }
    
            /* ---- grid ---- */
    
            .grid {
            border: 1px solid #333;
            }
    
            /* clear fix */
            .grid:after {
            content: '';
            display: block;
            clear: both;
            }
    
            /* ---- .element-item ---- */
    
            .grid-item {
            position: relative;
            float: left;
            width: 100px;
            height: 100px;
            margin: 5px;
            padding: 10px;
            background: red;
            color: white;
            font-size: 50px;
            }
    
            .grid-item--width2 { width: 210px; }
            .grid-item--height2 { height: 210px; }
    
            .grid-item:nth-child(10n+0) { background: hsl(   0, 100%, 50%); }
            .grid-item:nth-child(10n+1) { background: hsl(  36, 100%, 50%); }
            .grid-item:nth-child(10n+2) { background: hsl(  72, 100%, 50%); }
            .grid-item:nth-child(10n+3) { background: hsl( 108, 100%, 50%); }
            .grid-item:nth-child(10n+4) { background: hsl( 144, 100%, 50%); }
            .grid-item:nth-child(10n+5) { background: hsl( 180, 100%, 50%); }
            .grid-item:nth-child(10n+6) { background: hsl( 216, 100%, 50%); }
            .grid-item:nth-child(10n+7) { background: hsl( 252, 100%, 50%); }
            .grid-item:nth-child(10n+8) { background: hsl( 288, 100%, 50%); }
            .grid-item:nth-child(10n+9) { background: hsl( 324, 100%, 50%); }
    
        </style>
    </head>
    
    <script>
        $(document).ready(function() {
           
            var $grid = $('.grid').isotope({
               
                itemSelector: '.grid-item',
                layoutMode: 'masonry',
                masonry: {
                    columnWidth: 110
                },
                cellsByRow: {
                    columnWidth: 220,
                    rowHeight: 220
                },
                masonryHorizontal: {
                    rowHeight: 110
                },
                cellsByColumn: {
                    columnWidth: 220,
                    rowHeight: 220
                }
            });

            var isHorizontal = false;
            var $window = $( window );

            $('.layout-mode-button-group').on( 'click', 'button', function() {
            // adjust container sizing if layout mode is changing from vertical or horizontal
            var $this = $(this);
            var isHorizontalMode = !!$this.attr('data-is-horizontal');
            if ( isHorizontal !== isHorizontalMode ) {
                // change container size if horiz/vert change
                var containerStyle = isHorizontalMode ? {
                height: $window.height() * 0.7
                } : {
                width: 'auto'
                };
                $grid.css( containerStyle );
                isHorizontal = isHorizontalMode;
            }
            // change layout mode
            var layoutModeValue = $this.attr('data-layout-mode');
                $grid.isotope({ layoutMode: layoutModeValue });
            });  

            // change is-checked class on buttons
            $('.button-group').each( function( i, buttonGroup ) {
            var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', 'button', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                });
            });
        });

    </script>
    <body>
       
        <div class="button-group layout-mode-button-group">
            <button class="button is-checked" data-layout-mode="masonry" checked="checked">masonry</button>
            <button class="button" data-layout-mode="vertical">vertical</button>
        </div>

        <div class="grid">
            <div class="grid-item grid-item--width2"></div>
            <div class="grid-item grid-item--height2"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item grid-item--width2 grid-item--height2"></div>
            <div class="grid-item grid-item--width2"></div>
            <div class="grid-item grid-item--height2"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item grid-item--width2"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
        </div> 
    </body>
</html>

