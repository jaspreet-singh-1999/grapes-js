<html>
 
  <head>
    <!-- cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.19.5/css/grapes.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.19.5/grapes.min.js"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>
    <script src="https://unpkg.com/grapesjs-plugin-forms"></script>
    <script src="js/gjs.init.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/grapesjs-preset-webpage@1.0.2/dist/index.min.js"></script>
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>

    <!-- custom -->

    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">

    <link rel="stylesheet" href="{{asset('css/modal.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <script src="{{ asset('js/gjs.blocks.js')}}"></script>
    <script src="{{ asset('js/gjs.traits.js') }}"></script>
    <script src="{{ asset('js/gjs.components.js') }}"></script>
    <script src="{{ asset('js/gjs.commands.js' )}}"></script>
    <script src="{{ asset('js/gjs.rte.js')}}"></script>
    <script src="{{ asset('js/custom.js')}}"></script>
  </head>
  <body>

    <div class="row" style="height:100%">
      <div id="style-manager" class="column" style="flex-basis: 500px">
        <ul class="tab tab-block">
          <li class="tab-item active" data-panel-type="content">
            <a href="#">Content</a>
          </li>
          <li class="tab-item" data-panel-type="styles">
            <a href="#">Styles</a>
          </li>
        </ul>
        <div id="content" class="tab-content">
          <div id="blocks"></div>
        </div>
        <div id="styles" class="tab-content" style="display:none;">
          <div id="selectors-container"></div>
          <div id="traits-container"></div>
          <div id="style-manager-container"></div>
        </div>
      </div>
      <div class="column editor-clm">
        <div id="gjs">
          <div class="panel">
            <h1 class="welcome">Welcome to</h1>
            <div class="big-title">
              <svg class="logo" viewBox="0 0 100 100">
                <path d="M40 5l-12.9 7.4 -12.9 7.4c-1.4 0.8-2.7 2.3-3.7 3.9 -0.9 1.6-1.5 3.5-1.5 5.1v14.9 14.9c0 1.7 0.6 3.5 1.5 5.1 0.9 1.6 2.2 3.1 3.7 3.9l12.9 7.4 12.9 7.4c1.4 0.8 3.3 1.2 5.2 1.2 1.9 0 3.8-0.4 5.2-1.2l12.9-7.4 12.9-7.4c1.4-0.8 2.7-2.2 3.7-3.9 0.9-1.6 1.5-3.5 1.5-5.1v-14.9 -12.7c0-4.6-3.8-6-6.8-4.2l-28 16.2"/>
              </svg>
              <span>GrapesJS</span>
            </div>
            <div class="description">
              This is a demo content from index.html. For the development, you shouldn't edit this file, instead you can
              copy and rename it to _index.html, on next server start the new file will be served, and it will be ignored by git.
            </div>
          </div>
          <style>
            .panel {
              width: 90%;
              max-width: 700px;
              border-radius: 3px;
              padding: 30px 20px;
              margin: 150px auto 0px;
              background-color: #d983a6;
              box-shadow: 0px 3px 10px 0px rgba(0,0,0,0.25);
              color:rgba(255,255,255,0.75);
              font: caption;
              font-weight: 100;
            }
    
            .welcome {
              text-align: center;
              font-weight: 100;
              margin: 0px;
            }
    
            .logo {
              width: 70px;
              height: 70px;
              vertical-align: middle;
            }
    
            .logo path {
              pointer-events: none;
              fill: none;
              stroke-linecap: round;
              stroke-width: 7;
              stroke: #fff
            }
    
            .big-title {
              text-align: center;
              font-size: 3.5rem;
              margin: 15px 0;
            }
    
            .description {
              text-align: justify;
              font-size: 1rem;
              line-height: 1.5rem;
            }
    
          </style>
        </div>
      </div>
    </div>

    <!-- Modal https://micromodal.vercel.app/ -->
    <!-- Open using MicroModal.show('modal-1'); -->

    <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
      <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
          <header class="modal__header">
            <h2 class="modal__title" id="modal-1-title">
              Micromodal
            </h2>
            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
          </header>
          <main class="modal__content" id="modal-1-content">
            <p>
              Try hitting the <code>tab</code> key and notice how the focus stays within the modal itself. Also, <code>esc</code> to close modal.
            </p>
          </main>
          <footer class="modal__footer">
            <button class="modal__btn modal__btn-primary">Continue</button>
            <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
          </footer>
        </div>
      </div>
    </div>
  </body>
</html>